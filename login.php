<?php

      session_start();
      session_destroy();

      // Start an output buffer, so not to output anything content on the console...
      //ob_start();

      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      session_start();

      $page_title = "Login";
      // Core
      //require_once("core/config.php");
      // Header
      require_once("includes/header.php");
      // Navigation
      require_once("nav/nav_login.php");
      require("functions/FieldSanitizer.php");




      $err_flag = 0;
      $err_msg = null;
      if (isset($_POST['formLogin'])){
          $username = FieldSanitizer::inClean($_POST['loginUsername']);
          $password = FieldSanitizer::inClean($_POST['loginPassword']);



          if (($username != "") || ($password != "")){



                        if ($username=='myadmin' && $password=='2021Session'){
                              //Start session

                              $_SESSION['ulogin_state'] = 200;
                              $_SESSION['ulogin_role'] = 'admin';


                              header("location: cadmin/admin_dashboard.php");
                          }

              }else{
                 // login fails
                 $err_flag = 1;
                 $err_msg = "Invalid login credentials";
              }

      }else{
              $err_msg = "Username and Password are required.";
              $err_flag = 1;
      }





 ?>
<div id="site_backdrop_identity" style="background-image:url('<?php echo $baseUrl; ?>lib/assets/img/ogun_state_map_background.png')"  >

<div class="container-fluid"  >
    <div class="row d-flex justify-content-center" style="margin-top:20px;padding-top:30px;">

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <!-- Material form login -->
            <div class="card">
                <h5 class="card-header primary-color white-text text-center py-4" style="opacity:0.6">
                  <strong>Sign in</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                          <!-- Submit Feedback  -->
                          <div class="md-form">
                              <?php
                                  if (isset($_POST['formLogin'])){
                                        if ($err_flag==1){
                                              miniErrorAlert($err_msg);
                                        }
                                  }
                              ?>
                          </div>

                          <!-- Email -->
                          <div class="md-form">
                            <input type="text" id="loginUsername" name="loginUsername" class="form-control" required>
                            <label for="loginUsername">Username</label>
                          </div>

                          <!-- Password -->
                          <div class="md-form">
                            <input type="password" id="loginPassword" name="loginPassword" class="form-control" required>
                            <label for="loginPassword">Password</label>
                          </div>



                          <!-- Sign in button -->
                          <button name="formLogin" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>


                      </form>
                      <!-- Form -->

                </div><!-- Card content //-->


            </div><!-- Material form login -->

      </div><!-- end of columm //-->



    </div><!-- end of row //-->
</div><!-- end of container //-->

<br/><br/><br/><br/>

<?php
      //footer
      require_once("includes/footer.php");
 ?>

</div>
