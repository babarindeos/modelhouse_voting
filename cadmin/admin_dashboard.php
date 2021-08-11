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



  $model = new Model();

  $start_model_id = 47;
  $end_model_id = 59;
  $get_models = $model->get_models_by_range($start_model_id, $end_model_id);


?>
<div class="container m4-t mb-5">
      <div class="row mt-5">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h2 class='mt-10'>Models (<?php echo $get_models->rowCount()?>) </h2>
          </div>
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

              <table id='tblData' class='table table-striped mt-4'>
                  <tbody>
                        <?php

                              while($row=$get_models->fetch(PDO::FETCH_ASSOC)){
                                 $model_id = $row['id'];
                                 $model_no = $row['model_no'];
                                 $name = $row['name'];
                                 $picture = $row['picture'];
                                 $web_url = $row['web_url'];

                                 $votes = $model->get_votes_count($model_no);

                                 $votes_link = "<a href='votes_break_down.php?q=".mask($model_no)."&name=".mask($name)."&picture=".mask($picture)."'><h2>{$votes}</h2></a>";
                                 $photo = "<img src='".$picture."' class='img-fluid rounded-circle z-depth-0' alt='My Avatar'>";
                        ?>
                        <tr>
                              <td class='text-center'><?php echo $photo.'<br/><h4>'.$name.'<br/>'.$model_no; ?></h4></td><td class='text-center'><?php echo $votes_link; ?></td>
                        </tr>
                        <?php
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
