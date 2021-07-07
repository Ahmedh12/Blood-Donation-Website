<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="100">
    <title>Donor</title>
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
    if(!isset($_SESSION['dloggedin']))
    {
        header('location:LogIn.php');
    }
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                <a class="navbar-brand" href="#">
                    <img src="Images/dlogged.png" alt="Blood Drop" height="70px" width="85px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link text-light" href="#">Welcome: <?php echo $_SESSION['dusername'] . "<br> ID: " . $_SESSION['did'] ?><span class="sr-only">(current)</span></a>
                    </div>
                    <span class="navbar-text ml-auto">
                        <a class="nav-item nav-link text-dark" href="LogOut.php">Log-Out</span></a>
                    </span>
                </div>
        </nav>
         
         <div class="row">

            <div class="col-md-4">

            </div>
            <div class="col-md-7">
                <?php
                    $result=$conn->query('select Last_donation_date from donor where donorid = ' . $_SESSION['did']);
                    $date=$result->fetch_assoc()['Last_donation_date'];
                    $nxtDonDate = date('d-m-Y', strtotime($date . ' + 2 days'));
                    if(strtotime($nxtDonDate) > strtotime(date('d-m-Y')))
                    {
                        echo "<h3 class='text-center mt-2 mb-2 text-info'>Your Next Safe Donation Date is (" . $nxtDonDate . ")</h3>";
                    }
                    else
                    {
                        echo "<h3 class='text-center mt-2 mb-2 text-success'>You Can Donate Safely</h3>";
                    }
                    
                ?>
                
            </div>
         </div>

<div class="row">
    <div class="col-md-3">
        <div class="row mt-5 ">
                <div class="col-12 ">
                    <button class="btn btn-light btn-lg btn-block" onclick="Donation_History()">Donation History</button>
                </div>
        </div>

        <div class="row mt-5 ">
            <div class="col-12 ">
                <button class="btn btn-light btn-lg btn-block" onclick="Donation_Centers()">Donation Centers</button>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <button class="btn btn-light btn-lg btn-block" onclick="Medical_History()">Edit Medical History</button>
            </div>
        </div>

        <div class="row mt-5 ">
            <div class="col-12">
                <button class="btn btn-info btn-lg btn-block" onclick="Username()">Change Username</button>
            </div>
        
            <div class="col-12">
                <button class="btn btn-info btn-lg btn-block mt-2" onclick="Password()">Change Password</button>
            </div>
        </div>
    </div>


    <div class="col-md-8 my-auto">

        <div id="Donation_History" class='mt-2' style="display:none">
            <h2 class="text-center">Donation History</h2>
            <?php
                $result = $conn->query('Select Date, h.name from donationhistory d,hospital h where h.hospitalid=d.hospitalid and donorid = '. $_SESSION['did']) ;
                if($result->num_rows > 0)
                {
                    echo "<table width=100% class='text-center table'>";
                    echo "<tr>";
                    echo "<th>Hospital</th>";
                    echo "<th>Date</th>";
                    echo "</tr>";
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>". $row['name'] ."</td>";
                        echo "<td>". $row['Date'] ."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else
                {
                    echo "<h2 class='text-center' >You have Not donated Yet Hurry UP</h2> <h3 class='text-center'>الاجر عند الله</h3>";
                }
                
            ?>

        </div>

        <div id="Donation_Centers" class='mt-2' style="display:none">
                <h2 class="text-center">Donation Centers</h2>

                    <form action="DonorLogged.php" method="post">
                        <select name="city" class="form-control" id="city">
                            <option value="Cairo">Cairo</option>
                            <option value="Giza">Giza</option>
                            <option value="Alexandria">Alexanderia</option>
                            <option value="Aswan">Aswan</option>
                            <option value="Suhag">Suhag</option>
                            <option value="Qena">Qena</option>
                            <option value="Portsaid">Portsaid</option>
                            <option value="Luxor">Luxor</option>
                        </select>
                        <input type="submit"  class='btn btn-primary btn-block my-3' name='citysubmit' value='View Centers'> 
                    </form>

                <?php
                if(isset($_POST['city']))
                {
                    $result = $conn->query('Select name,city,district from hospital where city = "' . $_POST['city'] .'"') ;
                    
                    if($result->num_rows > 0)
                    {
                        echo "<p class='h3 text-left'>The donation centers at " . $_POST['city'] . "</p>";
                        echo "<table width=70% class='text-left mx-auto table'>";
                        echo "<tr>";
                        echo "<th>Hospital</th>";
                        
                        echo "<th>District</th>";
                        echo "</tr>";
                        while($row=$result->fetch_assoc())
                        {
                            echo "<tr >";
                            echo "<td>". $row['name'] ."</td>";
                            
                            echo "<td>". $row['district'] ."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else
                    {
                    echo '<p class="text-center text-danger my-3 h3">No Donation Centers are avaialbe at ' . $_POST['city']. '</p>';
                    }
                    echo "<script>document.getElementById('Donation_Centers').style.display = 'block';</script>";
                }
                    
                ?>
        </div>

        <div id="Medical_History" class='mt-2' style="display:none">
            <h2 class="text-center">Edit Medical History</h2>
            <form action="DonorLogged.php" method="post">
            <?php
            $diagnosed=array();
            $result=$conn->query("select disease from diseases where donorid = ". $_SESSION['did']);
            if($result->num_rows>0)
            {
                echo <<<strt
                            <table width=80% class="text-center mx-auto table" >
                            <tr >
                            <th >Disease</th>
                            <th>Cured</th>
                            </tr>
                        strt;
                        $i=0;
                while($row=$result->fetch_assoc())
                {
                    $i+=1;
                    $diagnosed[$i]=$row["disease"];
                    echo "<tr>";
                    echo     "<td >" . $row["disease"] . "</td>";
                    echo     "<td ><input  type='checkbox' value= '". $row["disease"] ."' name='chklrem[]' > </td>";
                    echo "</tr>";
                }
                    echo '</table>';
            }else
                {
                    echo <<<strt
                        <div class="container ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p><strong>You have no fatal diseases.<strong></p>
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
            ?>

                <p class="h5 mt-3" > Have You been diagnosed with any of the diseases listed below? <span class="h6">(Select all that apply) </span></p>
            
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="AIDS" value="AIDS" name="chkl[]">         
                <label class="form-check-label" for="AIDS">AIDS</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Hepatitis" value="Hepatitis" name="chkl[]">
                <label class="form-check-label" for="Hepatitis">Hepatitis</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Malaria" value="Malaria" name="chkl[]">
                <label class="form-check-label" for="Malaria">Malaria</label>
                </div>
                <div class="form-check ">
                <input class="form-check-input" type="checkbox" id="T_Lymphotropic_virus-1" value="T_Lymphotropic_virus-1" name="chkl[]">
                <label class="form-check-label" for="T_Lymphotropic_virus-1">T Lymphotropic virus-1</label>
                </div>
                <input type="submit" value="Update Medical History" class='btn btn-primary btn-block mt-3' name='updatedMedHistory'>
                 </form>

            <?php
                if(isset($_POST['updatedMedHistory']))
                {
                    $checkbox1 = $_POST['chkl'];
                    $checkbox2 = $_POST['chklrem'];
                    if(isset($checkbox1))
                    {
                        for ($i=0; $i<sizeof($checkbox1);$i++) { 
                            if(!in_array($checkbox1[$i],$diagnosed)) 
                            {
                                $query="Insert into diseases values ('".$checkbox1[$i]."',".$_SESSION['did'].")";  
                                $conn->query($query);
                            }
                        }    
                    }
                    if(isset($checkbox2))
                    {
                        for ($i=0; $i<sizeof($checkbox2);$i++){
                            $query="delete from diseases where donorid = ". $_SESSION['did'] ." and disease = '". $checkbox2[$i]. "'";
                            $conn->query($query);
                        }
                    }   
                }
            ?>
        </div>

    <div id="Username" class='mt-2' style="display:none">
        <h3 class="text-center">Update Username</h3>
        <form action="DonorLogged.php" method="post">
            <input type="text" name="username" id="username" class="form-control mb-2 mt-2" required placeholder='Please Enter Your New Username'>
            <input type="submit" class="btn btn-primary btn-block" value="Update Username" name="Update_Username">
        </form>
    </div>

    <div id="Password" class='mt-2' style="display:none">
        <h3 class="text-center">Update Password</h3>
        <form action="DonorLogged.php" method="post">
            <input type="text" name="password" id="password" class="form-control mb-2 mt-2" required placeholder='Please Enter Your New Password's>
            <input type="submit" class="btn btn-primary btn-block" value="Update Password" name="Update_Password" >
        </form>
    </div>

    <?php
        if(isset($_POST['Update_Username']))
        {
            //if($conn->query('update donor set name = "'.$_POST['username'].'" where donorid = '.$_SESSION['did']))
            if($conn->query('call UpdateDonorUsername("'.$_POST['username'].'",'.$_SESSION['did'].')'))
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
            //if($conn->query('update donor set password = "'.$_POST['password'].'" where donorid = '.$_SESSION['did']))
            if($conn->query('call UpdateDonorPassword("'.$_POST['password'].'",'.$_SESSION['did'].')'))
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
    
    
    ?>


</div>
</div>
</div>

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
        function Donation_History() {
            document.getElementById("Donation_History").style.display = "block";
            document.getElementById("Donation_Centers").style.display = "none";
            document.getElementById("Medical_History").style.display = "none";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }

        function Medical_History() {
            document.getElementById("Donation_History").style.display = "none";
            document.getElementById("Donation_Centers").style.display = "none";
            document.getElementById("Medical_History").style.display = "block";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }
        function Donation_Centers() {
            document.getElementById("Donation_History").style.display = "none";
            document.getElementById("Donation_Centers").style.display = "block";
            document.getElementById("Medical_History").style.display = "none";
            document.getElementById("Username").style.display = "none";
            document.getElementById("Password").style.display = "none";
        }
        function Username() {
            document.getElementById("Donation_History").style.display = "none";
            document.getElementById("Donation_Centers").style.display = "none";
            document.getElementById("Medical_History").style.display = "none";
            document.getElementById("Username").style.display = "block";
            document.getElementById("Password").style.display = "none";
        }
        function Password() {
            document.getElementById("Donation_History").style.display = "none";
            document.getElementById("Donation_Centers").style.display = "none";
            document.getElementById("Medical_History").style.display = "none";
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