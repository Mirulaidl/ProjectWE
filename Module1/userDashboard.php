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
                                $uid = $_SESSION['User'];
                                echo '<input id="userID" value="' . $uid . '" hidden>';
                                // $username = getname($userID);
                                echo "$username";
                            ?>
                        </h1>
                    </div>
                    <div class="col">
                        <?php
                        $query = "SELECT * FROM vehicle WHERE u_id = '" . $_SESSION['User'] . "'";
                        $result = mysqli_query($conn, $query);
                            if($row = mysqli_fetch_assoc($result)){
                                $plate = $row['v_plate_num'];
                                $status = $row['v_status'];
                                if($row['v_status'] != NULL){
                                    $_SESSION['VehicleStatus'] = $row['v_status'];
                                    $status = $_SESSION['VehicleStatus'];
                                }
                                
                                echo '
                                <div class="row">
                                    ' . $plate . '
                                </div>
                                <div class="row">
                                    ' . $status . '
                                </div>
                                ';
                            }else{
                                echo '<a href="registerVehicle.php" class="buttonClass" style="
                                text-decoration: none;
                                font-size:30px;
                                width:30vw;
                                height:15vh;
                                border-width:1px;
                                color:#fff;
                                font-weight:bold;
                                padding: 3px 30px 5px 30px;
                                border-radius: 5px;
                                background:#44c767;"
                                >Register</a>';
                            }
                        ?>
                        
                    </div>
                </div>
                
            </div>
            <?php
            $status = "";
                if($status == "Pending"){
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\' disabled">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }else if ($status == "Approved"){
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\'">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }else{
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\'">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }
            ?>
            
        </div>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <p>Fakulti Komputeran Parking Area</p>
                    <img src="../Asset/Img/Parking.svg" alt="Parking" style="height: 55vh;">
                </div>

            </div>
            <div id="graph" class="col outer">

            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(){
        var UserID = document.getElementById('userID').value;

        $.post

    })
</script>

</html>