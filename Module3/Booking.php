<?php
session_start();
include '../includes/connect.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uid = $_SESSION['User'];
        $vid = $_SESSION['VehiclePlate'];
        
        $psid = $_POST['parking'];
        $pid = substr($psid, -2);
        $qr_code = 'test';
        $startDateTime = $_POST['startDateTime'];
        $endDateTime = $_POST['endDateTime'];
        $status = "Pending";

        // Check if the vehicle belongs to the user
        $stmt = $conn->prepare("SELECT * FROM vehicle WHERE v_id = ? AND u_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param("si", $vid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Create a booking ID (this is just a simple example, you might want a better way to generate booking IDs)
            $bid = uniqid();
            // Insert the booking
            $stmt = $conn->prepare("INSERT INTO Booking (b_id, v_id, p_id, b_qr, b_status, ps_id) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            // Correct the bind_param call to match the number of variables
            $stmt->bind_param("ssssss", $bid, $vid, $pid, $qr_code, $status, $psid);

            if ($stmt->execute()) {
                // Insert into BookingDuration table
                $bookingDurationID = uniqid();
                $stmt2 = $conn->prepare("INSERT INTO BookingDuration (bd_id, bd_start_time, bd_end_time, b_id) VALUES (?, ?, ?, ?)");
                if (!$stmt2) {
                    throw new Exception("Prepare statement failed: " . $conn->error);
                }
                $stmt2->bind_param("ssss", $bookingDurationID, $startDateTime, $endDateTime, $bid);

                if ($stmt2->execute()) {
                    header('Location: Booking Details.php?b_id=' . $bid);
                    exit(); // Always call exit() after a header redirection
                } else {
                    throw new Exception("Execute failed: " . $stmt2->error);
                }
            } else {
                throw new Exception("Execute failed: " . $stmt->error);
            }
        } else {
            echo 'Vehicle not found or does not belong to the user';
        }

        
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/headerLoggedIn.php'; 
    ?>

    <style>
        label {
            color: white;
            font-size: 20px;
        }
    </style>
</head>

<body>
<form action="Booking.php" method="POST">
    <div class="row">
        <div class="col leftcol">
            
            <div class="form middleForm text-center" style="margin-top:25vh;">
                <h1>Select Parking:</h1>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php 
                        $allarea = mysqli_query($conn, "SELECT * from ParkingSpace");
                        while($c = mysqli_fetch_array($allarea)){
                    ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="'.<?php echo $c['p_id']?>.'" data-bs-toggle="tab" data-bs-target="#<?php echo $c['p_id']?>" type="button" role="tab" aria-controls="<?php echo $c['p_id']?>"><?php echo $c['p_id']?></button>
                    </li>
                    <?php } ?>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <?php 
                        $all= mysqli_query($conn, "SELECT * from ParkingSpace");
                        while($c = mysqli_fetch_array($all)){
                    ?>
                    <div class="tab-pane fade" id="<?php echo $c['p_id']?>" role="tabpanel" aria-labelledby="<?php echo $c['p_id']?>">
                            <table>
                            <?php 
                            $allps = mysqli_query($conn, "SELECT * from ParkingSpot WHERE p_id = '". $c['p_id'] ."'");
                            $count = 0;
                            while($d = mysqli_fetch_array($allps)){
                                
                                if($count == 0){
                                    echo '<div class="row">';
                                }
                                if ($d['ps_status'] == "Available"){
                                    ?>
                                    <div class="col">
                                    <label for="parking"><?php echo $d['ps_name']; ?></label>
                                    <input type="radio" name="parking" class="parking pEmpty" id="parking" value="<?php echo $d['ps_id']; ?>">
                                    <svg width="60" height="40" viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M58.5221 10.5307H54.8742C54.1665 10.5307 53.5108 10.9058 53.1153 11.5329L52.0745 13.1679L47.0373 4.26516C46.007 2.45664 44.2793 1.23037 42.3226 0.928068C34.1319 -0.309356 25.8156 -0.309356 17.6254 0.928068C15.6687 1.23043 13.9412 2.45664 12.9107 4.26516L7.8735 13.112L6.83274 11.477C6.43724 10.8443 5.78157 10.4692 5.07387 10.4692H1.42597C1.04609 10.4692 0.681834 10.6372 0.411229 10.9283C0.145833 11.2195 -0.00507827 11.6114 0.000130534 12.0202C0.000130534 13.0392 0.770288 13.8679 1.71744 13.8679H5.04788C5.32888 13.8623 5.60468 13.9519 5.83365 14.1255L6.36444 14.5399L4.80326 15.8613H4.80846C3.33575 17.1323 2.47716 19.0585 2.47716 21.0909V38.0795C2.47716 39.1378 3.27854 40 4.26201 40H10.9229C11.8908 39.972 12.6558 39.1209 12.6558 38.0795V35.1287H47.2923V38.0795C47.2923 39.1378 48.0937 40 49.0772 40H55.7381C56.7216 40 57.5229 39.1377 57.5229 38.0795V21.1525C57.5281 19.1144 56.6695 17.1883 55.1916 15.9173L53.6304 14.5959L54.1612 14.1816L54.1664 14.1872C54.3954 14.0136 54.6712 13.924 54.9522 13.924H58.2826C58.7406 13.924 59.1777 13.7336 59.5003 13.3865C59.8177 13.0393 59.9999 12.569 59.9999 12.0763C60.0051 11.6563 59.849 11.2532 59.568 10.962C59.2922 10.6709 58.9123 10.5139 58.5221 10.5307ZM10.4439 27.8433C8.74747 27.8489 7.21228 26.7514 6.55658 25.066C5.9061 23.3807 6.25995 21.4378 7.45683 20.1443C8.65891 18.8453 10.4646 18.4589 12.031 19.1589C13.6026 19.8532 14.6277 21.4993 14.6277 23.3303C14.6277 25.8164 12.7544 27.8377 10.4439 27.8433ZM10.3242 13.5093L14.8255 5.58085V5.58645C15.5124 4.37142 16.6728 3.55948 17.9842 3.39163C25.9616 2.171 34.0635 2.171 42.0419 3.39163C43.3377 3.5708 44.4877 4.3827 45.159 5.58645L49.6602 13.5149L10.3242 13.5093ZM49.5034 27.8433C47.8071 27.8433 46.277 26.7458 45.6265 25.0549C44.9761 23.3695 45.3351 21.4266 46.5372 20.1387C47.7341 18.8453 49.5398 18.4589 51.1114 19.1589C52.6777 19.8588 53.6977 21.5049 53.6977 23.3304C53.6977 24.5286 53.2553 25.6764 52.4695 26.522C51.6838 27.3674 50.6171 27.8433 49.5034 27.8433Z"/>
                                    </svg>
                                    
                                    </div>
                                    
                                <?php
                                }else if ($d['ps_status'] == "Occupied"){
                                    ?>
                                    <div class="col">
                                    <label for="parking"><?php echo $d['ps_name']; ?></label>
                                    <input type="radio" name="parking" class="parking pOccupied" id="parking" value="<?php echo $d['ps_id']; ?>"disabled>
                                    <svg width="60" height="40" viewBox="0 0 60 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M58.5221 10.5307H54.8742C54.1665 10.5307 53.5108 10.9058 53.1153 11.5329L52.0745 13.1679L47.0373 4.26516C46.007 2.45664 44.2793 1.23037 42.3226 0.928068C34.1319 -0.309356 25.8156 -0.309356 17.6254 0.928068C15.6687 1.23043 13.9412 2.45664 12.9107 4.26516L7.8735 13.112L6.83274 11.477C6.43724 10.8443 5.78157 10.4692 5.07387 10.4692H1.42597C1.04609 10.4692 0.681834 10.6372 0.411229 10.9283C0.145833 11.2195 -0.00507827 11.6114 0.000130534 12.0202C0.000130534 13.0392 0.770288 13.8679 1.71744 13.8679H5.04788C5.32888 13.8623 5.60468 13.9519 5.83365 14.1255L6.36444 14.5399L4.80326 15.8613H4.80846C3.33575 17.1323 2.47716 19.0585 2.47716 21.0909V38.0795C2.47716 39.1378 3.27854 40 4.26201 40H10.9229C11.8908 39.972 12.6558 39.1209 12.6558 38.0795V35.1287H47.2923V38.0795C47.2923 39.1378 48.0937 40 49.0772 40H55.7381C56.7216 40 57.5229 39.1377 57.5229 38.0795V21.1525C57.5281 19.1144 56.6695 17.1883 55.1916 15.9173L53.6304 14.5959L54.1612 14.1816L54.1664 14.1872C54.3954 14.0136 54.6712 13.924 54.9522 13.924H58.2826C58.7406 13.924 59.1777 13.7336 59.5003 13.3865C59.8177 13.0393 59.9999 12.569 59.9999 12.0763C60.0051 11.6563 59.849 11.2532 59.568 10.962C59.2922 10.6709 58.9123 10.5139 58.5221 10.5307ZM10.4439 27.8433C8.74747 27.8489 7.21228 26.7514 6.55658 25.066C5.9061 23.3807 6.25995 21.4378 7.45683 20.1443C8.65891 18.8453 10.4646 18.4589 12.031 19.1589C13.6026 19.8532 14.6277 21.4993 14.6277 23.3303C14.6277 25.8164 12.7544 27.8377 10.4439 27.8433ZM10.3242 13.5093L14.8255 5.58085V5.58645C15.5124 4.37142 16.6728 3.55948 17.9842 3.39163C25.9616 2.171 34.0635 2.171 42.0419 3.39163C43.3377 3.5708 44.4877 4.3827 45.159 5.58645L49.6602 13.5149L10.3242 13.5093ZM49.5034 27.8433C47.8071 27.8433 46.277 26.7458 45.6265 25.0549C44.9761 23.3695 45.3351 21.4266 46.5372 20.1387C47.7341 18.8453 49.5398 18.4589 51.1114 19.1589C52.6777 19.8588 53.6977 21.5049 53.6977 23.3304C53.6977 24.5286 53.2553 25.6764 52.4695 26.522C51.6838 27.3674 50.6171 27.8433 49.5034 27.8433Z" fill="#929292"/>
                                    </svg>
                                    
                                    </div>
                                    
                                <?php
                                }
                                if($count >= 4){
                                    echo '</div>';
                                }
                                $count++;
                                if($count == 4){
                                    $count = 0;
                                }
                                ?>

                        <?php 
                            }
                        ?>

                            </table>
                        
                    
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="col midcol">
            <div class="form middleForm text-center" style="margin-top:25vh;">
                <h1 class="title fw-bolder text-light">Book Parking</h1>
                
                    <label for="v_id">Vehicle Plate No:</label><br>
                    <input class="mb-2" type="text" id="v_id" name="v_id" value="<?php echo $_SESSION['VehiclePlate']; ?>" Disabled /><br>
                    <label for="p_id">Parking Space:</label><br>
                    
                    <label for="startDateTime">Start:</label><br>
                    <input class="mb-2" type="datetime-local" id="startDateTime" name="startDateTime" required /><br>
                    <label for="endDateTime">End:</label><br>
                    <input class="mb-2" type="datetime-local" id="endDateTime" name="endDateTime" required /><br>
                    <input id="btnCBook" name="btnCBook" class="btn btn-primary" type="submit" value="Confirm" />
                
            </div>
        </div>
    </div>
    </form>
</body>

</html>