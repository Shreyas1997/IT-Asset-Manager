<?php
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asset Management Application</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar fixed-top" style="background-color: #0d47a1; box-shadow: 0px 4px 3px #d5cdcd;">
        <div class="d-flex content-justify-center">
            <h2 class="display-5 title dashContent" style="color: #ffffff;">IT Asset Manager</h2>
        </div>
    </nav>

    <div class="container-fluid section-1 img-fluid">
        <h3 class="display-4 mainContent text-center">We help manage your Assets...</h3>
        <div class="d-flex justify-content-center boardButton">
            <a href="userDashboard.php" type="button" class="btn btn-primary btn-lg">Iam User</a>
            &nbsp;&nbsp;&nbsp;
            <a type="button" class="btn btn-primary btn-lg text-light" data-toggle="modal" data-target="#signinModal">Iam Admin</a>
        </div>
        <div class="modal fade" id="signinModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Admin Sign In</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <p class="sub-title text-danger">Name: admin and Password: adminpass</p>
                        <form method="POST" action="assetController.php">
                            <div class="form-group">
                                <label for="name">Admin Name:</label>
                                <input type="text" class="form-control" id="adminName" name="adminname">
                            </div>
                            <div class="form-group">
                                <label for="password">Admin Password:</label>
                                <input type="password" class="form-control" id="adminPassword" name="adminpassword">
                            </div>
                            <button type="submit" class="btn btn-primary" name="login" value="login">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="custom.js"></script>
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