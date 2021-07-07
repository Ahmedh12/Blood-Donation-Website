<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <title>Patient</title>
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
    if(!isset($_SESSION['ploggedin']))
    {
        header('location:LogIn.php');
    }
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="#">
                <img src="Images/plogged.svg" alt="patient" height="70px" width="85px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link text-light" href="#">Welcome:
                        <?php echo $_SESSION['pusername'] . "<br> ID: " . $_SESSION['pid'] ?><span
                            class="sr-only">(current)</span>
                    </a>
                </div>
                <span class="navbar-text ml-auto">
                    <a class="nav-item nav-link text-dark" href="LogOut.php">Log-Out</span></a>
                </span>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-3">
                <div class="row mt-4 ">
                    <div class="col-12 ">
                        <button class="btn btn-light btn-lg btn-block" onclick="Place_Request()">Place Request</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12 ">
                        <button class="btn btn-light btn-lg btn-block" onclick="Review_Requests_Status()">Review
                            Requests</button>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button class="btn btn-light btn-lg btn-block" onclick="Transfusion_History()">Transfusion
                            History</button>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-12">
                        <button class="btn btn-info btn-lg btn-block" onclick="Username()">Change Username</button>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-info btn-lg btn-block mt-2" onclick="Password()">Change Password</button>
                    </div>
                </div>
            </div>

            <div class="col-8 my-auto">

            <div id="Place_Request" style='display:none'>
                <h1 class="text-center">Place a Transfusion Request</h1>
                    <form action="PatientLogged.php" method="post">
                        <input type="text" name="Cause" id="cause" class="form-control mb-2 mt-4" required placeholder="Please Specify the cause for the transfusion">
                        <input type="number" max=5 min=1 name="qty" id="qty" class="form-control mb-2 mt-2" required placeholder="Please Specify the number of blood bags needed">
                        <input type="submit" value="Place Request" name="place_request" class="btn btn-primary btn-block mb-2 mt-5 bt">
                    </form>
            </div>

            <div id="Review_Requests_Status" style='display:none'>
                <h2 class="text-center">Requests Status</h2>
                <?php
                    $query="select transfusioncause,severity,date from places,request where places.RequestID = request.RequestID and places.patientID=". $_SESSION['pid'] ." and request.RequestID not in (select RequestID from accepted)";
                    $pendingRequests=$conn->query($query);
                    $query="select transfusioncause,severity,date from places,request where places.RequestID = request.RequestID and places.patientID=". $_SESSION['pid'] ." and request.RequestID  in (select RequestID from accepted)";
                    $acceptedRequests=$conn->query($query);
                    if($pendingRequests->num_rows>0 or $acceptedRequests->num_rows>0)
                    {
                        echo "<table width=80% class='mx-auto text-center table' >";
                        echo "<tr>";
                        echo "<th>Transfusion Cause</th>";
                        echo "<th>Severirty</th>";
                        echo "<th>Date</th>";
                        echo "<th>Status</th>";
                        echo "</tr>";
                        while($row=$pendingRequests->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$row['transfusioncause']."</td>";
                            echo "<td>".$row['severity']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>Pending</td>";
                            echo "</tr>";
                        }
                        while($row=$acceptedRequests->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$row['transfusioncause']."</td>";
                            echo "<td>".$row['severity']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>Executed</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        }else{
                            
                            echo '<p class="text-center text-danger my-3 h3">No requests Have been placed before</p>';
                        }
                         
                   
                ?>
            </div>

            <div id="Transfusion_History" style='display:none'>
                <h2 class="text-center">Transfusion History</h2>
                <?php
                  $query="select transfusioncause,p.date placed,a.date accepted,h.name from places p,request r,hospital h,accepted a where p.RequestID = r.RequestID and a.requestid=r.requestid and a.hospitalid=h.hospitalid and p.patientID = ". $_SESSION['pid'] ." and r.RequestID  in (select RequestID from accepted)";          
                  $result=$conn->query($query);
                  if($result->num_rows>0)
                  {
                    echo "<table class='mx-auto text-center table' >";
                    echo "<tr>";
                    echo "<th>Transfusion Cause</th>";
                    echo "<th>Hospital</th>";
                    echo "<th>Placed_On</th>";
                    echo "<th>Executed_On</th>";
                    echo "<th>Execution_Time</th>";
                    echo "</tr>";
                    
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>".$row['transfusioncause']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".date('d-m-Y',strtotime($row['placed']))."</td>";
                        echo "<td>".date('d-m-Y',strtotime($row['accepted']))."</td>";
                        $days = (strtotime($row['accepted'])-strtotime($row['placed']))/86400 ;
                        echo "<td>". $days ." day</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                   }  
                ?>
            </div>

            <div id="Username" class='mt-2' style="display:none">
                <h3 class="text-center">Update Username</h3>
                <form action="PatientLogged.php" method="post">
                    <input type="text" name="username" id="username" class="form-control mb-2 mt-2" required placeholder='Please Enter Your New Username'>
                    <input type="submit" class="btn btn-primary btn-block" value="Update Username" name="Update_Username">
                </form>
            </div>

            <div id="Password" class='mt-2' style="display:none">
                <h3 class="text-center">Update Password</h3>
                <form action="PatientLogged.php" method="post">
                    <input type="text" name="password" id="password" class="form-control mb-2 mt-2" required placeholder='Please Enter Your New Password's>
                    <input type="submit" class="btn btn-primary btn-block" value="Update Password" name="Update_Password" >
                </form>
            </div>

            
        </div>
    </div>
  


   

   
    <?php
        if(isset($_POST['Update_Username']))
        {
            //if($conn->query('update patient set name = "'.$_POST['username'].'" where patientid = '.$_SESSION['pid']))

            if($conn->query('call UpdatePatientUsername("'.$_POST['username'].'",'.$_SESSION['pid'].')'))
            {
                echo <<<strt
                            <div class="container mt-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p><strong>Username Updated Successfully.<strong></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            </div>
                            <script>document.getElementById("Username").style.display = "block";</script>
                        strt;

            }else{
                echo <<<strt
                            <div class="container mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <p><strong>Username Update Faild.<strong></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            </div>
                            <script>document.getElementById("Username").style.display = "block";</script>
                        strt;

            }

        }

        if(isset($_POST['Update_Password']))
        {
            //if($conn->query('update patient set password = "'.$_POST['password'].'" where patientid = '.$_SESSION['pid']))
            if($conn->query('call UpdatePatientPassword("'.$_POST['password'].'",'.$_SESSION['pid'].')'))
            {
                echo <<<strt
                            <div class="container mt-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p><strong>Password Updated Successfully.<strong></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            </div>
                            <script>document.getElementById("Username").style.display = "block";</script>
                        strt;

            }else{
                echo <<<strt
                            <div class="container mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <p><strong>Password Update Faild.<strong></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            </div>
                            <script>document.getElementById("Username").style.display = "block";</script>
                        strt;

            }

        }
    
        if(isset($_POST['place_request']))
        {
           if($conn->query("insert into request (transfusioncause,qty) values('".$_POST['Cause']."',". $_POST['qty'] .")"))
           {
               $lastid=$conn->insert_id;
               $conn->query("insert into places values(".$_SESSION['pid'].",".$lastid.",'".Date('Y-m-d')."')");
            echo <<<strt
                    <div class="container mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p><strong>Request Placed Successfully.<strong></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    </div>
                    <script>document.getElementById("Place_Request").style.display = "block";</script>
                    strt;
           }else
           {
            echo <<<strt
                    <div class="container mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p><strong>Error Placing Request<strong></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    </div>
                    <script>document.getElementById("Place_Request").style.display = "block";</script>
                    strt;
           }
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


    <script>
        function Place_Request() {
            document.getElementById("Place_Request").style.display = "block";
            document.getElementById("Review_Requests_Status").style.display = "none";
            document.getElementById("Transfusion_History").style.display = "none";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }

        function Review_Requests_Status() {
            document.getElementById("Place_Request").style.display = "none";
            document.getElementById("Review_Requests_Status").style.display = "block";
            document.getElementById("Transfusion_History").style.display = "none";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }
        function Transfusion_History() {
            document.getElementById("Place_Request").style.display = "none";
            document.getElementById("Review_Requests_Status").style.display = "none";
            document.getElementById("Transfusion_History").style.display = "block";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }
        function Username() {
            document.getElementById("Place_Request").style.display = "none";
            document.getElementById("Review_Requests_Status").style.display = "none";
            document.getElementById("Transfusion_History").style.display = "none";
            document.getElementById("Username").style.display = "block";
            document.getElementById("Password").style.display = "none";
        }
        function Password() {
            document.getElementById("Place_Request").style.display = "none";
            document.getElementById("Review_Requests_Status").style.display = "none";
            document.getElementById("Transfusion_History").style.display = "none";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "block";
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