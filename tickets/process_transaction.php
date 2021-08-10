<?php
    session_start();
    //echo "Rave next stage";

    require_once("../interface/DBInterface.php");

    require_once("../abstract/Database.php");
    require_once("../classes/PDO_QueryExecutor.php");

    require_once("../classes/Model.php");
    require_once("../classes/Ticket.php");

    require_once("../functions/Encrypt.php");



    //  echo $_SESSION['ticket_amount'];
    $ticket = new Ticket();
    $get_ticket = $ticket->get_ticket_by_reference($_GET['txref']);
    $ticket_info = $get_ticket->fetch(PDO::FETCH_ASSOC);
    $ticket_amount = $ticket_info['ticket_amount'];


    if (isset($_GET['txref'])) {
                    if (isset($_GET['cancelled']) && $_GET['cancelled']=='true'){
                          $chargeResponsecode = '';
                          header("location: tickets.php");
                    }else{
                              $ref = $_GET['txref'];
                              $amount = $ticket_amount; //Correct Amount from Server
                              $currency = "NGN"; //Correct Currency from Server

                              $query = array(
                                  "SECKEY" => "FLWSECK_TEST-b4c73cd11bb6b23f3ae92468c348c5b0-X",
                                  "txref" => $ref
                              );

                              $data_string = json_encode($query);

                              $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
                              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                              curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                              curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                              $response = curl_exec($ch);

                              $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                              $header = substr($response, 0, $header_size);
                              $body = substr($response, $header_size);

                              curl_close($ch);

                              $resp = json_decode($response, true);

                              $paymentStatus = $resp['data']['status'];
                              $chargeResponsecode = $resp['data']['chargecode'];
                              $chargeAmount = $resp['data']['amount'];
                              $chargeCurrency = $resp['data']['currency'];

                              echo "paymentStatus: ".$paymentStatus;
                              echo "<br/>Charge Responsecode: ".$chargeResponsecode;
                              echo "<br/>Charge Amount: ".$chargeAmount;
                              echo "<br/>charge Currency: ".$chargeCurrency;

                              if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
                                // transaction was successful...
                                   // please check other things like whether you already gave value for this ref
                                // if the email matches the customer who owns the product etc
                                //Give Value and return to Success page
                                  //echo "Successful";
                                  $update_ticket = $ticket->update_status($_GET['txref'], $paymentStatus);
                                  header("location: payment_succeed.php?q=".$_GET['txref']);
                              }else{
                                  //Dont Give Value and return to Failure page
                                  //echo "Failed";
                                  $update_ticket = $ticket->update_status($_GET['txref'], $paymentStatus);
                                  header("location: payment_failed.php?q=".$_GET['txref']);
                              }
                    }



    }
        else {
      die('No reference supplied');
    }




?>
