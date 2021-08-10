<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $referrer_id = '';
    if (isset($_GET['referrer_id'])){
        $referrer_id = $_GET['referrer_id'];
    }else{
        $referrer_id = '';
    }

    $page_title = "Obtain your Ticket";

    // Header
    require_once("../includes/header_ticket.php");
    //require_once("interface/ModelInterface.php");
    require_once("../interface/DBInterface.php");
    require_once("../abstract/Database.php");
    require_once("../classes/PDO_QueryExecutor.php");

    require_once("../classes/Model.php");

    require_once("../functions/Encrypt.php");
    // Navigation
    //require_once("nav/nav_home.php");


    $model_recordset = '';

    if ($referrer_id!=''){
      $model_no = $_GET['referrer_id'];

      $model = new Model();
      $get_model = $model->get_model_by_modelNo($model_no);

      $model_recordset = $get_model->fetch(PDO::FETCH_ASSOC);
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
    <div class="row">

        <!-- column - referrer //-->
        <?php
            if ($referrer_id!='')
            {
                if ($get_model->rowCount()){
        ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2 alert alert-success">
                <small><strong>
                  <?php echo 'Referrer: '.$model_recordset['name']; ?>
                </strong></small>
              </div>
        <?php
                }else{

                    echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2 alert alert-danger'><small><strong><i class='fas fa-exclamation-triangle'></i> Sorry, there's no model with that referrer code. </strong></small></div>";
                }
            }
        ?>

        <!-- end of column referrer //-->

        <!-- column 1 -  //-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <!-- panel //-->
              <div class="card text-center">
                  <div class="card-header" style="background-color:#ab47bc;">

                      <h3>REGULAR TABLE</h3>
                  </div>
                  <div class="card-body">
                      <h2 class="card-title" style='color:#888888;'><strike>N</strike>1,000</h2>
                      <p class="card-text" style="font-size:18px;"><i class="fas fa-user"></i> 1 Seat</p>

                  </div>
                  <div class="card-footer text-muted">
                     <?php
                        $ticket_link = "obtain_your_ticket.php?q=".mask('regular')."&a=".mask('1000')."&s=".mask('1')."&r=".mask($referrer_id);
                     ?>
                     <a href="<?php echo $ticket_link; ?>" class="btn btn-purple btn-rounded">Obtain Ticket</a>
                  </div>
              </div>
              <!-- end of panel //-->

        </div>
        <!-- end of column 1 //-->


        <!-- column 2 -  //-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <!-- panel //-->
              <div class="card text-center">
                  <div class="card-header" style="background-color:#ec407a;">
                      <h3>VIP TABLE</h3>
                  </div>
                  <div class="card-body">
                      <h2 class="card-title" style='color:#888888;'><strike>N</strike>5,000</h2>
                      <p class="card-text" style="font-size:18px;"><i class="fas fa-user"></i> 1 Seat</p>

                  </div>
                  <div class="card-footer text-muted">
                      <?php
                         $ticket_link = "obtain_your_ticket.php?q=".mask('vip')."&a=".mask('5000')."&s=".mask('1')."&r=".mask($referrer_id);
                      ?>
                      <a href="<?php echo $ticket_link; ?>" class="btn btn-pink btn-rounded">Obtain Ticket</a>
                  </div>
              </div>
              <!-- end of panel //-->

        </div>
        <!-- end of column 2 //-->

        <!-- column 3 -  //-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <!-- panel //-->
              <div class="card text-center">
                  <div class="card-header" style="background-color:#ffc107;">

                      <h3>EXECUTIVE TABLE</h3>
                  </div>
                  <div class="card-body">
                      <h2 class="card-title" style='color:#888888;'><strike>N</strike>10,000</h2>
                      <p class="card-text" style="font-size:18px;"><i class="fas fa-user"></i> 1 Seat</p>

                  </div>
                  <div class="card-footer text-muted">
                      <?php
                         $ticket_link = "obtain_your_ticket.php?q=".mask('executive')."&a=".mask('10000')."&s=".mask('1')."&r=".mask($referrer_id);
                      ?>
                      <a href="<?php echo $ticket_link; ?>" class="btn btn-yellow btn-rounded">Obtain Ticket</a>
                  </div>
              </div>
              <!-- end of panel //-->

        </div>
        <!-- end of column 3 //-->

    </div>
    <!-- end of row 2 //-->



    <!-- row 3 //-->
    <div class="row mt-2">
        <!-- column 1 -  //-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <!-- panel //-->
              <div class="card text-center">
                  <div class="card-header" style='background-color:#26a69a;'>

                      <h3>MOET TABLE</h3>
                  </div>
                  <div class="card-body">
                      <h2 class="card-title" style='color:#888888;'><strike>N</strike>50,000</h2>
                      <p class="card-text" style="font-size:18px;"><i class="fas fa-users"></i> 5 Seats</p>

                  </div>
                  <div class="card-footer text-muted">
                      <?php
                         $ticket_link = "obtain_your_ticket.php?q=".mask('moet')."&a=".mask('50000')."&s=".mask('5')."&r=".mask($referrer_id);
                      ?>
                      <a href="<?php echo $ticket_link; ?>" class="btn btn-teal btn-rounded">Obtain Ticket</a>
                  </div>
              </div>
              <!-- end of panel //-->

        </div>
        <!-- end of column 1 //-->


        <!-- column 2 -  //-->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <!-- panel //-->
              <div class="card text-center">
                  <div class="card-header" style="background-color:#d4e157;">

                      <h3>DIAMOND TABLE</h3>
                  </div>
                  <div class="card-body">
                      <h2 class="card-title" style='color:#888888;'><strike>N</strike>100,000</h2>
                      <p class="card-text" style="font-size:18px;"><i class="fas fa-users"></i> 10 Seats</p>

                  </div>
                  <div class="card-footer text-muted">
                      <?php
                         $ticket_link = "obtain_your_ticket.php?q=".mask('diamond')."&a=".mask('100000')."&s=".mask('10')."&r=".mask($referrer_id);
                      ?>
                      <a href="<?php echo $ticket_link; ?>" class="btn btn-lime btn-rounded">Obtain Ticket</a>
                  </div>
              </div>
              <!-- end of panel //-->

        </div>
        <!-- end of column 2 //-->


    </div>
    <!-- end of row 3 //-->




  


</div><!-- end of container fluid //-->

<input type='hidden' id='modelNo' />
<input type="hidden" id="modelName"  />
<br/><br/>





<?php
      //footer
      require_once("../includes/footer.php");
 ?>
