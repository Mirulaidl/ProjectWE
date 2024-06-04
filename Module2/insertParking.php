<?php
session_start();
require_once('../includes/connect.php');

if (isset($_POST['submit'])) {
    $p_area = $_POST['p_area'];
    $p_id = $_POST['p_id'];
    $p_status = $_POST['p_status'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO ParkingSpace (p_area, p_id, p_status) VALUES ('$p_area', '$p_id', '$p_status')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form submission method not valid.";
}

// Close the database connection
$conn->close();
?>
