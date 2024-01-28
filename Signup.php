
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

$fname =$_POST['fname'];
$lname =$_POST['lname'];
$mobile =$_POST['mobile'];
$dob =$_POST['dob'];
$email =$_POST['email'];
$password =$_POST['pwd'];



if($email!=''){
$query = "SELECT COUNT(*) FROM Guvi WHERE Email = ?";

// prepare the query, bind the variable and execute
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();

// grab the results
$stmt->bind_result($numRows);
$stmt->fetch();
$stmt->close();

if ($numRows) {
    echo "Entered email is already registered ";
} 

else 
{

     $instmt = $conn->prepare("INSERT INTO Guvi( Fname , Lname , Mobile , Password ,Email ,Dob) VALUES (? , ? , ? , ? , ? , ?)");
     $instmt->bind_param("ssssss",$fname, $lname, $mobile , $password ,$email ,$dob);
     $instmt->execute();

     $instmt->close();
     echo "Record submitted successfully";

}
}
else{
    echo "fill the form submitted successfully";
}

?>
