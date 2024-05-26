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

    <form>
        <div class="row">
            <div class="col leftcol"></div>
            <div class="col midcol">
                <div class="form middleForm text-center">
                    <h1>Add Parking Area</h1>
                    <div>
                        <p class="p1">Area: </p>
                        <input type="text"  id="area" name="area" >


                        <br>
                        <p class="p1">Parking: </p>
                        <input type="text"  id="parking" name="parking" >
                        <br>

                        <p class="p1">Status: </p>
                        <input type="text"  id="status" name="status" >


                        <div class="row">
                       
                            <div class="col"></div>
                            <br>
                            <div class="col text-center">
                            <br>
                                <input class="btn btn-primary" name="Add" type="Add" value="Add" />
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
