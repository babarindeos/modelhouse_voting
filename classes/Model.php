<?php
  class Model{



      private $model_id;
      private $model_no;
      private $name;
      private $picture;
      private $web_url;

      private $reference;
      private $lastname;
      private $firstname;
      private $email;
      private $phone;
      private $amount;
      private $vote_option;
      private $channel;

      private $votes;

      private $date_created;

      public function get_model_by_modelNo($modelNo){

        $this->model_no = $modelNo;
        //sqlQuery

        $sqlQuery = "Select * from models where model_no=:model_no";

        $QueryExecutor = new PDO_QueryExecutor();
        $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);


        // bind params
        $stmt->bindParam(":model_no", $this->model_no);
        //echo $sqlQuery;
        try{
            $stmt->execute();
        }catch(PDOException $e){
            $message = $e->getMessage();
            echo $message;
        }

        return $stmt;

        //return $stmt;

      }



      public function new_payment($fields){
          $this->reference = $fields['reference'];
          $this->lastname = $fields['lastname'];
          $this->firstname = $fields['firstname'];
          $this->email = $fields['email'];
          $this->phone = $fields['phone'];
          $this->amount = ($fields['amount']/100);
          $this->channel = $fields['channel'];

          $timestamp = date('Y-m-d H:i:s');
          $this->date_created = $timestamp;

          $this->vote_option = $this->amount/50;

          // $sqlQuery
          $sqlQuery = "Insert into payments set reference=:reference, lastname=:lastname, firstname=:firstname, email=:email, phone=:phone,
                       amount=:amount, vote_option=:vote_option, channel=:channel, date_paid=:date_paid";

          $QueryExecutor = new PDO_QueryExecutor();
          $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

          // bind Params
          $stmt->bindParam(":reference", $this->reference);
          $stmt->bindParam(":lastname", $this->lastname);
          $stmt->bindParam(":firstname", $this->firstname);
          $stmt->bindParam(":email", $this->email);
          $stmt->bindParam(":phone", $this->phone);
          $stmt->bindParam(":amount", $this->amount);
          $stmt->bindParam(":vote_option", $this->vote_option);
          $stmt->bindParam(":channel", $this->channel);
          $stmt->bindParam(":date_paid", $this->date_created);


          // execute
          $stmt->execute();



      }


      public function new_vote($fields){
        $this->reference = $fields['reference'];
        $explode_reference = explode("-",$this->reference);

        $this->model = $explode_reference[0];

        $this->amount = ($fields['amount']/100);
        $this->votes = $this->amount/50;

        $timestamp = date('Y-m-d H:i:s');
        $this->date_created = $timestamp;

        // sqlquery
        $sqlQuery = "Insert into votes set model=:model, votes=:votes, reference=:reference, date_created=:date_created";

        $QueryExecutor = new PDO_QueryExecutor();
        $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

        // bind params
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":votes", $this->votes);
        $stmt->bindParam(":reference", $this->reference);
        $stmt->bindParam(":date_created", $this->date_created);

        // execute
        $stmt->execute();



      }




}






?>
