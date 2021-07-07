<?php
require_once "DbMan.php";
$query="Select 	HospitalID,Name,password from hospital where HospitalID= ?";
if($stmt=$conn->prepare($query))
{
    $stmt->bind_param('i',$_POST['hospitalId']);
    $stmt->execute();
    $result=$stmt->get_result();
    $result=$result->fetch_assoc();
    if($result['HospitalID']='')
    {
        die("This Hospital ID is not registered. ");
    }
}else{
    die("Fatal database/server error");
}

if($_POST['password'] == $result['password']){
    session_start();
    $_SESSION["hloggedin"] = true;
    $_SESSION["hid"] = $_POST['hospitalId'];
    $_SESSION["husername"] = $result["Name"]; 
    header("location:HospitalLogged.php");
}else{
    echo "Wrong ID/password please try again";
}
?>