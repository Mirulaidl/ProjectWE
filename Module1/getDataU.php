<?php
// Include database connection
require_once('../includes/connect.php');

// Fetch data from the database
$pending = "Pending";
$sql = "SELECT * FROM users WHERE u_status = '$pending'";
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
