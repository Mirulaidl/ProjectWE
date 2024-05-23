<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Bootstrap -->
<link rel="icon" href="https://umpsa.edu.my/themes/pana/favicon.ico" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
 <!-- Connect Css -->
 <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->
 <?php
include '../includes/header.php';
?>
<body>
    <div class="form" style="border: 1px solid red; margin-top:30vh;">
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col" style="">
                        <h1 class ="title">LOGIN</h1>
                    </div>
                    <div class="col"></div>
                </div>
        
                <div class="row">
                    <div class="col"></div>
                    <div class="col" style="">
                        <input type="text" name="email" placeholder="Email..." required/>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <input type="text" name="password" placeholder="Password..." required/>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col">
                        <select class="form-select" id="userType" aria-label="Default select example" name="userType">
                        <option id="Student" value="Student" selected>Student</option>
                        <option id="Customer" value="Customer">Staff</option>
                        <option id="Administrator" value="Administrator">Administrator</option>
                        <option id="Unit Keselamatan" value="Unit Keselamatan">Unit Keselamatan</option>
                        </select>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <input name="submit" type="submit" value="Login" />
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h5>Don't have an account?<a href="Register.php">SIGN UP</a></h5>
                    </div>
                    <div class="col"></div>
                </div>
        </div>
            
    </div>
</body>
</html>