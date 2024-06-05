<?php
// Check if the s_id parameter is provided in the URL
if (isset($_GET['s_id'])) {
    // Get the s_id parameter from the URL
    $s_id = $_GET['s_id'];
    echo "<script>console.log('Debug Objects: " . $s_id . "' );</script>";

    // Your database connection code
    require_once('../includes/connect.php'); // Adjust the path as needed

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM Summon WHERE s_id = '$s_id'";
    
    // Prepare the statement
    $stmt = mysqli_query($conn, $sql);
    if ($stmt) {

        echo '
                    <script type="text/javascript">
                        alert("Summon have been deleted!");
                          setTimeout(function(){
                            window.location.href="ukDashboard.php";
                        },1000);
    
                        </script>
                    ';
    } else {
        echo '
                    <script type="text/javascript">
                        alert("There is something wrong!);
                          setTimeout(function(){
                            window.location.href="ukDashboard.php";
                        },1000);
    
                        </script>
                    ';
    }

} else {
    echo "Error: s_id parameter not provided in the URL";
}
?>
