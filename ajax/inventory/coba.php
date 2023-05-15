<?php

    session_start();
    include('../../db.php');
// class customException extends Exception {
//     public function errorMessage() {
//       //error message
//       $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
//       .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
//       return $errorMsg;
//     }
//   }
  
//   $email = "someone@example...com";
  
//   try {
//     //check if
//     if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
//       //throw exception if email is not valid
//       throw new customException($email);
//     }
//   }
  
//   catch (customException $e) {
//     //display custom message
//     echo $e->errorMessage();
//   }

$properties = [
  '1' => '1',
  '2' => '2',
  '3' => '3',
];

$ref_table = "numbers";
$postRef_result = $database->getReference($ref_table)->push($properties);

$pembelianstoknewid = $postRef_result->getKey();
echo 'New data ID: ' . $pembelianstoknewid;

?>