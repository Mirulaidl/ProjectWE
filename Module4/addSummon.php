<?php
session_start();
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $random = rand(1000,9999);
    $ukid = $_SESSION['UnitKeselamatan'];
    $vid = $_POST['v_id'];

    //creating summon id
    $sid = $ukid . $vid . $random;

    $sviolation = $_POST['s_violation'];
    $sdate = $_POST['s_date'];
    $snote = $_POST['s_note'];

    // SQL query to insert data into the database
    $query = mysqli_query($conn, "INSERT INTO Summon (s_id, v_id, s_violation, s_note, uk_id, s_date) VALUES ('$sid', '$vid', '$sviolation', '$snote', '$ukid', '$sdate')");

    // Execute the query
    if ($query) {
        echo '
                    <script type="text/javascript">
                        alert("Summon Successfully added!");
                          setTimeout(function(){
                            window.location.href="ukDashboard.php";
                        },2000);
    
                        </script>
                    ';

    } else {
        echo '
                    <script type="text/javascript">
                        alert("There is something wrong!");
                          setTimeout(function(){
                            window.location.href="trafficSummon.php";
                        },2000);
    
                        </script>
                    ';
    }
} else {
    echo "Form submission method not valid.";
}

// // Close the database connection //jangan mengarut
// $conn->close();
?>
