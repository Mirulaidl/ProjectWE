<!DOCTYPE html>
<html>
<head>
<title>Add Parking</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="parking.css">
<!-- Bootstrap -->
<?php include '../includes/bootstrap.php'; ?>
</head>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?>

    <form method="POST" action="insertParking.php">
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Add Parking Area</h1>
                    <div>
                        <p class="p1">Area: </p>
                        <input type="text"  id="p_area" name="p_area" >


                        <br>

                        <p class="p1">Status: </p>
                        <div class="select">
                            <select class="form-select" id="p_status" aria-label="Default select example" name="p_status">
                                <option id="Available" value="Available" selected>Available</option>
                                <option id="Occupied" value="Occupied">Occupied</option>
                            </select>
                        </div>
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
