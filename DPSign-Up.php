<?php
require_once "DbMan.php";
if(isset($_POST['DSubmit']))
{
    $query="INSERT INTO donor (Name,sex,age,Address,Ethenecity,Email,password,PhoneNumber,blood_type) values(?,?,?,?,?,?,?,?,?)";
    if($_POST['Password']==$_POST['PasswordCheck'])
    {
        if($stmt=$conn->prepare($query))
        {
            $stmt->bind_param("ssissssis",$_POST['name'],$_POST['Gender'],$_POST['Age'],$_POST['Address'],$_POST['Ethenecity'],$_POST['Email'],$_POST['Password'],$_POST['PhoneNumber'],$_POST['bloodgroup']);
            $stmt->execute();
            $last_id = $conn->insert_id;
            $checkbox1 = $_POST['chkl'];
            for ($i=0; $i<sizeof($checkbox1);$i++) {  
                $query="Insert into diseases values ('".$checkbox1[$i]."',".$last_id.")";  
                $conn->query($query);
                }  
            header('location:LogIn.php');
        }else
        {
            echo "<h1 class='text-center'> Error Signing Up </h1>";
        }
    }else
    {
        echo "Passwords Entered Doesnot match";
    }
}else if(isset($_POST['PSubmit']))
{
    $query="INSERT INTO patient (Name,sex,age,Address,Ethenecity,Email,password,PhoneNumber,blood_type) values(?,?,?,?,?,?,?,?,?)";
    if($_POST['Password']==$_POST['PasswordCheck'])
    {
        if($stmt=$conn->prepare($query))
        {
            $stmt->bind_param("ssissssis",$_POST['name'],$_POST['Gender'],$_POST['Age'],$_POST['Address'],$_POST['Ethenecity'],$_POST['Email'],$_POST['Password'],$_POST['PhoneNumber'],$_POST['bloodgroup']);
            $stmt->execute();
            header('location:LogIn.php');
        }else
        {
            echo <<<strt
            <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p><strong>Error Signing Up.<strong></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
            strt;
        }
    }else
    {
        echo <<<strt
        <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p><strong>Password entered doesn't match<strong></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        strt;
    }
}
?>