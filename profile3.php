<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$db_server="localhost";
$db_user="root";
$db_pass="";
$db_name="project1";
$conn="";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

     

$email = $_POST['email'];


  if($email!=''){

 
    // Prepare a statement to select the password for the given email
    $stmt = $conn->prepare("SELECT Fname, Lname, Dob, Gender , Email , Mobile, Password  FROM Guvi WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($dfname,$dlname,$ddob,$dgender,$demail,$dmobile,$dbPassword);
    $stmt->fetch();
    $stmt->close();
  

        
        $fun = array(
            "success" => true,
            "message" => "Login successful",
            "fname" => $dfname,
            "lname" => $dlname,
            "dob" => $ddob,
            "gender" => $dgender,
            "mobile" => $dmobile,
            "password" => $dbPassword,
            "email" => $demail
        );
        

        header('Content-Type: application/json');
        echo json_encode($fun);
    }
   


    $conn->close();
    

?>
