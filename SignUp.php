<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
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
    require_once "Header.php";
?>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-xs-4 mr-2 pt-4">
                <button  class="btn" onclick="PatientForm()">
                    <img src="images/patient.png" height=200px width=210px alt="patient">
                </button>
            </div>
            <div class="col-xs-4 mr-2 pt-4">
                <button  class="btn" onclick="DonorForm()">
                    <img src="images/donorSign.png" height=200px width=195px alt="donor">
                </button>
            </div>
        </div>
        
        <div class="row pt-5" id="dForm" style="display:none">
            <div class="col-md-12">
            <form action="DPSign-Up.php" method="post">
            <h2 class="mx-auto">Donor SignUp Form</h2>
            <hr>
                    <fieldset>
                        <legend>Personal Details</legend>
                        <input name='name' type="text" class="form-control mb-2" placeholder="Name" required>
                        <input name='Age' type="number" class="form-control mb-2" placeholder="Age" required>
                        <select name="Gender" id="Gender" class="form-control mb-2">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <input name='Ethenecity' type="text" class="form-control mb-2" placeholder="Ethenicity" required>
                        <input name='Email' type="email" class="form-control mb-2" placeholder="Email" required>
                        <input name='PhoneNumber' type="text" class="form-control mb-2" placeholder="PhoneNumber" required>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Address</legend>
                        <input name="Address" type="text" class="form-control mb-2"  required>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Medical History</legend>
                        <label class="my-1 mr-2" for="BloodGroup" name='bloodgroup'>Blood Group</label>
                        <select class="custom-select my-1 mr-sm-2" id="BloodGroup" name='bloodgroup' >
                            <option selected>Choose...</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <label class="my-1 mr-2" for="Diseases">Diseases(Select All That Apply)</label>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="AIDS" value="AIDS" name="chkl[]">
                        <label class="form-check-label" for="AIDS">AIDS</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Hepatitis" value="Hepatitis" name="chkl[]">
                        <label class="form-check-label" for="Hepatitis">Hepatitis</label>
                        </div>
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" id="Malaria" value="Malaria" name="chkl[]">
                        <label class="form-check-label" for="Malaria">Malaria</label>
                        </div>
                        <div class="form-check ">
                        <input class="form-check-input" type="checkbox" id="T_Lymphotropic_virus-1" value="T_Lymphotropic_virus-1" name="chkl[]">
                        <label class="form-check-label" for="T_Lymphotropic_virus-1">T Lymphotropic virus-1</label>
                        </div>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Credentials</legend>
                        <input type="password" class="form-control mb-2" name="Password" id="password" placeholder="Password" required>
                        <input type="password" class="form-control mb-2" name="PasswordCheck" id="passwordCheck" placeholder="Repeat Password" required>
                    </fieldset>
                    <div class="row">
                        <div class="col-xs-12 mx-auto mt-5 mt-1">
                            <input type="Submit" name="DSubmit" id="DSubmit" Value="Sign-Up" class="btn btn-primary mx-auto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <p class="text-dark">
                                Already Have an Account <a href="#">Log In</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--Patient'Form-->
        <div class="row pt-5" id="pForm" style="display:none">
            <div class="col-md-12">
            <form action="DPSign-Up.php" method="post">
            <h2 class="mx-auto">Patient SignUp Form</h2>
            <hr>
                    <fieldset>
                        <legend>Personal Details</legend>
                        <input name="name" type="text" class="form-control mb-2" placeholder="Name" required>
                        <input name="Age" type="number" class="form-control mb-2" placeholder="Age" required>
                        <select name="Gender" id="Gender" class="form-control mb-2">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <input name="Ethenecity" type="text" class="form-control mb-2" placeholder="Ethenicity" required>
                        <input name="Email" type="email" class="form-control mb-2" placeholder="Email" required>
                        <input name="PhoneNumber" type="number" class="form-control mb-2" placeholder="Phone Number" required>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Address</legend>
                        <input name="Address" type="text" class="form-control mb-2"  required>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Medical History</legend>
                        <label class="my-1 mr-2" for="BloodGroup" >Blood Group</label>
                        <select class="custom-select my-1 mr-sm-2" id="BloodGroup" name="bloodgroup">
                            <option selected>Choose...</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </fieldset>
                    <hr>
                    <fieldset>
                        <legend>Credentials</legend>
                        <input type="password" class="form-control mb-2" name="Password" id="password" placeholder="Password" required>
                        <input type="password" class="form-control mb-2" name="PasswordCheck" id="passwordCheck" placeholder="Repeat Password" required>
                    </fieldset>
                    <div class="row">
                        <div class="col-xs-12 mx-auto mt-5 mt-1">
                            <input type="Submit" name="PSubmit" id="Submit" Value="Sign-Up" class="btn btn-primary mx-auto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mx-auto">
                            <p class="text-dark">
                                Already Have an Account <a href="LogIn.php">Log In</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once "footer.php"?>
        <script>
            function PatientForm() {
                document.getElementById("pForm").style.display = "block";
                document.getElementById("dForm").style.display = "none";
            }
            function DonorForm() {
                document.getElementById("dForm").style.display = "block";
                document.getElementById("pForm").style.display = "none";
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