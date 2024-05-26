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

    <form>
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Edit Parking Area</h1>
                    <div>
                        <p class="p1">Area: </p>
                        <div class="select">
                            <select class="form-select" id="area" aria-label="Default select example" name="area">
                                <option id="B1" value="B1" selected>B1</option>
                                <option id="B2" value="B2">B2</option>
                                <option id="B3" value="B3">B3</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>

                        <br>
                        <p class="p1">Parking: </p>
                        <input type="text"  id="parking" name="parking" placeholder="STD66">

                        <p class="p1">Status: </p>
                        <div class="select">
                            <select class="form-select" id="status" aria-label="Default select example" name="status">
                                <option id="Available" value="Available" selected>Available</option>
                                <option id="Occupied" value="Occupied">Occupied</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col"></div>
                            <div class="col text-center">
                                <input class="btn btn-primary" name="Confirm" type="Confirm" value="Confirm" />
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
