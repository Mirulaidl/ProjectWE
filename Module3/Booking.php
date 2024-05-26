<!DOCTYPE html>
<html>
    <head>
        <title>Booking</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">

        <!-- Bootstrap -->
        <?php
        include '../includes/bootstrap.php';
        ?>
    </head>

    <!-- Connect Css -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->

    <?php
    include '../includes/headerLoggedIn.php';
    ?>

    <style>
        label {
            color: white;
            font-size: 20px;
        }
        
    </style>

    <body>
        <div class="row">
            <div class="col leftcol">

            </div>
            
            <div class="col midcol">
                <div class="form middleForm text-center" style="margin-top:25vh;">
                
                    <h1 class ="title fw-bolder text-light">Making Booking</h1>
                
                    <label for="v_id">Vehicle Plate No:</label>
                    <br>
                    <input class="mb-2" type="v_id" name="v_id" placeholder="Enter your Vehicle Plate No" required/>
                    <br>
                
                    <label for="p_id">Parking Space:</label>
                    <br>
                
                    <div class="select">
                        <select id="p_id" name="p_id" required>
                            <option value="" disabled selected>Select a space</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="B3">B3</option>
                        </select>
                        <div class="select_arrow"></div>
                    </div>
                    <br>
                
                    <label for="startDateTime">Start:</label>
                    <br>
                    <input class="mb-2" type="datetime-local" id="startDateTime" name="startDateTime" required/>
                    <br>
                
                    <label for="endDateTime">End:</label>
                    <br>
                    <input class="mb-2" type="datetime-local" id="endDateTime" name="endDateTime" required/>
                    <br>

                    <input class="btn btn-primary" name="submit" type="submit" value="Confirm" />
                </div>
            </div>

            <div class="col rightcol">

            </div>
            
        </div>
        
    </body>
</html>