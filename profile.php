<?php
$db_server="localhost";
$db_user="root";
$db_pass="";
$db_name="project1";
$conn="";
try{
$conn=mysqli_connect($db_server,
                     $db_user,
                     $db_pass,
                     $db_name);
                    
}


 catch(mysqli_sql_exception){
    echo "can't connected";
 }

//  $type = $_POST['type'];


 $fname =$_POST['fname'];
$lname =$_POST['lname'];
$mobile =$_POST['mobile'];
$dob =$_POST['dob'];
$email =$_POST['email'];
$password =$_POST['pwd'];
$gender =$_POST['gender'];
// $udata[]='';
// echo $fname,$lname,$mobile,$dob,$email,$password,$gender;

$stmt = $conn->prepare("UPDATE Guvi SET Fname=?, Lname=? , Dob=?, Gender=?, Mobile=? ,  Password=? WHERE Email=?");
$stmt->bind_param('sssssss', $fname , $lname ,$dob ,$gender ,$mobile ,$password , $email);
$stmt->execute();
$stmt->close();


echo "Updated successfully";


$conn->close();
?> 