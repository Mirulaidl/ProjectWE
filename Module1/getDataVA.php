<?php
// Include database connection
require_once('../includes/connect.php');

// Fetch data from the database
$pending = "Approved";
$sql = "SELECT v_id, v_plate_num, v_type, v_brand, v_status FROM vehicle WHERE v_status = '$pending'";
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
