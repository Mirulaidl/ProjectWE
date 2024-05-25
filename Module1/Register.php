<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
     <!-- Bootstrap -->
    <?php 
    include '../includes/bootstrap.php';
    ?>
     <!-- Connect Css -->

    <?php
    include '../includes/connect.php';

    function is_valid_domain($email) {
        $allowed_domains = ['student.ump.edu.my', 'ump.edu.my'];
        $email_domain = substr(strrchr($email, "@"), 1);
        return in_array($email_domain, $allowed_domains);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $usertype = $_POST['userType'];

        //take matric id
        $user = strstr($email, '@', true);
        $merit = 0;
        $status = "Pending";


        //Validate Email UMP
        if (empty($email)) {
            echo '
                <script type="text/javascript">
                    alert("Email is Required");
                    window.location.href="Register.php";

                    </script>
                ';
        } elseif (!is_valid_domain($email)) {
            
            echo '
                <script type="text/javascript">
                    alert("Email must be in @student.ump.edu.my or @ump.edu.my domain only.");
                    window.location.href="Register.php";

                    </script>
                ';
        } else {
            if ($_POST['userType'] == "Student"){
            
                $query = mysqli_query($conn, "INSERT INTO users (u_id, u_email, u_password, u_name, u_type, u_merit, u_status) VALUES ('$user','$email','$password','$name','$usertype','$merit','$status')");
                
                if ($query) {
    
                    echo '
                    <script type="text/javascript">
                        alert("Student Successfully Registered!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }else{
                    echo '
                    <script type="text/javascript">
                        alert("Student Register Error!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }
                
                
            }else if ($_POST['userType'] == "Administrator"){
                $query = mysqli_query($conn, "INSERT INTO Administrator (a_id, a_email, a_password, a_name) VALUES ('$user','$email','$password','$name')");
    
                if ($query) {
    
                    echo '
                    <script type="text/javascript">
                        alert("Administrator Successfully Registered!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }else{
                    echo '
                    <script type="text/javascript">
                        alert("Administrator Register Error!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }
            }else{
                $query = mysqli_query($conn, "INSERT INTO UnitKeselamatan (uk_id, uk_email, uk_password, uk_name) VALUES ('$user','$email','$password','$name')");
    
                if ($query) {
    
                    echo '
                    <script type="text/javascript">
                        alert("Unit Keselamatan Successfully Registered!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }else{
                    echo '
                    <script type="text/javascript">
                        alert("Unit Keselamatan Register Error!");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },2000);
    
                        </script>
                    ';
                }
            }
        }



        
    }

    ?>


</head>
<header>
<?php
include '../includes/header.php'; 
?>
</header>
<body>
<form action="Register.php" method="POST">
    <div class="row">
        <div class="col leftcol">

        </div>
        <div class="col midcol">
        <div class="form middleForm text-center" style="margin-top:30vh;">

            <h1 class ="title fw-bolder text-light">REGISTER</h1>

            <input class="mb-2" type="text" name="name" placeholder="Name..." required/>

            <input class="mb-2" type="email" name="email" placeholder="Email..." required/>

            <input class="mb-2" type="password" name="password" placeholder="Password..." required/>
            <div class="select">
                <select class="form-select" id="userType" aria-label="Default select example" name="userType">
                    <option id="Student" value="Student" selected>Student</option>
                    <option id="Administrator" value="Administrator">Administrator</option>
                    <option id="Unit Keselamatan" value="Unit Keselamatan">Unit Keselamatan</option>
                </select>
            <div class="select_arrow"></div>
            </div>
            

            <input class="btn btn-primary" name="submit" type="submit" value="Register" />

            <h5>Already have an account?<a href="Login.php">SIGN IN</a></h5>

            </div>
        </div>
        <div class="col rightcol">

        </div>
    </div>
                        
</form>

</body>
</html>