<?php

$servername = "10.4.253.112";
$username = "connect";
$password = "Projet_BTS2SNIR";
$dbname = "projet_btssnir";
  
// connect with database demo
$conn = new mysqli($servername, $username, $password, $dbname);
  
 // an array to display response
 $response = array();
 // on below line we are checking if the parameter send is id or not.
 if($_POST['id']){
     // if the parameter send from the user id id then
     // we will search the item for specific id.
     $id = $_POST['id'];
        //on below line we are selecting the course detail with below id.
     $stmt = $conn->prepare("SELECT nom, prenom FROM eleve");
     $stmt->bind_param("s",$id);
     $result = $stmt->execute();
   // on below line we are checking if our 
   // table is having daata with specific id. 
   if($result == TRUE){
         // if we get the respone then we are displaying it below.
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         // on below line we are getting our result. 
         $stmt->store_result();
         // on below line we are passing parameters which we want to get.
         $stmt->bind_result($courseName,$courseDescription,$courseDuration);
         // on below line we are fetching the data. 
         $stmt->fetch();
         // after getting all data we are passing this data in our array.
         $response['courseName'] = $courseName;
         $response['courseDescription'] = $courseDescription;
         $response['courseDuration'] = $courseDuration;
     } else{
         // if the id entered by user donot exist then 
         // we are displaying the error message
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      // if the user donot adds any paramter while making request
      // then we are displaying the error as insufficient parameters.
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 // at last we are printing 
 // all the data on below line. 
 echo json_encode($response);
?>