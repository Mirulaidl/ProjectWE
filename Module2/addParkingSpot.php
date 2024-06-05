<!DOCTYPE html>
<html>
<head>
<title>Add Parking</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="parking.css">
<!-- Bootstrap -->
<?php include '../includes/bootstrap.php'; ?>
<?php include '../includes/connect.php'; ?>
</head>
<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $spotname = $_POST['ps_spot'];
        $spotarea = $_POST['ps_area'];
        $spotstatus = $_POST['ps_status'];
        $ps_id = $spotname . $spotarea;

        $querycheck = mysqli_query($conn, "SELECT * FROM ParkingSpot WHERE ps_id = '$ps_id'");
        $data = mysqli_fetch_array($querycheck, MYSQLI_NUM);
        if($data[0] > 1){ // check if parking spot already exist in db
            echo '
                    <script type="text/javascript">
                        alert("Parking Spot Already Exist!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },1000);
    
                        </script>
                    ';
        }else{
            $queryinsert = mysqli_query($conn, "INSERT INTO ParkingSpot (ps_id, p_id, ps_name, ps_status) VALUES ('$ps_id', '$spotarea', '$spotname', '$spotstatus')");
            if($queryinsert){
                echo '
                    <script type="text/javascript">
                        alert("Parking Spot Registered Successfully!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },2000);
    
                        </script>
                    ';
            }else{
                echo '
                    <script type="text/javascript">
                        alert("Something went wrong!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },2000);
    
                        </script>
                    ';
            }
        }

        
    }
?>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?>

    <form method="POST">
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Add Parking Spot</h1>
                    <div>
                        <p class="p1">Spot name: </p>
                        <input type="text"  id="p_spot" name="ps_spot" >
                        <p class="p1">Area: </p>
                        <select class="form-select" id="p_area" aria-label="Default select example" name="ps_area">
                            <?php 
                                $allarea = mysqli_query($conn, "SELECT * from ParkingSpace");
                                while($c = mysqli_fetch_array($allarea)){
                            ?>
                                <option value="<?php echo $c['p_id']?>"><?php echo $c['p_id']?></option>
                            <?php } ?>
                        </select>

                        <br>

                        <p class="p1">Status: </p>
                            <select class="form-select" id="p_status" aria-label="Default select example" name="ps_status">
                                <option id="Available" value="Available" selected>Available</option>
                                <option id="Occupied" value="Occupied">Occupied</option>
                            </select>
                        <div class="row">
                       
                            <div class="col"></div>
                            <br>
                            <div class="col text-center">
                            <br>
                                <input class="btn btn-primary" name="submit" type="submit" value="Add" />
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
