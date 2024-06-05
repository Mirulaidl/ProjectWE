<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styleAdmin.css">
<!-- Bootstrap -->
<?php 
    session_start(); // session ni utk pakai data sape yang login jangan lupa connectkan navigation utk mana2 page jangan pakai link je utk masuk// masuk pakai login WAJIB
    include '../includes/connect.php'; //connection database
    include '../includes/bootstrap.php';
?>
</head>
<?php
    include '../includes/headerLoggedIn.php';
    
?>

<body>

    <div class="container" style="margin-top:15vh;">
    <center>
            <button type="button" class="col buttonAdmin">
                <h3>User Profile</h3>
            </button>

            <a href="ViewParkingArea.php">AAAAAA</a>

            <!-- <button class="col buttonAdmin"  onclick="location.href=\'test3.php\'">
              <h3>Parking Area</h3>
            </button> -->

            <button type="button" class="col buttonAdmin">
                <h3>Vehicle Registration</h3>
            </button>
    </center>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <div class="col">
                        <p>Welcome Back</p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <h1>
                            <?php 
                                $username = $_SESSION['AdminName'];
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
            <div class="col outer">
            <p>Total Bookings:</p>
            <p>Available Parking Spaces:</p>
            <p>Current Occupancy Rate:</p>
</div>
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