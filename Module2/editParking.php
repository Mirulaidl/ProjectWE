<!DOCTYPE html>
<html>
<head>
<title>Edit Parking</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="parking.css">
<!-- Bootstrap -->
<?php include '../includes/bootstrap.php'; ?>

</head>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?>

    <form method="POST" action="updateParking.php">
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Edit Parking Area</h1>
                    <div>

                    <br>
                        <p class="p1">Parking: </p>
                        <input type="text"  id="p_id" name="p_id" value="">
                        <p class="p1">Area: </p>
                        <div class="select">
                            <select class="form-select" id="p_area" aria-label="Default select example" name="p_area">
                                <option id="p_area" value="B1" selected>B1</option>
                                <option id="p_area" value="B2">B2</option>
                                <option id="p_area" value="B3">B3</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>


                        <p class="p1">Status: </p>
                        <div class="select">
                            <select class="form-select" id="p_status" aria-label="Default select example" name="p_status">
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
