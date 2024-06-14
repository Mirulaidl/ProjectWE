<?php
// Include database connection
require_once('../includes/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the s_id from the POST request
    $s_id = isset($_POST['s_id']) ? intval($_POST['s_id']) : 0;

    if ($s_id > 0) {
        // Use a prepared statement to prevent SQL injection
        $sql = "DELETE FROM Summon WHERE s_id = ?";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("i", $s_id);

        if ($stmt->execute()) {
            echo '
                <script type="text/javascript">
                    alert("Summon has been deleted!");
                    setTimeout(function(){
                        window.location.href="ukDashboard.php";
                    }, 1000);
                </script>
            ';
        } else {
            echo '
                <script type="text/javascript">
                    alert("There was an error deleting the summon.");
                    setTimeout(function(){
                        window.location.href="ukDashboard.php";
                    }, 1000);
                </script>
            ';
        }

        $stmt->close();
    } else {
        echo '
            <script type="text/javascript">
                alert("Invalid summon ID.");
                setTimeout(function(){
                    window.location.href="ukDashboard.php";
                }, 1000);
            </script>
        ';
    }
} else {
    echo '
        <script type="text/javascript">
            alert("Invalid request method.");
            setTimeout(function(){
                window.location.href="ukDashboard.php";
            }, 1000);
        </script>
    ';
}

$conn->close();
?>
