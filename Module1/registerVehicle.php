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

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $plate = $_POST['plate'];
        $brand = $_POST['brand'];
        $color = $_POST['color'];
        $vtype = $_POST['vehicleType'];
        $uid = $_SESSION['User'];
        $status = "Pending";
        $date = 
        $id = $plate;

        //insert image grant
        $image = $_FILES['image'];
        $info = getimagesize($image["tmp_name"]);
        if(!$info)
        {
            die("File is not an image");
        }
        $blob = addslashes(file_get_contents($image["tmp_name"]));

        $query = mysqli_query($conn, "INSERT INTO vehicle (v_id, u_id, v_plate_num, v_type, v_date_created, v_brand, v_color, v_grant, v_status) VALUES ('$id','$uid','$plate','$vtype',NOW(),'$brand','$color','$blob','$status')");
        

        echo '
                <script type="text/javascript">
                    alert("Vehicle Registered!");
                    window.location.href="userDashboard.php";

                    </script>
                ';
    }
?>
</head>
<?php
    include '../includes/headerLoggedIn.php';
?>
<body>
<form action="registerVehicle.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col leftcol">

        </div>
        <div class="col midcol">
        <div class="form middleForm text-center" style="margin-top:30vh;">

            <h1 class ="title fw-bolder text-light">REGISTER YOUR VEHICLE</h1>

            <input class="mb-2" type="text" name="plate" placeholder="Plate Number..." required/>

            <input class="mb-2" type="text" name="brand" placeholder="Brand..." required/>

            <input class="mb-2" type="text" name="color" placeholder="Color..." required/>
            <div class="select">
                <select class="form-select" id="vehicleType" aria-label="Default select example" name="vehicleType">
                    <option id="Car" value="Car" selected>Car</option>
                    <option id="Motorcycle" value="Motorcycle">Motorcycle</option>
                </select>
            <div class="select_arrow"></div>
            </div>

            <input class="mb-2" type="file" name="image" accept="image/*" id="formFile" required/>

            <input class="btn btn-primary" name="submit" type="submit" value="Register" />

            <!-- <h5>Already have an account?<a href="Login.php">SIGN IN</a></h5> -->

            </div>
        </div>
        <div class="col rightcol">

        </div>
    </div>
                        
</form>

</body>
</html>