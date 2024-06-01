<?php
session_start();
require_once('../includes/connect.php');

if (isset($_POST['submit'])) {

    $v_id = $_POST['v_id'];
    $s_violation = $_POST['s_violation'];
    $s_date = $_POST['s_date'];
    $s_note = $_POST['s_note'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO Summon (v_id, s_violation, s_date, s_note) VALUES ('$v_id', '$s_violation', '$s_date', '$s_note')";

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
