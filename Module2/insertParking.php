<?php
session_start();
require_once('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aid = $_SESSION['Admin'];
    $p_area = $_POST['p_area'];
    $p_id = $p_area;

    $p_status = $_POST['p_status'];

    // SQL query to insert data into the database
    $query = mysqli_query($conn,"SELECT * FROM ParkingSpace WHERE p_id = '$p_area'");
    $data = mysqli_fetch_array($query, MYSQLI_NUM);
    if($data[0] > 1){
        echo '
                <script type="text/javascript">
                    alert("Parking Space already existed!");
                    window.location.href="ViewParkingArea.php";

                    </script>
                ';
    }else{
        $sql = mysqli_query($conn,"INSERT INTO ParkingSpace ( p_id, a_id, p_area, p_status) VALUES ('$p_id', '$aid','$p_area', '$p_status')"); // kena ada mysqli_query

        // Execute the query
        if ($sql) {
            echo '
                    <script type="text/javascript">
                        alert("Parking space successfully added!");
                        window.location.href="ViewParkingArea.php";

                        </script>
                    ';

        } else {
            echo '
                    <script type="text/javascript">
                        alert("Something went wrong!!");
                        window.location.href="AddParking.php";

                        </script>
                    ';
        }
    }

} else {
    echo "Form submission method not valid.";
}


// Close the database connection
$conn->close();
?>
