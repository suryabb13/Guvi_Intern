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


// $email="smsunsurya@gmail.com";
// $password="13surya@sun";


  
   

$email = $_POST['email'];
$password = $_POST['pwd'];
// echo "$email";


  if($email!='' && $password!=''){

 
    // Prepare a statement to select the password for the given email
    $stmt = $conn->prepare("SELECT Email , Password  FROM Guvi WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($demail,$dbPassword);
    $stmt->fetch();
    $stmt->close();
    //  $data[]='';

    // echo "$dfname,$dlname,$ddob,$dgender,$demail,$dmobile,$dbPassword";

    if ($dbPassword === $password && $email === $demail) {
        
    

        $sessionId = bin2hex(random_bytes(16)); 
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setex($sessionId, 3600, $demail); 
        $redis->close();

             $data = array(
            "success" => true,
            "message" => "Login successful",
            "sec" => $sessionId
        );

             header('Content-Type: application/json');
             echo json_encode($data);

    }
    elseif($dbPassword != $password && $email === $demail){
        $data = array(
            "success" => false,
            "message" => "Password is wrong!!",
        );
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    
    else{
        $data = array(
            "success" => false,
            "message" => "Email & Password wrong!!",
        );
        header('Content-Type: application/json');
        echo json_encode($data);

    }
}

    $conn->close();
    

?>