<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Models</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../lib/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../lib/css/style.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

  <style>
      .navbar {
        z-index: 1040;
      }
      .side-nav {
        margin-top: 57px !important;
      }

      @media (min-width: 1200px){
      .fixed-sn main {
          margin-left: 2% !important;
          margin-right: 2% !important;
        }
      }

  </style>
</head>

<body>
<?php
  require_once("../nav/nav_login.php");
  require("../functions/FieldSanitizer.php");
  require("../classes/Model.php");
  require("../interface/DBInterface.php");
  require("../abstract/Database.php");
  require("../classes/PDODriver.php");
  require("../classes/PDO_QueryExecutor.php");

  require("../functions/Encrypt.php");

  $_GET_URL_model_name = explode("-",htmlspecialchars(strip_tags($_GET['name'])));
  $_GET_URL_model_name = $_GET_URL_model_name[1];

  $_GET_URL_model_no = explode("-",htmlspecialchars(strip_tags($_GET['q'])));
  $_GET_URL_model_no = $_GET_URL_model_no[1];

  $_GET_URL_model_picture = explode("-",htmlspecialchars(strip_tags($_GET['picture'])));
  $_GET_URL_model_picture = $_GET_URL_model_picture[1];



  $model = new Model();


  $get_votes_payment = $model->get_votes_payment($_GET_URL_model_no);


?>
<div class="container m4-t mb-5">
      <div class="row mt-5">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <h2 class='mt-10'><?php echo $_GET_URL_model_name; ?>'s votes </h2>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right">
              <a class='btn btn-primary btn-sm btn-rounded' href="admin_dashboard.php">Back</a>
          </div>
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <table id='tblData' class='table table-striped mt-4'>
                  <thead>
                        <tr>
                           <th>#</th>
                           <th>Votes</th>
                           <th>Ref. No</th>
                           <th>Voter</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Amount</th>
                           <th>Channel</th>
                           <th>Date</th>

                        </tr>
                  </thead>
                  <tbody>
                        <?php
                              if ($get_votes_payment->rowCount()){
                                      $count = 0;
                                      while($row=$get_votes_payment->fetch(PDO::FETCH_ASSOC)){
                                        $count++;
                                         $votes = $row['votes'];
                                         $reference = $row['reference'];
                                         $lastname = $row['lastname'];
                                         $firstname = $row['firstname'];
                                         $email = $row['email'];
                                         $phone = $row['phone'];
                                         $amount = $row['amount'];

                                         $channel = $row['channel'];
                                         $date_paid = new DateTime($row['date_paid']);
                                         $date_paid = $date_paid->format('M. jS F, Y');

                        ?>
                        <tr>
                              <td><?php echo $count; ?>.</td>
                              <td><?php echo $votes; ?></td>
                              <td><?php echo $reference; ?></td>
                              <td><?php echo $lastname.' '.$firstname; ?></td>
                              <td><?php echo $email; ?></td>
                              <td><?php echo $phone; ?></td>
                              <td><?php echo number_format($amount,2); ?></td>
                              <td><?php echo $channel; ?></td>
                              <td><?php echo $date_paid; ?></td>
                        </tr>
                        <?php
                                    }
                              }
                         ?>
                  </tbody>
              </table>

            </div>
      </div>
</div>



<?php
    //footer.php
    require('../includes/footer.php');
 ?>

<script src="../../lib/js/custom/tblData.js"></script>
