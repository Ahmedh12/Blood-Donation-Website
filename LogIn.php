<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
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
<?php require_once "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-4 mt-2  ">

            <div class="row my-4">
                <button class="btn btn-white" onclick="Patient()"> 
                    <img src="images/patient.png" height=100px width=120px alt="patient">
                </button>
            
                <button class="btn btn-white" onclick="Donor()"> 
                    <img src="images/donorSign.png" height=100px width=110px alt="Donor">
                </button>
            </div>

            <div class="row my-4">
                <button class="btn btn-white" onclick="Hospital()"> 
                    <img src="images/Hospital.png" height=130px width=120x alt="Hospital">
                </button>
    
                <button class="btn btn-white" onclick="Gov()"> 
                    <img src="images/gov.png" height=100px width=110px alt="Government">
                </button>
            </div>

        </div>

    <div class="col-7 my-auto">

        <div id="patient" style="display:none">
            <form action="PatientLogging.php" method="post">
                <div class="form-group">
                    <h2>Patient Login</h2>
                    <hr>
                    <input type="email" placeholder="Plaease Enter Your Email" class="form-control mb-2" name='Email' required>
                    <input type="password" placeholder="Please Enter Your Password" class="form-control mb-2" name='password' required>
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <input type="Submit" class="btn btn-primary mx-auto" value="LogIn"> 
                        </div>            
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-12 mx-auto">
                        <p class="text-dark">
                        Does Not Have an Account <a href="SignUp.php">SignUp</a>
                        </p>
                    </div>
                </div>  
            </form>
        </div>

        <div id="Donor" style="display:none">
        <form action="DonorLogging.php" method="post">
                <div class="form-group">
                    <h2>Donor Login</h2>
                    <hr>
                    <input type="Email" placeholder="Plaease Enter Your Email" class="form-control mb-2" name='Email' required>
                    <input type="password" placeholder="Please Enter Your Password" class="form-control mb-2" name='password' required> 
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <input type="Submit" class="btn btn-primary mx-auto" value="LogIn"> 
                        </div>            
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-12 mx-auto">
                        <p class="text-dark">
                        Does Not Have an Account <a href="SignUp.php">SignUp</a>
                        </p>
                    </div>
                </div>  
            </form>
        </div>

        <div id="Hospital" style="display:none">
            <form action="HospitalLogging.php" method="post">
                <div class="form-group">
                    <h2>Hospital Login</h2>
                    <hr>
                    <input type="text" placeholder="Plaease Enter Your Hospital ID" class="form-control mb-2" name='hospitalId' required>
                    <input type="password" placeholder="Please Enter Your Password" class="form-control mb-2" name='password' required>
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <input type="Submit" class="btn btn-primary mx-auto" value="LogIn"> 
                        </div>            
                    </div>
                </div>   
            </form>
        </div>

        <div class="form-group" id="Government" style="display:none">
            <form action="GovRepLogging.php" method="post">
                <div class="form-group">
                    <h2>Government Representative Login</h2>
                    <hr>
                    <input name="email"  type="email" placeholder="Please Enter Your email" class="form-control mb-2"  required>
                    <input name="password" type="password" placeholder="Please Enter Your Password" class="form-control mb-2" required>
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <input type="Submit" class="btn btn-primary mx-auto" value="LogIn"> 
                        </div>            
                    </div>
                </div>   
            </form>
        </div>
</div>
</div>
</div>
<?php
require_once "footer.php";
?>


<script>
function Patient() {
                document.getElementById("patient").style.display = "block";
                document.getElementById("Donor").style.display = "none";
                document.getElementById("Hospital").style.display = "none";
                document.getElementById("Government").style.display = "none";
            }
function Donor() {
                document.getElementById("patient").style.display = "none";
                document.getElementById("Donor").style.display = "block";
                document.getElementById("Hospital").style.display = "none";
                document.getElementById("Government").style.display = "none";
            }
function Hospital() {
                document.getElementById("patient").style.display = "none";
                document.getElementById("Donor").style.display = "none";
                document.getElementById("Hospital").style.display = "block";
                document.getElementById("Government").style.display = "none";
            }
function Gov() {
                document.getElementById("patient").style.display = "none";
                document.getElementById("Donor").style.display = "none";
                document.getElementById("Hospital").style.display = "none";
                document.getElementById("Government").style.display = "block";
            }
</script>
</div>
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