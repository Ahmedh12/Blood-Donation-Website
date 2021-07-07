<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <title>Hospital</title>
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
    if(!isset($_SESSION['hloggedin']))
    {
        header('location:LogIn.php');
    }
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="#">
                <img src="Images/Hlogged.png" alt="Hospital" height="70px" width="85px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link text-light" href="#">
                        <?php echo $_SESSION['husername'] . " Hospital <br> ID: " . $_SESSION['hid'] ?><span
                            class="sr-only">(current)</span>
                    </a>
                </div>
                <span class="navbar-text ml-auto">
                    <a class="nav-item nav-link text-dark" href="LogOut.php">Log-Out</span></a>
                </span>
            </div>
        </nav>

        <div class="row ">
            <div class="col-md-3">
                <div class="row mt-3 ">
                    <div class="col-12 ">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Add_Donation()">Add Donation</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12 ">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Process_Request()">Process Transfusions</button>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Blood_Stock()">View Blood Stock</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Request_Severity()">Set Requests Severity</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Donors_Medical_History()">Donor Med. History</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block btn-outline-secondary"
                            onclick="Transfusion_History()">Transfusion History</button>
                    </div>
                </div>

            </div>

            <div class="col-md-8 ml-5 my-auto">

                <div id="Add_Donation" style='display:none'>
                    <h1 class="text-center my-3">Add Donation</h1>
                    <form action="HospitalLogged.php" method="post">
                        <div class="form-group">
                                <?php
                                    $today=strtotime(date('Y-m-d'));
                                    $result=$conn->query("Select name,donorid,blood_type,Last_donation_date from donor where DonorId not in(select donorid from diseases)");
                                    if($result->num_rows>0)
                                    {
                                        echo '<select class="form-control" id="DonorID" name="DonorID">';
                                        while($row = $result->fetch_assoc())
                                        {
                                            $Safedate=strtotime($row['Last_donation_date'].'+ 2 days');
                                            echo $date;
                                            if( $Safedate <= $today)
                                            {
                                                echo "<option value='".$row['donorid']."_".$row['blood_type']."'>".$row['name']."__".$row['donorid']."</option>";
                                            }
                                        }
                                        echo "</select>";
                                        echo "<Button class='btn btn-primary btn-block mt-5 ' value='Submit' name='AddDonation'>Add Donation</Button>";
                                        echo $row['Last_donation_date'];
                                    }else
                                    {
                                        echo <<<strt
                                                <div class="container mt-2">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <p><strong>No Donors Available Found.<strong></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                </div>
                                            strt;
                                    }
                                ?>
                            </div>
                        </form>
                    </div>

                <div id="Process_Request" style='display:none'>
                    <h1 class="text-center">Process Transfusion Request</h1>
                    <?php
                            $result=$conn->query("Select requestid,transfusioncause,severity from request where severity is not NULL and RequestID not in (Select RequestID from accepted)");
                            if($result->num_rows>0)
                            {
                                echo<<< strt
                                <table width=80% class="text-center mx-auto table" >
                                    <tr>
                                        <th >ID</th>
                                        <th>Cause</th>
                                        <th >Severity</th>
                                    </tr>
                                strt;

                                while($row=$result->fetch_assoc())
                                {
                                    echo "<tr>";
                                    echo "<td>".$row['requestid']."</td>";
                                    echo "<td>".$row['transfusioncause']."</td>";
                                    echo "<td>".$row['severity'] ."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                $result=$conn->query("Select requestid,transfusioncause,severity from request where severity is not NULL and RequestID not in (Select RequestID from accepted)");
                                echo "<form action='HospitalLogged.php' method='POST'>";
                                echo "<select class='form-control mt-1 mb-2' name='rid'>";
                                while($row=$result->fetch_assoc())
                                {
                                    echo "<option value=". $row['requestid'] .">".$row['requestid']. "</option>";
                                }
                                echo "</select>";
                                echo "<input type=submit class='btn btn-primary btn-block mt-5' name='Approve' value='Approve Request'>";
                                echo "</form>";

                            }else{
                                echo "No Pending Request";
                            }

                            if(isset($_POST['Approve']))
                            {
                                $query="select blood_type,qty,pa.patientid from patient pa,places pl,request r where pa.patientid=pl.patientid and r.requestid=pl.requestid and pl.requestid=".$_POST['rid'] ;
                                $result=$conn->query($query);
                                $row=$result->fetch_assoc();
                                $pbt=$row['blood_type'];
                                $pq=$row['qty'];
                                $pid=$row['patientid'];
                                $result=$conn->query("Select  h.name ,count(bloodgroup) AS count,bloodgroup from hospital h,donationhistory d,bloodbag b where h.hospitalid=d.hospitalid and d.bagid=b.bagid and b.used=0 and h.HospitalID=". $_SESSION['hid'] ." group by b.bloodgroup,h.name");
                                $bloodquantity=null;
                                while($row=$result->fetch_assoc())
                                {
                                    if(Blood_compatible($pbt,$row['bloodgroup']))
                                    {
                                        $bloodquantity["'".$row['bloodgroup']."'"]=$row['count'];
                                    }
                                    
                                }

                                if(isset($bloodquantity))
                                {   
                                    $flag=false;                         
                                    foreach($bloodquantity as $type=>$count)
                                    {
                                        if($count>=$pq)
                                        {
                                            echo <<<strt
                                            <div class="container mt-3">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <p class='text-center h5 mt-3 text-success'>The request will take place from donor(s) of blood types $type  to ' $pbt '.</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            </div>
                                            strt;
                                            $query="Select bloodbag.bagid,donorid from donationhistory,bloodbag where used= 0 and donationhistory.BagID = bloodbag.BagID and bloodgroup= ". $type;
                                            $result=$conn->query($query);
                                            for($i=0;$i<$pq;$i++)
                                            {
                                                $row=array();
                                                $row=$result->fetch_assoc();
                                                $conn->query("update bloodbag set used = 1 where bagid = " . $row['bagid']);
                                                $conn->query("insert into transfusionhistory values (". $pid .",".$row['bagid'].",". $_SESSION['hid'] .",'".date('Y-m-d')."')");
                                                $conn->query("insert into accepted values (". $_SESSION['hid'] .",". $_POST['rid']." ,'".date('Y-m-d')."')");
                                            }
                                            $flag=true;
                                            break;
                                        }
                                    }
                                    if($flag==false)
                                        {
                                             echo "<p class='text-center h4 mt-3 text-warning'>The Blood Quantity required for request id (". $_POST['rid'] .") is not available</p>";
                                        }        
                                }
                                else{
                                    echo "<p class='text-center h3 mt-3 text-warning'>The Blood Group required for this request is not available</p>";
                                }
                                echo '<script>document.getElementById("Process_Request").style.display = "block";</script>';
                            }
                    ?>

                </div>

                <div id="Blood_Stock" style='display:none'>
                    <h1 class="text-center">Blood Stock</h1>
                    <?php
                        $query="select bloodgroup,count(*) AS Bags from bloodbag bb,donationhistory dh where used = 0 and bb.bagid=dh.bagid and hospitalid= " . $_SESSION['hid'] . " group by (bloodgroup)";
                        $result=$conn->query($query);
                        echo <<<strt
                                <table width=100% class="text-center table" >
                                <tr>
                                  <th>Blood Type</th>
                                  <th>Bags Available</th>  
                                </tr>
                        strt;
                        while($row=$result->fetch_assoc())
                        {
                            
                            echo "<tr>";
                            echo     "<td>" . $row["bloodgroup"] . "</td>";
                            echo     "<td>" . $row["Bags"] . "</td>";
                            echo "</tr>" ;
                      
                        }
                        echo '</table>';
                        ?>
                </div>

                <div id="Request_Severity" style='display:none'>
                    <h1 class="text-center mb-2">Set Severity</h1>
                    <?php
                            $result=$conn->query("Select requestid,transfusioncause from request where severity is  NULL");
                            if($result->num_rows>0)
                            {
                                echo<<< strt
                                <table width=100% class="text-center table" >
                                    <tr>
                                        <th>ID</th>
                                        <th>Cause</th>
                                        <th><th>
                                    </tr>
                                strt;

                                while($row=$result->fetch_assoc())
                                {
                                    echo "<tr>";
                                    echo "<td>".$row['requestid']."</td>";
                                    echo "<td>".$row['transfusioncause']."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                
                                echo "<form action='HospitalLogged.php' method='POST'>";
                                echo "<select class='form-control mt-1 mb-2' name='rid'>";
                                $result=$conn->query("Select requestid,transfusioncause from request where severity is  NULL");
                                while($row=$result->fetch_assoc())
                                {
                                    echo "<option value=". $row['requestid'] .">".$row['requestid']. "</option>";
                                }
                                echo "</select>";
                                echo "<input type='number' class='form-control mt-2 mb-2'  max=10 min=0 name='sev' placeholder='Please enter the Severity of the case from 1 to 10' >";
                                echo "<input type=submit class='btn btn-primary btn-block' name='setSev' value='Set'>";
                                echo "</form>";

                            }else{
                                echo "No Pending Request";
                            }
                            
                            if(isset($_POST['setSev']))
                            {
                                $conn->query("update request set severity = ". $_POST['sev'] ." where requestid = ". $_POST['rid']);
                                echo "<script>document.getElementById('Request_Severity').style.display = 'block';</script>";
                            }
                        ?> 
                </div>

                <div id="Donors_Medical_History" style='display:none'>
                    <h1 class="text-center">Donor's Medical History</h1>
                    <form action="HospitalLogged.php" method="post">
                        <select class="form-control" id="DonorHistory" name='DonorHistory'>
                            <?php
                            $result = $conn->query("Select Name,donorID From donor");
                                if($result->num_rows>0)
                                {
                                
                                    while($row = $result->fetch_assoc())
                                    {
                                        echo "<option value= '".$row['donorID']."'>".$row['Name']." __ ".$row['donorID']."</option>";
                                    }
                                    echo "</select>";
                                    
                                }    
                            ?>
                            <Button class="btn btn-primary btn-block mt-3 mb-3 " value="Submit" name="DonorHistorysubmit">View Donor Medical Profile</Button>

                            <?php
                                if(isset($_POST['DonorHistorysubmit']))
                                {
                                    $result=$conn->query("select disease from diseases where donorid = ". $_POST['DonorHistory']);
                                    echo "<hr>";
                                    echo "<h4 class='text-center mb-1'>".$conn->query("select name from donor where donorid =".$_POST['DonorHistory'])->fetch_assoc()['name']."</h4>";
                                    if($result->num_rows>0)
                                    {
                                        echo <<<strt
                                                 <table width=70% class="text-center mx-auto table" >
                                                 <tr >
                                                 <th >Disease</th>
                                                 </tr>
                                                strt;
    
                                        while($row=$result->fetch_assoc())
                                        {
                                            echo "<tr>";
                                            echo     "<td >" . $row["disease"] . "</td>";
                                            echo "</tr>";
                                        }
                                            echo '</table>';
                                    }else
                                        {
                                            echo <<<strt
                                                <div class="container ">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <p><strong>This Donor has no fatal diseases.<strong></p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                </div>
                                                strt;
                                        }
                                    echo <<<strt
                                             <script>
                                                document.getElementById("Donors_Medical_History").style.display = "block"
                                             </script>
                                    strt;
                                }
                            ?>
                    </form>
                    
                </div>

                <div id="Transfusion_History" style='display:none'>
                    <h1 class="text-center">Transfusion History</h1>
                    <form action="HospitalLogged.php" method="post">
                        <label for="strtdate">Starting From</label>
                        <input type="date" required name='strtdate' class="form-control"><br>
                        <label for="strtdate">To</label>
                        <input type="date" required name='enddate' class="form-control"><br>
                        <input type="Submit" class="btn btn-primary btn-block" value="Show Transfusions"
                            name="TransHistory">
                    </form>

                    <?php
                            if(isset($_POST['TransHistory']))
                            {
                                $result=$conn->query("Select d.donorid,p.patientid ,p.name patient,COUNT(p.patientid) quantity,th.date,d.name donor from transfusionhistory th,patient p,donor d,bloodbag b,donationhistory dh where th.patientid=p.patientid and th.bagid=b.bagid and dh.bagid=b.bagid and d.donorid=dh.donorid and th.date between '". $_POST['strtdate'] . "' and '" . $_POST['enddate'] . "' and th.hospitalid = " . $_SESSION['hid'] ." group by p.Name,th.date,d.name,p.patientID,d.donorid");
                                if($result->num_rows>0)    
                                {   echo<<< strt
                                        <table width=90% class="text-center mx-auto my-3 table" >
                                        <tr >
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
                                        echo"<tr>";
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
                                }else{
                                    echo <<<strt
                                    <div class="container mt-3">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p><strong>No Transfusions Executed in this Period.<strong></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    </div>
                                strt;
                                }
                                    echo <<<strt
                                    <script>
                                        document.getElementById("Transfusion_History").style.display = "block";
                                    </script>
                                    strt;
                                    
                                }
                        ?>
                </div>

            </div>


        </div>

        <?php
        if(isset($_POST['AddDonation']))
        {
            $xplode=explode("_",$_POST['DonorID']); 
            $DonorId=$xplode[0];
            $blood_type=$xplode[1];

            $conn->query("update donor set last_donation_date = '".date("Y-m-d")."' where donorid = ".$DonorId);
            $conn->query("Insert into bloodbag (bloodgroup) values('".$blood_type."')");
            $conn->query("Insert into donationHistory values(".$DonorId.",".$conn->insert_id.",".$_SESSION['hid'].",'".date("Y-m-d")."')");

            echo <<<strt
                <div class="container mt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><strong>Donation Added Successfully.<strong></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                </div>
                strt;
        }
        ?>

<div class="row mt-3 mb-1">
            <div class="col-12 ">
                <footer class="page-footer font-small pt-2 footer-light bg-info text-light">
                    <div class="container-fluid">
                        <ul class="list-unstyled list-inline text-center">
                            <li class="list-inline-item text-center pt-1">
                                <h6>© 2020 Copyright: Team#2</h6>
                            </li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>
    </div>

<?php
function Blood_compatible($r,$d)
{
    if($r=='AB+')
    {
        return true;
    }elseif($r=='AB-')
    {
        if($d=='AB-'|| $d== 'A-'|| $d=='B-' || $d=='O-')
        {
            return true;
        }else
        {
            return false;
        }
    }elseif($r=='A+')
    {
        if($d=='A+'|| $d== 'A-'|| $d=='O+'|| $d=='O-')
        {
            return true;
        }else
        {
            return false;
        }
    }elseif ($r=='A-') 
    {
        if($d== 'A-'||  $d=='O-')
        {
            return true;
        }else
        {
            return false;
        } 
    }elseif($r=='B+')
    {
        if($d=='B+'|| $d== 'B-'|| $d=='O+'|| $d=='O-')
        {
            return true;
        }else
        {
            return false;
        }
    }elseif ($r=='B-') 
    {
        if($d== 'B-'||  $d=='O-')
        {
            return true;
        }else
        {
            return false;
        } 
    }elseif ($r=='O+') 
    {
        if($d== 'O+'||  $d=='O-')
        {
            return true;
        }else
        {
            return false;
        } 
    }elseif ($r=='O-') 
    {
        if($d=='O-')
        {
            return true;
        }else
        {
            return false;
        } 
    }
}


?>

        <script>
            function Add_Donation() {
                document.getElementById("Add_Donation").style.display = "block";
                document.getElementById("Process_Request").style.display = "none";
                document.getElementById("Blood_Stock").style.display = "none";
                document.getElementById("Request_Severity").style.display = "none";
                document.getElementById("Transfusion_History").style.display = "none";
                document.getElementById("Donors_Medical_History").style.display = "none";
            }

            function Process_Request() {
                document.getElementById("Add_Donation").style.display = "none";
                document.getElementById("Process_Request").style.display = "block";
                document.getElementById("Blood_Stock").style.display = "none";
                document.getElementById("Request_Severity").style.display = "none";
                document.getElementById("Transfusion_History").style.display = "none";
                document.getElementById("Donors_Medical_History").style.display = "none";
            }
            function Blood_Stock() {
                document.getElementById("Add_Donation").style.display = "none";
                document.getElementById("Process_Request").style.display = "none";
                document.getElementById("Blood_Stock").style.display = "block";
                document.getElementById("Request_Severity").style.display = "none";
                document.getElementById("Transfusion_History").style.display = "none";
                document.getElementById("Donors_Medical_History").style.display = "none";
            }
            function Request_Severity() {
                document.getElementById("Add_Donation").style.display = "none";
                document.getElementById("Process_Request").style.display = "none";
                document.getElementById("Blood_Stock").style.display = "none";
                document.getElementById("Request_Severity").style.display = "block";
                document.getElementById("Transfusion_History").style.display = "none";
                document.getElementById("Donors_Medical_History").style.display = "none";
            }
            function Transfusion_History() {
                document.getElementById("Add_Donation").style.display = "none";
                document.getElementById("Process_Request").style.display = "none";
                document.getElementById("Blood_Stock").style.display = "none";
                document.getElementById("Request_Severity").style.display = "none";
                document.getElementById("Transfusion_History").style.display = "block";
                document.getElementById("Donors_Medical_History").style.display = "none";
            }
            function Donors_Medical_History() {
                document.getElementById("Add_Donation").style.display = "none";
                document.getElementById("Process_Request").style.display = "none";
                document.getElementById("Blood_Stock").style.display = "none";
                document.getElementById("Request_Severity").style.display = "none";
                document.getElementById("Transfusion_History").style.display = "none";
                document.getElementById("Donors_Medical_History").style.display = "block";
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