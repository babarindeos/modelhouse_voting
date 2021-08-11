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


      public function get_models_by_range($start_model_id, $end_model_id){
        $sqlQuery = "Select id, model_no, name, picture, web_url, date_created from models where id>=".$start_model_id." and
                     id<".$end_model_id;

        $QueryExecutor = new PDO_QueryExecutor();
        $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

        $stmt->execute();

        return $stmt;
      }

      public function get_votes_count($model_no){
        $sqlQuery = "Select sum(votes) as 'votes' from votes group by model having model=:model";

        $QueryExecutor = new PDO_QueryExecutor();
        $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

        $stmt->bindParam(":model", $model_no);

        $stmt->execute();

        $result = 0;
        if ($stmt->rowCount()){
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $result = $result['votes'];
        }

        return $result;

      }


      public function get_votes_payment($_GET_URL_model_no){
        $sqlQuery = "Select v.id, v.model, v.votes, v.reference, p.lastname, p.firstname, p.email, p.phone, p.amount, p.vote_option,
                    p.channel, p.date_paid from votes v inner join payments p on v.reference=p.reference where v.model=:model order
                    by v.id desc";

        $QueryExecutor = new PDO_QueryExecutor();
        $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

        $stmt->bindParam(":model", $_GET_URL_model_no);

        $stmt->execute();

        return $stmt;

      }




}






?>
