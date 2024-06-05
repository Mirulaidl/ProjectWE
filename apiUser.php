<?php 
session_start();
include('includes/connect.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);


if ($_GET['getSumPark']){

    $userID = $_POST['userID'];

    $sql = "SELECT * from ParkingSpace";
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $areaName[] = $row['p_id'];
        $totalArea = count($areaName);
    }

    $sql2 = "SELECT * from ParkingSpot";
    $result2 = $conn->query($sql2);
    $result2 = $result2->fetch_all(MYSQLI_ASSOC);

    foreach($result2 as $row2){
        $spotName[] = $row2['ps_name'];
        $spotarea[] = $row2['p_id'];
        $totalSpot = count($spotName);
    }

    $sql2 = "SELECT * from ParkingSpot WHERE ";
    $result2 = $conn->query($sql2);
    $result2 = $result2->fetch_all(MYSQLI_ASSOC);

    //tak siap lagi

    echo json_encode([
        "" => $
    ])
}

?>