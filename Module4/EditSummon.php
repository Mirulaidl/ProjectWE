<!DOCTYPE html>
<html>
<head>
    <title>Edit Traffic Summon</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <?php
       // session_start();
       // include '../includes/connect.php';
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
    <form action="updateSummon.php" method="POST">
        <div class="row">
            <div class="col leftcol">
            </div>

            <div class="col midcol">
                <div class="form middleForm text-center" style="margin-top:30vh;">

                    <h1 class ="title fw-bolder text-light">Traffic Summon</h1>

                    <div class="row">
                        <div class="col"> 
                            <label for="v_id">Vehicle Plate No:</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <input type="v_id" id="v_id" name="v_id" placeholder="Enter your Vehicle Plate No" required/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"> 
                            <label for="s_violation">Violation Type:</label> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <select  class="select" id="s_violation" name="s_violation" required>
                                <option value="" disabled selected>Select a violation</option>
                                <option id="Parking" value="Parking Violation">Parking Violation</option>
                                <option id="Traffic" value="Traffic Violation">Traffic Violation</option>
                                <option id="Accident" value="Accident">Accident</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"> 
                            <label for="s_date">Date:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="date" id="s_date" name="s_date" placeholder="Select a date" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"> 
                            <label for="s_note">Notes:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" id="s_note" name="s_note" required>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <!--<input type="hidden" name="action" value="add">
                            <button class="btn btn-primary" type="submit">Add Summon</button>-->
                            <input class="btn btn-primary" name="submit" type="submit" value="Update Summon" />
                        </div>
                    </div>
                </div>
            </div>
                        <div class="col rightcol">

                        </div>
                        
        </div>
    </form>
    
</body>
</html>