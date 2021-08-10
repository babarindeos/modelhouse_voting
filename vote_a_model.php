    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_GET['model']) || $_GET['model']==''){
      // re-direct
      header("Location:index.php");
    }

    $page_title = "Vote a Model";

    // Header
    require_once("includes/header.php");
    //require_once("interface/ModelInterface.php");
    require_once("interface/DBInterface.php");
    require_once("abstract/Database.php");
    require_once("classes/PDO_QueryExecutor.php");

    require_once("classes/Model.php");

    // Navigation
    //require_once("nav/nav_home.php");

    $model_recordset = '';

    $model_no = $_GET['model'];

    $model = new Model();
    $get_model = $model->get_model_by_modelNo($model_no);

    $model_recordset = $get_model->fetch(PDO::FETCH_ASSOC);









  ?>

    <div class="container-fluid">
        <!-- row 1 //-->
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                  <img src="<?php echo $model_recordset['picture']; ?>" class="img-fluid" width='100%' />
            </div>



            <div class="col-xs-12 col-sm-12 col-md-7 text-left">

              <!-- nav //-->
              <div class='mt-4 mb-4 text-center'>
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/'>HOME</a> &nbsp;&nbsp; |  &nbsp;&nbsp;
                    <a style='color:white;' href='https://themodelhousemates.officialhouseofceo.com/models/'>MODELS</a>
              </div>
              <!-- end of nav //-->

              <form>
                <h2 style='color:gold;'>Vote <?php echo $model_recordset['name']; ?> </h2>



                <div class='alert alert-danger text-center' role="alert" id='errMsg' style='display:none'></div>
                <div class='alert alert-success text-center' role="alert" id='successMsg' style='display:none'></div>

                <!-- ******************************  Vote Options *************************************** //-->
                <!-- radio options //-->
                <div class="row mt-4 rounded border py-3 text-center">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                              <h5>Pick your Number of Votes</h5>

                              <!-- Votes 1-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_1" name="votes_count" value="1">
                              <label class="custom-control-label" for="votes_1">1 Vote</label>
                              </div>

                              <!-- Votes 5-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_5" name="votes_count" value="5">
                              <label class="custom-control-label" for="votes_5">5 Votes</label>
                              </div>

                              <!-- Votes 10-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_10" name="votes_count" value="10">
                              <label class="custom-control-label" for="votes_10">10 Votes</label>
                              </div>

                              <!-- Votes 15-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_15" name="votes_count" value="15">
                              <label class="custom-control-label" for="votes_15">15 Votes</label>
                              </div>

                              <!-- Votes 20-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_20" name="votes_count" value="20">
                              <label class="custom-control-label" for="votes_20">20 Votes</label>
                              </div>

                              <!-- Votes 30-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_30" name="votes_count" value="30">
                              <label class="custom-control-label" for="votes_30">30 Votes</label>
                              </div>

                              <!-- Votes 40-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_40" name="votes_count" value="40">
                              <label class="custom-control-label" for="votes_40">40 Votes</label>
                              </div

                              <!-- Votes 40-->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input vote_option" id="votes_50" name="votes_count" value="50">
                              <label class="custom-control-label" for="votes_50">50 Votes</label>
                              </div>


                    </div>

                </div> <!-- end of radio options //-->
                <!-- ******************************* End of Vote Options *********************************************** //-->


                <!-- ******************************* Your Info *********************************** //-->
                <div class="row mt-3 rounded border py-3 text-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h5>Your Info</h5>
                        <!--  row 1 -->
                        <div>
                            <form>
                              <!-- Grd row -->
                              <div class="form-row">
                                <!-- Grid column -->
                                <div class="col">
                                  <!-- Default input -->
                                  <input type="text" class="form-control" placeholder="First name" id="first_name" name="first_name" required>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col">
                                  <!-- Default input -->
                                  <input type="text" class="form-control" placeholder="Last name" id="last_name" name="last_name" required>
                                </div>
                                <!-- Grid column -->
                              </div>
                              <!-- Grd row -->
                            </form>
                        </div>
                          <!-- end of row 1 -->

                        <!-- row 2 //-->
                        <div class='mt-3'>
                            <form>
                              <!-- Grd row -->
                              <div class="form-row">
                                <!-- Grid column -->
                                <div class="col">
                                  <!-- Default input -->
                                  <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col">
                                  <!-- Default input -->
                                  <input type="phone" class="form-control" placeholder="Phone" id="phone" name="phone" required>
                                </div>
                                <!-- Grid column -->
                              </div>
                              <!-- Grd row -->
                            </form>
                        </div>
                        <!-- end of row 2 -->

                    </div>
                </div>
              <!-- ************************** End of Your Info ***************************************** //-->
              <input type="hidden" name='vote_cost' id='vote_cost' />
              <div class="mt-3 text-center mt-5" id='vote_amount'>

              </div>




              <!-- *************************** Vote Button **************************************//-->

              <div class='text-center mt-2'>
                  <button type="submit" id='cast_vote' class="btn btn-success btn-rounded">Vote for <?php echo $model_recordset['name']; ?> </button>
              </div>


              <!-- ************************** End of Button ************************************* //-->


            </form>
            </div> <!-- end of column 2 //-->
        </div><!-- end of row 1//-->



        <!-- end of inner container //-->






    </div><!-- end of container fluid //-->

    <input type='hidden' id='modelNo' value="<?php echo $model_no; ?>" />
    <input type="hidden" id="modelName" value="<?php echo $model_recordset['name']; ?>" />
    <br/><br/>





    <?php
          //footer
          require_once("includes/footer.php");
     ?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    $(document).ready(function(){

      // Vote Options
      $(document).bind("click",".vote_option", function(){
        if (!$("input[name='votes_count']:checked").val()){
              $("#vote_amount").text("");
        }else{
              var vote_count = $("input[name='votes_count']:checked").val();
              var vote_cost = vote_count * 50;

              $("#vote_amount").html("<h4>" + vote_count + " Votes = <strike>N</strike>" + vote_cost + ".00</h4>");
              $("#vote_cost").val(vote_cost);
        }

      })

      //Btn Cast votes functinality
      $("#cast_vote").bind("click", function(){


           var isValid = true;
           var errMsg = '';


            //check if all values are checked
            if (!$("input[name='votes_count']:checked").val()){

               $("#vote_amount").text("");
               isValid = false;
               errMsg += "<i class='fas fa-exclamation'></i> Select your number of Votes <br/>"
            }else{
               $("#errMsg").text("");
               $("#errMsg").hide();

            }

            //------------- end of check --------------------------------------


            // check if firstname
            var firstname = $("#first_name").val();
            var lastname = $("#last_name").val();
            var email = $("#email").val();
            var phone = $("#phone").val();

            if (firstname==''){
               isValid = false;
               errMsg += "<i class='fas fa-exclamation'></i> Your First Name is missing <br/>";
            }

            if (lastname==''){
               isValid = false;
               errMsg += "<i class='fas fa-exclamation'></i> Your Last Name is missing <br/>";
            }

            if (email==''){
               isValid = false;
               errMsg += "<i class='fas fa-exclamation'></i> Your Email is missing <br/>";
            }



            if (phone==''){
               isValid = false;
               errMsg += "<i class='fas fa-exclamation'></i> Your Phone is missing <br/>";
            }








            // display Message
            if (isValid==false){
                $("#errMsg").show();
                $("#errMsg").html(errMsg);
            }else{
               payWithPaystack();
            }


      });



      // payStack functions





    });




  //---------------------------- PayStack Function  ---------------------------
  function payWithPaystack() {


    var vote_count = $("input[name='votes_count']:checked").val();
    var vote_cost = vote_count * 50;

    var firstname = $("#first_name").val();
    var lastname = $("#last_name").val();
    var phone = $("#phone").val();
    var modelNo = $("#modelNo").val();
    var modelName = $("#modelName").val();

    let handler = PaystackPop.setup({
      key: 'pk_live_47e6a018972582c78804b4bd32854de152e953f7', // Replace with your public key
      email: document.getElementById("email").value,
      amount: vote_cost  * 100,
      firstname: firstname,
      lastname: lastname,
      phone: phone,
      ref: modelNo+'-'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      // label: "Optional string that replaces customer email"
      onClose: function(){
        alert('Transaction has been cancelled.');
      },
      callback: function(response){
        let message = 'Payment complete! Reference: ' + response.reference;

        //window.location = "http://localhost/paystack/verify_transaction.php?reference="+response.reference;
        // Ajax Call
        $.ajax({
            url: 'verify_transaction.php?reference='+ response.reference,
            method: 'get',
            success: function (response) {
              // the transaction status is in response.data.status

              var message = '';
              response = response.trim();
              if (response=="success"){
                 message = "<h3> <i class='far fa-smile'></i> Hurray! You just added " + vote_count + " votes for " + modelName + "</h3>";
                 $("#successMsg").html(message);
                 $("#successMsg").show();
                 $("#errMsg").hide();

              }else{
                 message = "<h3><i class='far fa-frown'></i> Sorry! Your vote cast was not successful. Please try again. </h3>";
                 $("#errMsg").html(message);
                 $("#errMsg").show();
                 $("#successMsg").hide();

              }



            }
        });



        // End Of Ajax Call



      }
    });
    handler.openIframe();


  }







  //----------------------------- End of PaStack functionality --------------




</script>
