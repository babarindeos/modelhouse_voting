<?php
//
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// get user eligibility
  if (!isset($_GET['q']) || $_GET['q']==''){
        header("location: tickets.php");
  }
    // $num = "0290";
    // $n = ltrim($num, "0");
    // echo $n;

  // get ticket type
  //$_GET_URL_reference = explode("-",htmlspecialchars(strip_tags($_GET['q'])));
  //$_GET_URL_reference = $_GET_URL_reference[1];
  $_GET_URL_reference = $_GET['q'];


  $page_title = "Ticket Purchased";

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
  $passcode = '';

  if ($_GET_URL_reference!=''){
    $ticket = new Ticket();
    $get_ticket = $ticket->get_ticket_by_reference($_GET_URL_reference);
    $ticket_info = $get_ticket->fetch(PDO::FETCH_ASSOC);
    $ticket_sn = $ticket_info['id'];

    $passcode = str_pad($ticket_sn, 4, '0', STR_PAD_LEFT);
  }else{
    header("location: tickets.php");
  }

  // if (isset($_POST['btnSubmit'])){
  //
  // }







?>

<div class="container">
    <!-- row 1 //-->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
              <!-- nav //-->
              <div class='mt-4 mb-4 text-center'>
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/'>HOME</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/models/'>MODELS</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/web.online_voting/tickets/tickets.php'>TICKETS</a>
              </div><!-- end of nav //-->
        </div> <!-- end of column 1 //-->
    </div><!-- end of row 1//-->


    <!-- row 2 //-->
    <div class="row rounded border px-2 py-5 mt-5 ">
        <!-- column 1 -  //-->


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 text-center">
             <h2><span style='color:red;'>Whoops!</span> Transaction failed.<br/>
               <small>Something went wrong. Please try again.</small></h2>
               <br/>
               <h4><a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/web.online_voting/tickets/tickets.php'>Back to TICKETS</a></h3>

        </div>

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
