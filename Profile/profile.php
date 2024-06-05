<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Bootstrap -->
 <?php
    include '../includes/bootstrap.php'; 
    include '../includes/connect.php';
 ?>
</head>
<!-- Connect Css -->
 <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->
 <?php
include '../includes/headerLoggedIn.php';
?>
<style>
    body {
    font-family: 'Poppins';
    background-image: url("../Asset/Img/FK.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    margin-right: 0;
    margin-left: 0;
    background-color: #33ab9f;
    overflow: hidden;
    }

    html,body
    {
    width: 100%;
    /* height: 100%; */
    margin: 0px;
    padding: 0px;
    overflow-x: hidden; 
    }

    .colmid{
        margin-top: 20vh;
        width: 50vw;
        background: white;
    }

    label{
        color: #33ab9f;
    }
</style>
    
<?php
    session_start();
    $uid = $_SESSION['User'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE u_id = '$uid'");

    while ($row = mysqli_fetch_array($q)){
        // $pass =  $row['u_password'];
        // if (md5($str) == $pass)
        // {
        //     echo "<br>Hello world!";
        //     exit;
        // }

        
        ?>
<body>
    <div class="row">
        <div class="col"></div>
        <div class="colmid col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Summon</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="name" class="form-label">Name</label>
                              <h4 id="name"><?php echo $row['u_name'];?></h4>
                              <button type="button" class="btn btn_primary" data-bs-toggle="modal" data-bs-target="#modalName">
                                change name
                              </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="pass" class="form-label">Password</label>
                              <br>
                              <button type="button" class="btn btn_primary" data-bs-toggle="modal" data-bs-target="#modalPass">
                                change password
                              </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">Email</label>
                              <h4 id="email"><?php echo $row['u_email'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="type" class="form-label">User Type</label>
                              <h4 id="email"><?php echo $row['u_type'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <button type="submit" id="btnDeactivate" name="btnDeactivate" class="text-danger">Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <!-- MODAL NAME -->

    <div class="modal fade" id="modalName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changeName" method="post">
                <div class="modal-body">
                    <label for="modalname">Type your new name</label>
                    <br>
                        <input id="modalname" type="text" name="name" placeholder="Name..."/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btnCName" name="btnCName" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL PASSWORD-->
    <div class="modal fade" id="modalPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changePass" method="post">
                <div class="modal-body">
                    <label for="modalpass">Type your new password</label>
                    <br>
                    <form id="changePass" method="post">
                        <input id="modalpass" type="text" name="password" placeholder="Password..."/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btnCPass" name="btnCPass" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> 
            </div>
        </div>
    </div>

    <!-- CRUD -->
    <?php 
    
    if (isset($_POST['btnCName'])) {

        $uid = $_SESSION['User'];
        $name = $_POST['name'];

        $queryname = mysqli_query($conn, "UPDATE users SET u_name = '$name' WHERE u_id = '$uid'");

        if ($queryname) {
            echo '
                    <script type="text/javascript">
                        alert("Name have been updated!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        } else {
            echo '
                    <script type="text/javascript">
                        alert("Something went wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    if (isset($_POST['btnCPass'])){
        $uid = $_SESSION['User'];
        $pass = $_POST['password'];

        $querypass = mysqli_query($conn, "UPDATE users SET u_password = '$pass' WHERE u_id = '$uid'");

        if ($queryname) {
            echo '
                    <script type="text/javascript">
                        alert("Password have been updated!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        } else {
            echo '
                    <script type="text/javascript">
                        alert("Something went wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    if (isset($_POST['btnDeactivate'])){
        $uid = $_SESSION['User'];
        // $queryv = "DELETE from vehicle WHERE u_id = '$uid'";
        $queryd = "DELETE from users WHERE u_id = '$uid'";
        $result = mysqli_query($conn, $queryd);

        if ($result) {
            echo '
                    <script type="text/javascript">
                        alert("Your account have been deleted!");
                          setTimeout(function(){
                            window.location.href="../Logout.php";
                        },1000);
    
                        </script>
                    ';
        }else {
            echo '
                    <script type="text/javascript">
                        alert("There is something wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    ?>


</body>
</html>
<?php
    } ?>
