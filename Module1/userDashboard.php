<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<!-- Bootstrap -->
<?php 
    session_start();
    include '../includes/connect.php';
    include '../includes/bootstrap.php';
?>
</head>
<?php
    include '../includes/headerLoggedIn.php';
?>
<body>
    <div class="container" style="margin-top:15vh;">
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <div class="col">
                        <p>Welcome Back</p>
                    </div>
                    <div class="col">
                        <p>Your Vehicle</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1>
                            <?php 
                                $username = $_SESSION['UserName'];
                                // $username = getname($userID);
                                echo "$username";
                            ?>
                        </h1>
                    </div>
                    <div class="col">
                        <div class="row"></div>
                        <div class="row"></div>
                    </div>
                </div>
                
            </div>
            
            <a type="button" class="col buttonbook" href="../Module3/Booking.php">
                <h1>Book Parking</h1>
            </a>
        </div>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <p>Fakulti Komputeran Parking Area</p>
                    <img src="../Asset/Img/Parking.svg" alt="Parking" style="height: 55vh;">
                </div>
                <div class="row">

                </div>
            </div>
            <div class="col outer">

            </div>
        </div>
    </div>
</body>
</html>