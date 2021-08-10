<?php

//-------------- Abstract -----------------------------------

require_once("abstract/Database.php");

// -------------- Interface ---------------------------------

require_once("interface/DBInterface.php");
require_once("interface/ModelInterface.php");

//--------------- Classes -----------------------------------

require_once("classes/PDO_QueryExecutor.php");
require_once("classes/PDODriver.php");
require_once("classes/Model.php");


//-------------- Functions ---------------------------------
require_once("functions/FieldSanitizer.php");




if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{

    $reference = $_GET['reference'];

    $curl = curl_init();


    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($reference),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_live_0388c7fc87fce00913980343f1015dd0641cf049",
        "Cache-Control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      //echo $response;
      $result = json_decode($response);
    }


    if ($result->data->status=='success'){
       $status = $result->data->status;
       $reference = $result->data->reference;
       $fname = $result->data->customer->first_name;
       $lname = $result->data->customer->last_name;
       $email = $result->data->customer->email;
       $phone = $result->data->customer->phone;
       $amount = $result->data->amount;
       $channel = $result->data->channel;
       date_default_timezone_set('Africa/Lagos');
       $date_created = date('m/d/Y h:i:s a', time());

       $dataArray = array("reference"=>$reference,"lastname"=>$lname,"firstname"=>$fname,"email"=>$email,"phone"=>$phone,
       "amount"=>$amount, "channel"=>$channel, "date_created"=>$date_created);

       $model = new Model();
       $payment = $model->new_payment($dataArray);
       $vote = $model->new_vote($dataArray);
    }


    echo $result->data->status;




} // end of if isset($_SERVER['HTTP_X_REQUESTED_WITH'])






?>
