<?php
session_start();
require_once('../includes/connect.php');

if (isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $p_area = $_POST['p_area'];
    $p_status = $_POST['p_status'];

    $sql = "UPDATE ParkingSpace SET p_area='$p_area', p_status='$p_status' WHERE p_id='$p_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Parking area updated successfully";
    } else {
        echo "Error updating parking area: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Form submission method not valid.";
}
?>
