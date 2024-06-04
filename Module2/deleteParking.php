<?php
// Check if the p_id parameter is provided in the URL
if (isset($_GET['p_id'])) {
    // Get the p_id parameter from the URL
    $p_id = $_GET['p_id'];
    echo "Received p_id: $p_id"; // Debugging

    // Your database connection code
    require_once('../includes/connect.php'); // Adjust the path as needed

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM ParkingSpace WHERE p_id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $p_id); // Assuming p_id is an integer
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Parking area with ID $p_id deleted successfully";
            echo '<script>window.history.back();</script>'; // Go back to the previous page
        } else {
            echo "Error deleting parking area: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Error: p_id parameter not provided in the URL";
}
?>
