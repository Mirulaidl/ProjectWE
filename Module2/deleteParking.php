<?php
// Your database connection code
require_once('../includes/connect.php'); // Adjust the path as needed
// Check if the p_id parameter is provided in the URL
if (isset($_GET['p_id'])) {
    // Get the p_id parameter from the URL
    $p_id = $_GET['p_id'];

    

    // Use a prepared statement to prevent SQL injection
    $sql = mysqli_query($conn,"DELETE FROM ParkingSpace WHERE p_id = '$p_id'");
    if($sql){
        echo '
                    <script type="text/javascript">
                        alert("Parking Area have been deleted!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },1000);
    
                        </script>
                    ';
    }else{
        echo '
                    <script type="text/javascript">
                        alert("There is something wrong bro!");
                          setTimeout(function(){
                            window.location.href="ViewParkingArea.php";
                        },1000);
    
                        </script>
                    ';
    }
    

} else {
    echo "Error: p_id parameter not provided in the URL";
}
?>
