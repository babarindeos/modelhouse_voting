<?php
//
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// get user eligibility
  if (!isset($_GET['q']) || $_GET['q']==''){
        header("location: tickets.php");
  }

  if (!isset($_GET['a']) || $_GET['a']==''){
        header("location: tickets.php");
  }

  // get ticket type
  $_GET_URL_ticket_type = explode("-",htmlspecialchars(strip_tags($_GET['q'])));
  $_GET_URL_ticket_type = $_GET_URL_ticket_type[1];

  // get ticket amount
  $_GET_URL_ticket_amount = explode("-",htmlspecialchars(strip_tags($_GET['a'])));
  $_GET_URL_ticket_amount = $_GET_URL_ticket_amount[1];


  // get seat
  $_GET_URL_seats = explode("-",htmlspecialchars(strip_tags($_GET['s'])));
  $_GET_URL_seats = $_GET_URL_seats[1];

  //get referrer_id
  $_GET_URL_referrer = explode("-",htmlspecialchars(strip_tags($_GET['r'])));
  $_GET_URL_referrer_id = $_GET_URL_referrer[1];


  if ($_GET_URL_referrer_id==''){
      $model_ref = '000';
  }else{
      $model_ref = $_GET_URL_referrer_id;
  }


  //echo $_GET_URL_ticket_type;
  //echo $_GET_URL_ticket_amount;

$page_title = "Obtain your Ticket";

// Header
require_once("../includes/header_ticket.php");
//require_once("interface/ModelInterface.php");
require_once("../interface/DBInterface.php");

require_once("../abstract/Database.php");
require_once("../classes/PDO_QueryExecutor.php");

require_once("../classes/Model.php");
require_once("../classes/Ticket.php");

require_once("../functions/Encrypt.php");
// Navigation
//require_once("nav/nav_home.php");

$model_recordset = '';

if ($_GET_URL_referrer_id!=''){
  $model_no = $_GET_URL_referrer_id;

  $model = new Model();
  $get_model = $model->get_model_by_modelNo($model_no);

  $model_recordset = $get_model->fetch(PDO::FETCH_ASSOC);

}




  if (isset($_POST['btnSubmit'])){
      $fullname = $_POST['fullname'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];

      $reference = $_GET_URL_ticket_type.'-'.$model_ref."-".time();

      //store in session_start  -----------------------------------------------
      session_start();
      $_SESSION['fullname'] = $fullname;
      $_SESSION['phone'] = $phone;
      $_SESSION['email'] = $email;
      $_SESSION['ticket_type'] = $_GET_URL_ticket_type;
      $_SESSION['ticket_amount'] = $_GET_URL_ticket_amount;
      $_SESSION['reference'] = $reference;
      $_SESSION['referrer'] = $_GET_URL_referrer_id;
      //------------------------------------------------------------------------

      //  store data in database
      $dataArray = array("fullname"=>$fullname,"phone"=>$phone,"email"=>$email,"ticket_type"=>$_GET_URL_ticket_type,
                   "ticket_amount"=>$_GET_URL_ticket_amount,"reference"=>$reference,"referrer"=>$_GET_URL_referrer_id);

      $ticket = new Ticket();
      $new_ticket = $ticket->new_ticket($dataArray);




      //------------------------------------------------------------------------



      $curl = curl_init();

      $customer_email = $email;
      $amount = $_GET_URL_ticket_amount;
      $currency = "NGN";
      $txref = $reference;
      $PBFPubKey = "FLWPUBK_TEST-bacde77fc0f6df90ca322856e9355987-X";
      $redirect_url = "http://localhost/modelhouse_voting/tickets/process_transaction.php";


       curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount'=>$amount,
              'customer_email'=>$customer_email,
              'currency'=>$currency,
              'txref'=>$txref,
              'PBFPubKey'=>$PBFPubKey,
              'redirect_url'=>$redirect_url
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          if($err){
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
          }

          $transaction = json_decode($response);

          if(!$transaction->data && !$transaction->data->link){
            // there was an error from the API
            print_r('API returned error: ' . $transaction->message);
          }


          // redirect to page so User can pay
          // uncomment this line to allow the user redirect to the payment page
          header('Location: ' . $transaction->data->link);

  }

?>

<div class="container">
    <!-- row 1 //-->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
              <!-- nav //-->
              <div class='mt-4 mb-4 text-center'>
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/'>HOME</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/models/'>MODELS</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/models/'>TICKETS</a>
              </div><!-- end of nav //-->
        </div> <!-- end of column 1 //-->
    </div><!-- end of row 1//-->


    <!-- row 2 //-->
    <div class="row rounded border px-2 py-2 ">
        <!-- column 1 -  //-->


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 text-center">
            <?php
                  $ticket_type = $_GET_URL_ticket_type;
                  $ticket_amount = $_GET_URL_ticket_amount;
                  $no_of_seats = $_GET_URL_seats;
                  echo "<h4 style='color:gold;'>".strtoupper($ticket_type).' TABLE  &nbsp;&nbsp; - &nbsp; <strike>N</strike>'.number_format($ticket_amount).'</h4>';
                  if ($no_of_seats>1){
                      echo "<i class='fas fa-users'></i> ".$no_of_seats.' Seats';
                  }else{
                        echo "<i class='fas fa-user'></i> ".$no_of_seats.' Seat';
                  }

                  if ($_GET_URL_referrer_id!='')
                  {
                      if ($get_model->rowCount()){
                          $bonus_votes = '';
                          Switch($ticket_type){
                            case 'regular':
                              $bonus_votes = 1;
                              break;
                            case 'vip':
                              $bonus_votes = 5;
                              break;
                            case 'executive':
                              $bonus_votes = 10;
                              break;
                            case 'moet':
                              $bonus_votes = 50;
                              break;
                            case 'diamond':
                              $bonus_votes = 100;
                              break;
                          }


                          echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-success'><strong><i class='far fa-grin'></i> Support ".$model_recordset['name']." with <big><strong>{$bonus_votes}</strong></big> votes</strong></div>";
                      }
                  }
            ?>
        </div>

    </div>
    <!-- end of row 3 //-->

    <!-- row - personal Information //-->


          <div class="row mt-4 mb-4">
              <!-- left column - form //-->
              <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

                              <!-- form //-->
                              <?php
                                    $form_link = "obtain_your_ticket.php?q=".mask($_GET_URL_ticket_type)."&a=".mask($_GET_URL_ticket_amount)."&s=".mask($_GET_URL_seats)."&r=".mask($_GET_URL_referrer_id);
                              ?>
                              <form action="<?php echo $form_link; ?>" method="post">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <!-- Default input -->
                                            <label for="fullname">Your Full Name</label>
                                            <input type="text" id="fullname" name="fullname" class="form-control" required/>
                                            <!-- Material input -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                            <!-- Default input -->
                                            <label for="phone">Phone No.</label>
                                            <input type="phone" id="phone" name="phone" class="form-control" required/>
                                            <!-- Material input -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                            <!-- Default input -->
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" required/>
                                            <!-- Material input -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                        <button type="submit"  class="btn btn-primary btn-lg btn-rounded" name="btnSubmit">Purchase Ticket</button>
                                    </div>
                                </form>
                                <!-- end of form //-->


              </div>
              <!-- end of left column //-->

              <!-- right column - referrer avatar //-->
              <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-center">
                  <?php
                      if ($_GET_URL_referrer_id!=''){
                      ?>
                          <img src="<?php echo $model_recordset['picture']; ?>" class="img-fluid" width='60%' />
                      <?php
                      }
                  ?>
              </div>
              <!-- end of column -- end of referrer avatar //-->



          </div>

    <!-- end of row - personal information //-->




</div><!-- end of container fluid //-->

<input type='hidden' id='modelNo' />
<input type="hidden" id="modelName"  />
<br/><br/>





<?php
      //footer
      require_once("../includes/footer.php");
 ?>
