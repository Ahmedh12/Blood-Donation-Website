<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="index.php">
                <img src="Images/logo.webp" alt="Blood Drop" height="70px" width="85px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link text-light" href="#">Home <span class="sr-only">(current)</span></a>
                </div>
                <span class="navbar-text ml-auto">
                    <a class="nav-item nav-link text-dark" href="LogIn.php">Log-In</span></a>
                <a class="nav-item nav-link text-dark" href="SignUp.php">Sign-Up</span></a>
                </span>
            </div>
        </nav>
        <div class="bg-body">

            <body>
                <div class="row justify-content-between font pt-3">
                    <div class="col-md-2 text-right pt-1">
                        <h1>Donate</h1>
                    </div>
                    <div class="col-md-3 pt-3 animated rollIn slower">
                        <img src="Images/arrow.png" alt="arrow" height="80px" width="340px">
                    </div>
                    <div class="col-md-4 text-center font mt-5">
                        <h1>You are a life <em>Savior</em></h1>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col text-justify ml-5 mr-5">

                        <p class="text-justify paratext">
                            <span class="h4"><strong><em> We </em></strong></span>have decided to create a database
                            system to manage the blood donation process across hospitals.
                            The database would be accessed by 4 different types of users namely the patient(he who is
                            seeking a transfusion),
                            the donor, a government administrator, and the hospital blood-management department
                            employee.
                        </p>

                        <p class="text-justify paratext">
                            <span class="h4"><strong><em> We </em></strong></span>have made some assumptions for the
                            sake of simplicity an to be more focused on the aim of the project
                            e.g. creating and manipulating databases. To begin with, We have assumed that all the blood
                            donations are
                            done in hospitals and that all the hospitals are registered by the Ministry of health and
                            hence the data about
                            the hospitals need not be entered by any database user rather it is pre-populated.
                            The Government employee is the only user who has the privilege of adding a hospital to the
                            database.
                        </p>

                        <p class="text-justify paratext">
                            <span class="h4"><strong><em> The </em></strong></span>data flow through the database would
                            be as follows the user should create an account either as a donor or a patient
                            through the website all the data that he enters is populated to its respective table e.g.
                            the Donors or the patients tables.
                            The User is then allowed to donate request, so the available donation center is displayed,
                            if he is registered as a donor.
                            If he is a patient he can make a transfusion request, which is then populated to the
                            hospitals and the if accepted he can
                            move to the hospital to be treated.
                        </p>
                    </div>
                </div>
                <div class="row pt-5 mr-2 ml-2 pb-5">
                    <div class="col-md-4 ">
                        <a href="LogIn.php"><div class="card">
                            <img src="Images/dlogged.png" alt="" class="img-fluid rounded-circle team-images mx-auto d-block">
                            <div class="card-text">
                                <h2>Donate</h2>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-md-4 ">
                        <a href="LogIn.php"> <div class="card">
                            <img src="Images/hospital.png" alt="" class="img-fluid rounded-circle team-images mx-auto d-block">
                            <div class="card-text">
                                <h4>Hospital Log-In</h4>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-md-4 ">
                        <a href="LogIn.php"><div class="card">
                            <img src="Images/gov.PNG" alt="" class="img-fluid rounded-circle team-images mx-auto d-block">
                            <div class="card-text">
                                <h4>Government Representative</h4>
                                <h4>Log-In</h4>
                            </div>
                        </div></a>
                    </div>
                </div>
                <div class="row pt-5" style="display:none">
                    <div class="col text-center">
                        <h1 class="text-danger">Urgent Requests</h1>
                    </div>
                </div>
                </div>
            </body>
        </div>
        <?php require_once "footer.php"?>

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