<!DOCTYPE html>
<html>
<head>
    <title>Edit Traffic Summon</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style4.css">

    <!-- Bootstrap -->
    <?php
       // session_start();
       // include '../includes/connect.php';
        include '../includes/bootstrap.php'; 
        include '../includes/connect.php'; 
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
<?php
    if (isset($_GET['s_id'])) {
        $sid = $_GET['s_id'];
        echo "<script>console.log('Debug Objects: " . $s_id . "' );</script>";
        $query = mysqli_query($conn, "SELECT * FROM Summon WHERE s_id = '$sid'");
        while ($row = mysqli_fetch_array($query)){
?>
<body>
    <form method="POST">
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
                            <input type="v_id" id="v_id" name="v_id" value="<?php echo $row['v_id']?>" disabled/>
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
                            <input type="text" id="s_note" name="s_note" value="<?php echo $row['s_note']?>" required>
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
<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $sid = $_GET['s_id'];
            $v_id = $_POST['v_id'];
            $s_violation = $_POST['s_violation'];
            $s_date = $_POST['s_date'];
            $s_note = $_POST['s_note'];
            $queryupdate = mysqli_query($conn, "UPDATE Summon SET s_violation = '$s_violation', s_note = '$s_note', s_date = '$s_date' WHERE s_id = '$sid'");
            if($queryupdate){
                echo '
                        <script type="text/javascript">
                            alert("Summon have been updated!");
                              setTimeout(function(){
                                window.location.href="ukDashboard.php";
                            },1000);
        
                            </script>
                        ';
            }else{
                echo '
                        <script type="text/javascript">
                            alert("There is something wrong!");
                              setTimeout(function(){
                                window.location.href="ukDashboard.php";
                            },1000);
        
                            </script>
                        ';
            }
        }

        }
    }
?>