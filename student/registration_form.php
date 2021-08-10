<?php
  //session_start();
  //
  // if (!(isset($_SESSION['app_login']) && $_SESSION['app_login'] != '')) {
  //
  // header ("Location: login.php");
  //
  // }





      $page_title = "Registration";
      // Core
      require_once("../core/wp_config.php");
      // Header
      //  require_once("../includes/header.php");
      // Navigation
      require_once("../nav/nav_login.php");

      require_once("../includes/funaabWS.php");
      require_once("../includes/ws_functions.php");
      require_once("../includes/ws_parameters.php");




      $err_flag = 0;
      $err_msg = null;
      $message = "";



  //-------------- Post back
      if (isset($_POST['btnPrepayment'])){


      }

  //--------------- End of Post back





 ?>

<div class="container-fluid">

    <!-- Pre-payment Form //-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="row" style="margin-top:20px;">





      <!-- left pane //-->
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
          <h4 class='mb-4'>SIWES Registration<br><small>2019/2020 Academic Session</small></h4>


          <div class="d-flex justify-content-end">
              <button type="button" id='btn_toggle_readonly_fields' class="btn btn-primary btn-sm">
                Read Only Fields
              </button>
          </div>

            <!-- Grid row 1 //-->
            <div class="form-row" id='row_names' style="display: none;">
                <!-- surname //-->
                <div class="form-group col-md-4">
                    <label for="surname" disabled>Surname</label>
                    <input type='text' class='form-control' id='surname' name='surname' value="<?php echo $studentData['surname']; ?>" disabled>
                </div>
                <!-- end of surname //-->

                <!-- firstname //-->
                <div class="form-group col-md-4">
                    <label for="firstname" disabled>Firstname</label>
                    <input type='text' class='form-control' id='firstname' name='firstname' value="<?php echo $studentData['firstname']; ?>" disabled>
                </div>
                <!-- end of firstname //-->

                <!-- Othernames //-->
                <div class="form-group col-md-4">
                    <label for="othernames" disabled>Othernames</label>
                    <input type='text' class='form-control' id='othername' name='othername' value="<?php echo $studentData['othername'] ?>" disabled>
                </div>
                <!-- end of firstname //-->


            </div>
            <!-- end of Grid 1 //-->



            <!-- Grid row 2 //-->
            <div class="form-row" id='row_contact' style='display:none;'>
                <!-- email //-->
                <div class="form-group col-md-8">
                    <label for="email" disabled>Email</label>
                    <input type="email" class="form-control" id="email" name='email' value="<?php echo $studentData['email']; ?>" disabled>
                </div>
                <!-- end of email //-->

                <!-- phone //-->
                <div class="form-group col-md-4">
                    <label for="phone" disabled>Phone</label>
                    <input type="phone" class="form-control" id="phone" name='phone' value="<?php echo $studentData['phone']; ?>" disabled>
                </div>

                <!-- end of phone //-->


            </div>
            <!-- end of Grid row 2 //-->


            <!-- Grid row 3 //-->
            <div class="form-row" id='row_discipline' style="display:none;">
                <!-- level //-->
                <div class="form-group col-md-4">
                    <label for="level" disabled>Level</label>
                    <input type="text" class="form-control" id="level" name='level' value="<?php echo $studentData['level']; ?>" disabled>
                </div>
                <!-- end of level //-->

                <!-- department //-->
                <div class="form-group col-md-4">
                    <label for="deptCode" disabled>Department</label>
                    <input type="deptCode" class="form-control" id="deptCode" name='deptCode' value="<?php echo $studentData['deptCode']; ?>" disabled>
                </div>

                <!-- end of department //-->

                <!-- college //-->
                <div class="form-group col-md-4">
                    <label for="collegeCode" disabled>College</label>
                    <input type="text" class="form-control" id="collegeCode" name='collegeCode' value="<?php echo $studentData['collegeCode']; ?>" disabled>
                </div>

                <!-- end of college //-->


            </div>
            <!-- end of Grid row 3 //-->

            <!-- Grid row 4 //-->
            <div class="form-row">
                <!-- Alternate email //-->
                <div class="form-group col-md-7">
                    <label for="email" disabled>Alternate Email</label>
                    <input type="email" class="form-control" id="email" name='email'>
                    <small id="loginHelpBlock" class="form-text text-muted text-left">
                      Another personal email account that is active and functional.
                    </small>
                </div>
                <!-- end of alternate email //-->

                <!-- alternate phone //-->
                <div class="form-group col-md-5">
                    <label for="phone" disabled>Alternate Phone</label>
                    <input type="phone" class="form-control" id="phone" name='phone' >
                    <small id="loginHelpBlock" class="form-text text-muted text-left">
                      Another personal phone number on which you can be reached.
                    </small>
                </div>
                <!-- end of alternate phone //-->
            </div>
            <!-- end of Grid row 4 //-->


            <!--  Grid row 4 //-->
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for='homeAddr' disabled>Home Address</label>
                    <input type='text' class='form-control' id='homeAddr'>
                </div>
            </div>
            <!-- end of Grid row 4 //-->

            <!-- // Grid row 5-->

            <!-- end of Grid row 5 //-->


      </div>
      <!-- end of left pane //-->


      <!--  right column  //-->
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg text-center">
           <?php
                echo "<h4>User: [<strong>".$studentData['Matric']."</strong>] &nbsp;<small><i class='fas fa-power-off'></i> Log-out</small></h4>";
           ?>


           <div class="avatar mx-auto white mt-5"><img src="images/user_avatar.png"
                  alt="avatar mx-auto white" class="rounded-circle img-fluid border">
           </div>


      </div><!-- end of columm //-->
      <!-- end of right column //-->



    </div><!-- end of row //-->

  </form>
  <!-- end of Prepayment form //-->

</div><!-- end of container //-->

<br/><br/>
<?php
      //footer
      require_once("../includes/footer.php");
 ?>

 <script>
  $(document).ready(function(){

      $("#btn_toggle_readonly_fields").bind("click", function(){

          $("#row_names").toggle();
          $("#row_contact").toggle();
          $("#row_discipline").toggle();
      });
  });

 </script>
