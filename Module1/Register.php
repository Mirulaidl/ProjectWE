<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        alert("yes");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },3000);
    
                        </script>
                    ';
                }else{
                    echo '
                    <script type="text/javascript">
                        alert("yes");
                          setTimeout(function(){
                            window.location.href="login.php";
                        },3000);
    
                        </script>
                    ';
                }
                
                
            }else if ($_POST['userType'] == "Administrator"){
                $query = mysqli_query($conn, "INSERT INTO Administrator (a_id, a_email, a_password, a_name) VALUES ('$user','$email','$password','$name')");
    
                if ($query) {
    
                    echo '
                    <script type="text/javascript">
                    $(document).ready(function(){
                    Swal.fire({
                    title: "Account Created!",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false,
                    }).then(function() {
                    window.location.href="login.php";
                    });
                    });
    
                    </script>
                        ';
                }else{
                    echo '
                    <script type="text/javascript">
                          $(document).ready(function(){
                            Swal.fire({
                              title: "Something went wrong! 😢",
                              text: "Please try again",
                              icon: "error",
                              timer: 2000,
                              showConfirmButton: false,
                            }).then(function() {
                              window.location.href="login.php";
                            });
                          });
                        </script>
                       '; 
                }
            }else{
                $query = mysqli_query($conn, "INSERT INTO UnitKeselamatan (uk_id, uk_email, uk_password, uk_name) VALUES ('$user','$email','$password','$name')");
    
                if ($query) {
    
                    echo '
                    <script type="text/javascript">
                    $(document).ready(function(){
                    Swal.fire({
                    title: "Account Created!",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false,
                    }).then(function() {
                    window.location.href="login.php";
                    });
                    });
    
                    </script>
                        ';
                }else{
                    echo '
                    <script type="text/javascript">
                          $(document).ready(function(){
                            Swal.fire({
                              title: "Something went wrong! 😢",
                              text: "Please try again",
                              icon: "error",
                              timer: 2000,
                              showConfirmButton: false,
                            }).then(function() {
                              window.location.href="login.php";
                            });
                          });
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
<div class="form" style="border: 1px solid red; margin-top:30vh;">
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col" style="">
                        <h1 class ="title">REGISTER</h1>
                    </div>
                    <div class="col"></div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <div class="col" style="">
                        <input type="text" name="name" placeholder="Name..." required/>
                    </div>
                    <div class="col"></div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <div class="col" style="">
                        <input type="email" name="email" placeholder="Email..." required/>
                    </div>
                    <div class="col"></div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <input type="password" name="password" placeholder="Password..." required/>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col">
                        <select class="form-select" id="userType" aria-label="Default select example" name="userType">
                        <option id="Student" value="Student" selected>Student</option>
                        <option id="Administrator" value="Administrator">Administrator</option>
                        <option id="Unit Keselamatan" value="Unit Keselamatan">Unit Keselamatan</option>
                        </select>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <input name="submit" type="submit" value="Register" />
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h5>Already have an account?<a href="Login.php">SIGN IN</a></h5>
                    </div>
                    <div class="col"></div>
                </div>
        </div>
            
</div>
</form>

</body>
</html>