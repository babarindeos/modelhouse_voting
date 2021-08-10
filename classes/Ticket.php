<?php

class Ticket{



   public function new_ticket($fields){
     $fullname = $fields['fullname'];
     $phone = $fields['phone'];
     $email = $fields['email'];
     $ticket_type = $fields['ticket_type'];
     $ticket_amount = $fields['ticket_amount'];
     $reference = $fields['reference'];
     $referrer = $fields['referrer'];

     //sqlQuery
     $sqlQuery = "Insert into tickets set fullname=:fullname, phone=:phone, email=:email, ticket_type=:ticket_type, ticket_amount=:ticket_amount,
                  reference=:reference, referrer=:referrer";

     $QueryExecutor = new PDO_QueryExecutor();
     $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

     //bind Params
     $stmt->bindParam(":fullname",$fullname);
     $stmt->bindParam(":phone", $phone);
     $stmt->bindParam(":email", $email);
     $stmt->bindParam(":ticket_type", $ticket_type);
     $stmt->bindParam(":ticket_amount", $ticket_amount);
     $stmt->bindParam(":reference", $reference);
     $stmt->bindParam(":referrer", $referrer);

     // execute
     $stmt->execute();
   }

   public function get_ticket_by_reference($reference){
      // $sqlQuery
      $sqlQuery = "Select * from tickets where reference=:reference";

      $QueryExecutor = new PDO_QueryExecutor();
      $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

      $stmt->bindParam(":reference", $reference);

      $stmt->execute();

      return $stmt;
   }

   public function update_status($reference, $status){
      // sqlQuery
      $sqlQuery = "Update tickets set status=:status where reference=:reference";

      $QueryExecutor = new PDO_QueryExecutor();
      $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

      $stmt->bindParam(":status", $status);
      $stmt->bindParam(":reference", $reference);

      $stmt->execute();

      return $stmt;
   }


}

?>
