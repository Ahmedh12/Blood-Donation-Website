<?php
require_once "DbMan.php";

$email = ""; 
$password = "";

if(isset($_POST["email"])){
    $email=$_POST["email"];
}else {die("Invalid Email");}

if(isset($_POST["password"])){
    $password=$_POST["password"];
}else {die("Invalid password");}

$sql="select * from GovernmentRepresentative where email = ?";
if($stmt=$conn->prepare($sql)){
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    $result=$result->fetch_assoc();
    if($result['Email']='')
    {
        die("This email is not registered please Sign-Up and try again.");
    }
}else{
    echo "Fatal database/server error";
}

if($password == $result['password']){
    session_start();
    $_SESSION["gloggedin"] = true;
    $_SESSION["gid"] = $result["ID"];
    $_SESSION["gusername"] = $result["Name"]; 
    header("location:GovRepLogged.php");
}else{
    echo "Wrong Email/password please try again";
}

?>