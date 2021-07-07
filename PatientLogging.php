<?php
require_once "DbMan.php";
$query="Select PatientID,Name,Email,password from patient where email= ?";
if($stmt=$conn->prepare($query))
{
    $stmt->bind_param('s',$_POST['Email']);
    $stmt->execute();
    $result=$stmt->get_result();
    $result=$result->fetch_assoc();
    if($result['Email']='')
    {
        die("This email is not registered please Sign-Up and try again.");
    }
}else{
    die("Fatal database/server error");
}

if($_POST['password'] == $result['password']){
    session_start();
    $_SESSION["ploggedin"] = true;
    $_SESSION["pid"] = $result["PatientID"];
    $_SESSION["pusername"] = $result["Name"]; 
    header("location:PatientLogged.php");
}else{
    echo "Wrong Email/password please try again";
}


?>