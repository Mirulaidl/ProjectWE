<?php
// Your database connection code
require_once('../includes/connect.php'); // Adjust the path as needed
// Check if the p_id parameter is provided in the URL
if (isset($_GET['v_id'])) {
    // Get the p_id parameter from the URL
    $v_id = $_GET['v_id'];

    $approve = "Approved";

    // Use a prepared statement to prevent SQL injection
    $sql = mysqli_query($conn,"UPDATE vehicle SET v_status = '$approve' WHERE v_id = '$v_id'");
    if($sql){
        echo '
                    <script type="text/javascript">
                        alert("Vehicle have been approved!");
                          setTimeout(function(){
                            window.location.href="adminVehicleReg.php";
                        },1000);
    
                        </script>
                    ';
    }else{
        echo '
                    <script type="text/javascript">
                        alert("There is something wrong bro!");
                          setTimeout(function(){
                            window.location.href="adminVehicleReg.php";
                        },1000);
    
                        </script>
                    ';
    }
    

} else {
    echo "Error: v_id parameter not provided in the URL";
}

?>
