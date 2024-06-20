<?php
// Include database connection
require_once('../includes/connect.php');
session_start();

// Fetch data from the database
$uid = $_SESSION['User'];
$vp = $_SESSION['VehiclePlate'];
// echo "<script>console.log('Debug Objects: '" . $vp . $uid . "' ');</script>";
$sql = "SELECT b_id, v_id, ps_id FROM booking WHERE v_id = '" . $vp . "'";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>