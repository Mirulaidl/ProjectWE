<?php
// Your database connection code
require_once('../includes/connect.php'); // Adjust the path as needed

if (isset($_GET['u_id'])) {
    // Get the p_id parameter from the URL
    $u_id = $_GET['u_id'];

    // Use a prepared statement to prevent SQL injection
    $sql = mysqli_query($conn,"DELETE FROM users WHERE u_id = '$u_id'");
    if($sql){
        echo '
                    <script type="text/javascript">
                        alert("Vehicle have been rejected!");
                          setTimeout(function(){
                            window.location.href="adminUserApproval.php";
                        },1000);
    
                        </script>
                    ';
    }else{
        echo '
                    <script type="text/javascript">
                        alert("There is something wrong bro!");
                          setTimeout(function(){
                            window.location.href="adminUserApproval.php";
                        },1000);
    
                        </script>
                    ';
    }
    

} else {
    echo "Error: p_id parameter not provided in the URL";
}
?>
