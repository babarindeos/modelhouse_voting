<?php
class Payment implements PaymentInterface{


  public function getInitialPayData($collectionAPP, $regNumber){

    // $sqlQuery
    $sqlQuery = "SELECT surname, firstname, othername, mobile, email, transactionID, referenceNo, collectionPrefix, amount, commission, dateCreated,
                 registered, confirmed, filed FROM initialPayData WHERE filed = 0 AND referenceNo LIKE :collectionAPP AND custID =:regNumber";

    // pdo Object
    $QueryExecutor = new PDO_QueryExecutor();
    $stmt = $QueryExecutor->customQuery()->prepare($sqlQuery);

    //bind parameters
    $stmt->bindParam(":collectionAPP", '%{$collectionAPP}%');
    $stmt->bindParam(":regNumber", $regNumber);

    // execute PDO
    $stmt->execute();

    return $stmt;
  }


}



?>
