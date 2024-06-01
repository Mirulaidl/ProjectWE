<?php
session_start();
require_once('../includes/connect.php');

if (isset($_POST['submit'])) {
    $v_id = $_POST['v_id'];
    $s_violation = $_POST['s_violation'];
    $s_date = $_POST['s_date'];
    $s_note = $_POST['s_note'];

    $sql = "UPDATE Summon SET  s_violation='$s_violation', s_date='$s_date', s_note='$s_note' WHERE v_id='$v_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Traffic Summon updated successfully";
    } else {
        echo "Error updating traffic summon: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Form submission method not valid.";
}
?>
