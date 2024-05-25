<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
 <!-- Bootstrap -->
<?php
include '../includes/bootstrap.php'; 
?>
</head>
 <!-- Connect Css -->
 <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->
 <?php
include '../includes/header.php';
?>
<body>
    <form action="../functions/submitLogin.php" method="POST">
        <div class="row">
            <div class="col leftcol">

            </div>
            <div class="col midcol">
                <div class="form middleForm text-center" style="margin-top:30vh;">

                        <h1 class ="title fw-bolder text-light">LOGIN</h1>

                        <input class="mb-2" type="email" name="email" placeholder="Email..." required/>
                        <br>
                        <input class="mb-2" type="password" name="password" placeholder="Password..." required/>
                        <br>
                        <div class="select">
                            <select class="form-select" id="userType" aria-label="Default select example" name="userType">
                                <option id="Student" value="Student" selected>Student</option>
                                <option id="Administrator" value="Administrator">Administrator</option>
                                <option id="Unit Keselamatan" value="Unit Keselamatan">Unit Keselamatan</option>
                            </select>
                        <div class="select_arrow"></div>
                        </div>
                        
                        <br>
                        <input class="btn btn-primary" name="submit" type="submit" value="Login" />

                        <h5>Don't have an account?<a href="Register.php">SIGN UP</a></h5>

                </div>
            </div>
            <div class="col rightcol">

            </div>
            
        </div>
        
    </form>
    
</body>
</html>