<?php
require("../config/dbconnection.php");
if (!session_id()) session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim(htmlentities($_POST['txtusername']));
    $password = trim(htmlentities($_POST['txtpassword']));
    $query = "SELECT * FROM user WHERE userid = '$username' AND password = '$password'";
    $result = $con->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['registereddate'] = $row['registereddate'];
        $_SESSION['usertype'] = $row['usertype'];
        $_SESSION['authenticated'] = true;
        $_POST['login'] = null;
        if ($row['usertype'] == "Patient") {
            header('Location: ../PatientUI/dashboard.php');
        } else if ($row['usertype'] == "Doctor") {
            header('Location: ../doctor/dashboard.php');
        } else if ($row['usertype'] == "Employee") {
            $query2 = "SELECT (select Position from employee_type 
            where emptypeid=e.emptypeid) as position
            FROM pdms.employee e
            where userid='$username';";
            $result2 = $con->query($query2);
            $row2 = $result2->fetch_assoc();
            if ($row2['position'] == "CounterStaff")
                header('Location: ../Employee/dashboard.php');
            else if ($row2['position'] == 'BranchManager')
                header('Location: ../branchManagerUI/dashboard.php');
        }
        exit();
    } else {
        echo "<script>Swal.fire({
            title: 'Error',
            text: 'Please enter a correct password and username',
            icon: 'error',
            confirmButtonText: 'OK'
        });</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="icon" href="/images_new/favicon.png">
    <style>
        .was-validated .form-check-input:valid:checked {
            border-color: #007bff;
            /* Blue color */
            background-color: #007bff;
            /* Blue color */
        }
    </style>
    <?php include("../config/includes.php"); ?>
    <title>Login</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!-- left box -->
            <div style="background: #0f376b;" class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <img src="/images_new/login.jpg" class="img-fluid rounded-2 backimage" width="250px" alt="login image">
                </div>
                <p class="text-white fs-2" style="font-weight: 600; letter-spacing: 2px;">Be
                    Verified</p>
                <p class="text-white text-wrap text-center" style="width:  17rem; ">Login in to PWS dental to access
                    online features</p>
            </div>
            <!-- right box -->
            <div class="col-md-6  right-box">
                <div class="row align-items-center">
                    <form action="login.php" class="was-validated" method="post" onsubmit="return isValidInput()" novalidate>
                        <div class="header-text mb-4">
                            <h2>Welcome back !</h2>
                            <p>We are happy to have you back</p>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="username" class="form-control form-control-lg bg-light fs-6" name="txtusername" placeholder="Username" maxlength="5" minlength="5" pattern="^[A-Z][0-9]{4}$" required><!-- pattern="^\S+@\S+\.\S+$" -->
                            <div class="invalid-feedback" id="username-error">Please Enter your username</div>
                        </div>
                        <div class="input-group mb-3 rounded-3">
                            <input type="password" id="password" class="form-control form-control-lg bg-light fs-6" name="txtpassword" placeholder="Password" minlength="8" maxlength="8" required pattern="^[a-zA-Z0-9]{8}$"><!-- required pattern="^[a-zA-Z0-9]{8}$" -->
                            <div class="invalid-feedback" id="password-error">Please Enter the passsword</div>
                        </div>
                        <!-- <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check"> -->
                        <!-- <input type="checkbox" class="form-check-input" id="chk_remember_me">
                                <label for="formcheck">
                                    <small class="form-check-label text-secondary">
                                        Remember me
                                    </small>
                                </label> -->
                        <!-- </div>
                        </div> -->
                        <div class="input-group mb-3">
                            <input type="submit" class="btn btn-lg w-100 fs-6" id="btnlogin" value="login" name="login">
                        </div>
                        <div class="row text-center fs-6">
                            <span style="font-size: small;">Not registered?<span>
                                    <span style="font-size: small;"><a href="home.html">Sign Up</a></span>
                        </div>
                        <div class="row text-center fs-6 mt-2">
                            <span style="font-size: small;">Go to home page :<span>
                                    <span style="font-size: small;"><a href="home.html">Home</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>
<script>
    var validusername = false;
    var validpassword = false;

    function isValidInput() {
        if (validusername && validpassword) {
            return true;
        }
        let text = "";
        if (!validusername) {
            text = $('#username-error').text();
        } else if (!validpassword) {
            text = $('#password-error').text();
        }
        Swal.fire({
            title: 'Error',
            text: text,
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }
    $(document).ready(function() {
        $('#username').on("input", function() {
            var username = $(this).val();
            if (username.length == 0) {
                $('#username-error').text("Please fill out the username field");
                validusername = false;
            } else if (!(/^[A-Z][0-9]{4}$/.test(username))) {
                $('#username-error').text("Please fill out a valid username.");
                validusername = false;
            } else {
                $('#username-error').text("");
                validusername = true;
            }
        });
    });

    $('#password').on("input", function() {
        if ($(this).val().length == 0) {
            $('#password-error').text("Please fill out the password field");
            validpassword = false;
        } else if (!(/^[a-zA-Z0-9]{8}$/.test($(this).val()))) {
            $('#password-error').text("Please enter a valid password (must contain 8 characters)");
            validpassword = false;
        } else if ($(this).val().length > 8) {
            $('#password-error').text("The password number can only have 8 characters.");
            validpassword = false;
        } else {
            $('#password-error').text("");
            validpassword = true;
        }
    });
</script>


</html>