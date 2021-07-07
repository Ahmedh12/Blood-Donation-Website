<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <title>Government Representative</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Raleway:ital,wght@1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.compat.css"
        integrity="sha512-5m1+8f8jC4ePfYvS39HmjqsYkkragJZaXV7kfreb5pytmTlDnZgXZ73JlYC0Ui25beVJMWLJq8AzDv4ZeXC9mg=="
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Index.css">
</head>
<body>
    <?php
    require_once "DbMan.php";
    session_start();
    if(!isset($_SESSION['gloggedin']))
    {
        header('location:LogIn.php');
    }
    ?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="#">
                <img src="Images/gov.png" alt="Blood Drop" height="70px" width="85px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link text-light" href="#">Welcome: <?php echo $_SESSION['gusername'] . "<br> ID: " . $_SESSION['gid'] ?><span class="sr-only">(current)</span></a>
                </div>
                <span class="navbar-text ml-auto">
                    <a class="nav-item nav-link text-dark" href="LogOut.php">Log-Out</span></a>
                </span>
            </div>
    </nav>
   
    <div class="row ">
        <div class="col-md-3" >
            <div class="row mt-5 ">
                <div class="col-12 ">
                    <button class="btn btn-light btn-lg btn-block" onclick="Add_Hospital()">Add Hospital</button>
                </div>
            </div>

            <div class="row mt-5 ">
                <div class="col-12 ">
                        <button class="btn btn-light btn-lg btn-block" onclick="Remove_Hospital()">Remove Hospital</button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <button class="btn btn-light btn-lg btn-block" onclick="Blood_content()">Blood Stock</button>
                </div>
            </div>

            <div class="row mt-5 ">
                <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block" onclick="Transfusion_List()">List Transfusions</button>
                </div>
            </div>

            <div class="row mt-5 ">
                <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block" onclick="Hospital_Details()">Hospital Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-8 my-auto mx-auto">
            <div  id="Add_Hospital" style='display:none'>
                <h1 class="text-center my-3">Add Hospital</h1>
                <form action="GovRepLogged.php" method="post">
                    <div class="form-group">
                        <input name='name' type="text" placeholder="Name" class="form-control mb-2"  required>
                        <input name='Rating' type="text" placeholder="Rating(1-5)" class="form-control mb-2"  required>
                        <select name="city" class="form-control mb-2" id="city">
                            <option value="Cairo">Cairo</option>
                            <option value="Giza">Giza</option>
                            <option value="Alexandria">Alexanderia</option>
                            <option value="Aswan">Aswan</option>
                            <option value="Suhag">Suhag</option>
                            <option value="Qena">Qena</option>
                            <option value="Portsaid">Portsaid</option>
                            <option value="Luxor">Luxor</option>
                        </select>
                        <input name='District' type="text" placeholder="District" class="form-control mb-2"  required>
                        <input name='password' type="text" placeholder="Password" class="form-control mb-2"  required>
                        <Button class="btn btn-primary btn-block" value="Submit" name="AddHospital">Add Hospital</Button>
                    </div>
                </form>
            </div>

            <div id="Remove_Hospital" style='display:none'>
                <h1 class="text-center my-3">Remove a hospital</h1>
                <form action="GovRepLogged.php" method="post">
                    <div class="form-group">
                        <select class="form-control" id="RemovalID" name='RemovalID'>
                        <?php
                        $result = $conn->query("Select Name,HospitalID From Hospital");
                            if($result->num_rows>0)
                            {
                            
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=".$row['HospitalID'].">".$row['Name']."</option>";
                                }
                                echo "</select>";
                            }else
                            {
                                echo <<<strt
                                        <div class="container">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <p><strong>No Hospitals Found.<strong></p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        </div>
                                    strt;
                            }
                        ?>
                        <Button class="btn btn-danger btn-block mt-5 " value="Submit" name="RemoveHospital">Delete Hospital</Button>
                    </div>
                </form>
            </div>

            <div id="Hospitals_Details" style='display:none'>
                <h1 class="text-center my-3">Hospital Details</h1>
                <?php
                   $result=$conn->query('select name,hospitalid,password from hospital where repid= '.$_SESSION['gid']); 
                   if($result->num_rows>0)
                   {
                       echo "<table class='table text-center'>";
                       echo "<tr>";
                       echo "<th>Name</th>";
                       echo "<th>ID</th>";
                       echo "<th>Password</th>";
                       echo "</tr>";
                       while($row=$result->fetch_assoc())
                       {
                           echo "<tr>";
                           echo "<td>".$row['name']." Hospital</td>";
                           echo "<td>".$row['hospitalid']."</td>";
                           echo "<td>".$row['password']."</td>";
                           echo "</tr>";
                       }
                       echo "</table>";
                   }else
                   {
                    echo <<<strt
                            <div class="container">
                            <div class="alert alert-info fade show" role="alert">
                            <p>No Hospitals are monitored by You.</p>
                            </div>
                            </div>
                        strt;
                   }
                ?>

            </div>

            <div id="Blood_content" style='display:none'>
                <h1 class="text-center my-3">Blood Content Stock</h1>
                <form action="GovRepLogged.php" method="post">
                    <div class="form-group">
                        <select class="form-control" id="HospitalBloodStock" name='HospitalBloodStock'>
                        <?php
                        $result = $conn->query("Select Name,HospitalID From Hospital");
                            if($result->num_rows>0)
                            {
                            
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=". $row['HospitalID'] .">".$row['Name']."</option>";
                                }
                                echo "</select>";
                            }else
                            {
                                echo <<<strt
                                        <div class="container">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <p><strong>No Hospitals Found.<strong></p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        </div>
                                    strt;
                            }
                        ?>
                            <Button class="btn btn-primary btn-block mt-3 " value="Submit" name="BloodStock">Get Blood Stock</Button>
                        <?php
                            if(isset($_POST["BloodStock"]))
                            {
                                $query="Select  h.name ,count(bloodgroup) AS count,bloodgroup from hospital h,donationhistory d,bloodbag b where h.hospitalid=d.hospitalid and d.bagid=b.bagid and used=0  and h.HospitalID=". $_POST['HospitalBloodStock'] ." group by b.bloodgroup,h.name";
                                $Hname=$conn->query('select name from hospital where hospitalid = '.$_POST['HospitalBloodStock'])->fetch_assoc()['name'];
                                echo "<p class='text-center text-info my-3 h3'>". $Hname ." Hospital </p>";
                                $result=$conn->query($query);
                                if($result->num_rows>0)
                                {
                                    echo <<< strt
                                            <hr>
                                            <table class="mt-3 text-center"  width=80% >
                                                <tr >
                                                    <th>Blood Group</th>
                                                    <th>Count</th>
                                                </tr>
                                        strt;
    
                                        while($row=$result->fetch_assoc())
                                        {
                                            
                                            echo    "<tr style=''>";
                                            echo        "<td>". $row['bloodgroup'] ."</td>";
                                            echo        "<td>". $row['count'] ."</td>";
                                            echo    "</tr>";
                                            
                                        }
                                    echo '</table>';
                                }else
                                {
                                    echo '<p class="text-center text-danger my-3 h3">No Blood Available at this center';
                                }
                                echo '<script>document.getElementById("Blood_content").style.display = "block";</script>';
                            }
                        ?>
                    </div>
                </form>
            </div>

            <div id="Transfusion_List" style='display:none'>
                <h1 class="text-center mt-2 mt-1">Transfusions History</h1>
                <form action="GovRepLogged.php" method="post">
                    <div class="form-group">
                        <select class="form-control" id="Hospitaltransfusions" name='Hospitaltransfusions'>
                        <?php
                        $result = $conn->query("Select Name,HospitalID From Hospital");
                            if($result->num_rows>0)
                            {
                            
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option value=". $row['HospitalID'] .">".$row['Name']."</option>";
                                }
                                echo "</select>";
                            }else
                            {
                                echo <<<strt
                                        <div class="container">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <p><strong>No Hospitals Found.<strong></p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        </div>
                                    strt;
                            }
                        ?>
                            <Button class="btn btn-primary btn-block mt-3 " value="Submit" name="HospitalTransfusion">List Transfusions</Button>
                        <?php
                            if(isset($_POST['HospitalTransfusion']))
                            {
                                $result=$conn->query("Select d.donorid,p.patientid ,p.name patient,COUNT(p.patientid) quantity,th.date,d.name donor from transfusionhistory th,patient p,donor d,bloodbag b,donationhistory dh where th.patientid=p.patientid and th.bagid=b.bagid and dh.bagid=b.bagid and d.donorid=dh.donorid  and th.hospitalid = '" . $_POST['Hospitaltransfusions'] ."' group by p.Name,th.date,d.name,p.patientID,d.donorid");
                                if($result->num_rows>0)    
                                {   
                                    $hname=$conn->query("Select Name From Hospital where hospitalid = ". $_POST['Hospitaltransfusions'])->fetch_assoc()['Name'];
                                    echo "<p class='text-center text-info my-3 h3'>". $hname ." Hospital </p><hr>";
                                    echo<<< strt
                                        <table width=90% class="text-center mx-auto my-3" >
                                        <tr style='border:1px black solid'>
                                        <th>Donor Name</th>
                                        <th>Donor ID</th>
                                        <th>patient Name</th>
                                        <th>Patient ID</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        </tr>
                                    strt;
                                    while($row=$result->fetch_assoc())
                                    {
                                        echo"<tr style='border:1px black solid'>";
                                        echo"<td>".$row['donor']."</td>";
                                        echo"<td>".$row['donorid']."</td>";
                                        echo"<td>".$row['patient']."</td>";
                                        echo"<td>".$row['patientid']."</td>";
                                        echo"<td>".$row['quantity']."</td>";
                                        echo"<td>".date('d-m-Y',strtotime($row['date']))."</td>";
                                        echo"</tr>";
                                    }
                                    echo<<< strt
                                         </table>
                                    strt;
                                }
                                else
                                {
                                    $hname=$conn->query("Select Name From Hospital where hospitalid = ". $_POST['Hospitaltransfusions'])->fetch_assoc()['Name'];
                                    echo <<<strt
                                            <div class="container mt-3">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        strt;
                                    echo  "<p><strong>No Transfusions Executed at ". $hname ." Hospital<strong></p>";
                                    echo<<< strt
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            </div>
                                        strt;
                                }
                                echo <<<strt
                                <script>
                                    document.getElementById("Transfusion_List").style.display = "block";
                                </script>
                                strt;
                            }
                        
                        ?>

            </div>

        </div>
    </div>
</div>

    <?php
    if(isset($_POST["AddHospital"]))
    {
        $query="Insert into hospital (Name,Rating,city,district,repID,password) values(?,?,?,?,?,?)";
        if($stmt=$conn->prepare($query))
        {
            $stmt->bind_param("sissis",$_POST['name'],$_POST['Rating'],$_POST['city'],$_POST['District'],$_SESSION['gid'],$_POST['password']);
            $stmt->execute();
            echo <<<strt
            <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>Hospital Added Successfully.<br><strong>Effect will Take place in your next login.<strong></p>
            <p>Hospital-ID: $stmt->insert_id</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
            strt;
        }else
        {
            echo <<<strt
            <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p><strong>Error Adding Hospital.<strong></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
            strt;
        }
    }

    if(isset($_POST["RemoveHospital"]))
    {
        $query="Delete from hospital where hospitalID = ".$_POST['RemovalID'] ;
        $conn->query($query);
        echo <<< strt
            <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p><strong>Hospital Deleted Successfully.<strong></p>
            <p>Effect will Take place in your next login.</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
            strt;
            echo $_POST['RemovalID'];
    }

    ?>

<?php require_once "FooterLogged.php"; ?>

<script>
    function Add_Hospital()
    {
        document.getElementById("Add_Hospital").style.display = "block";
        document.getElementById("Remove_Hospital").style.display = "none";
        document.getElementById("Blood_content").style.display = "none";
        document.getElementById("Transfusion_List").style.display = "none";
        document.getElementById("Hospitals_Details").style.display = "none";
    }
    
    function Remove_Hospital()
    {   
        document.getElementById("Add_Hospital").style.display = "none";
        document.getElementById("Remove_Hospital").style.display = "block";
        document.getElementById("Blood_content").style.display = "none";
        document.getElementById("Transfusion_List").style.display = "none";
        document.getElementById("Hospitals_Details").style.display = "none";
    }
    function Blood_content()
    {
        document.getElementById("Add_Hospital").style.display = "none";
        document.getElementById("Remove_Hospital").style.display = "none";
        document.getElementById("Blood_content").style.display = "block";
        document.getElementById("Transfusion_List").style.display = "none";
        document.getElementById("Hospitals_Details").style.display = "none";
    }
    function Transfusion_List()
    {
        document.getElementById("Add_Hospital").style.display = "none";
        document.getElementById("Remove_Hospital").style.display = "none";
        document.getElementById("Blood_content").style.display = "none";
        document.getElementById("Transfusion_List").style.display = "block";
        document.getElementById("Hospitals_Details").style.display = "none";
    }
    function Hospital_Details()
    {
        document.getElementById("Add_Hospital").style.display = "none";
        document.getElementById("Remove_Hospital").style.display = "none";
        document.getElementById("Blood_content").style.display = "none";
        document.getElementById("Transfusion_List").style.display = "none";
        document.getElementById("Hospitals_Details").style.display = "block";

    }

</script>


    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>