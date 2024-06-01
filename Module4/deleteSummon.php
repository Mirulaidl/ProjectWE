<?php
// Check if the s_id parameter is provided in the URL
if (isset($_GET['s_id'])) {
    // Get the s_id parameter from the URL
    $s_id = $_GET['s_id'];
    echo "Received s_id: $s_id"; // Debugging

    // Your database connection code
    require_once('../includes/connect.php'); // Adjust the path as needed

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM Summon WHERE s_id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $s_id); // Assuming s_id is an integer
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Traffic Summon with ID $s_id deleted successfully";
            echo '<script>window.history.back();</script>'; // Go back to the previous page
        } else {
            echo "Error deleting traffic summon: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Error: s_id parameter not provided in the URL";
}
?>
