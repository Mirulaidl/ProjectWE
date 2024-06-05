<!DOCTYPE html>
<html>
<head>
<title>Edit Parking Spot</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="parking.css">
<!-- Bootstrap -->
<?php include '../includes/bootstrap.php'; ?>
<?php include '../includes/connect.php'; ?>
<?php 

if (isset($_GET['ps_id'])) {
    $ps_id = $_GET['ps_id'];
    echo "<script>console.log('Debug Objects: " . $ps_id . "' );</script>";
    $query = mysqli_query($conn, "SELECT * FROM ParkingSpot WHERE ps_id = '$ps_id'");
    while ($row = mysqli_fetch_array($query)){
    ?>
        </head>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?>

    <form method="POST">
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Edit Parking Spot</h1>
                    <div>

                    <br>
                        <p class="p1">Spot name: </p>
                        <input type="text" id="name" name="name" value="<?php echo $row['ps_name'];?>" disabled/>
                        
                        <p class="p1">Status: </p>
                        <div class="select">
                            <select class="form-select" id="ps_status" aria-label="Default select example" name="ps_status">
                                <option id="p_status" value="Available" selected>Available</option>
                                <option id="p_status" value="Occupied">Occupied</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>


                        <br>

                        <div class="row">
                            <div class="col"></div>
                            <div class="col text-center">
                                <input class="btn btn-primary" name="submit" type="submit" value="Confirm" />
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col rightcol"></div>
        </div>
    </form>

</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $status = $_POST['ps_status'];
        $ps_id = $_GET['ps_id'];
        $queryupdate = mysqli_query($conn, "UPDATE ParkingSpot SET ps_status = '$status' WHERE ps_id = '$ps_id'");
        if($queryupdate){
            echo '
                    <script type="text/javascript">
                        alert("Parking Spot have been updated!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },1000);
    
                        </script>
                    ';
        }else{
            echo '
                    <script type="text/javascript">
                        alert("There is something wrong!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },1000);
    
                        </script>
                    ';
        }
    }
    
    }
}

?>

