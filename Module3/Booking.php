<?php
session_start();
include '../includes/connect.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uid = $_SESSION['User'];
        $vid = $_POST['v_id'];
        $pid = $_POST['p_id'];
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
            $stmt = $conn->prepare("INSERT INTO Booking (b_id, v_id, p_id, b_qr, b_status) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            // Correct the bind_param call to match the number of variables
            $stmt->bind_param("sssss", $bid, $vid, $pid, $qr_code, $status);

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

        $stmt->close();
        $conn->close();
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
    <div class="row">
        <div class="col leftcol">
            
            <div class="form middleForm text-center" style="margin-top:25vh;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php 
                    $allarea = mysqli_query($conn, "SELECT * from ParkingSpace");
                    while($c = mysqli_fetch_array($allarea)){
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="<?php echo $c['p_id']?>" data-bs-toggle="tab" data-bs-target="#<?php echo $c['p_id']?>" type="button" role="tab" aria-controls="contact" aria-selected="false"><?php echo $c['p_id']?></button>
                </li>
                <?php } ?>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <?php 
                        $allarea = mysqli_query($conn, "SELECT * from ParkingSpace");
                        while($c = mysqli_fetch_array($allarea)){
                    ?>
                    <div class="tab-pane fade" id="<?php echo $c['p_id']?>" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- TAK SIAP DISINI -->
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="col midcol">
            <div class="form middleForm text-center" style="margin-top:25vh;">
                <h1 class="title fw-bolder text-light">Making Booking</h1>
                <form action="Booking.php" method="POST">
                    <label for="v_id">Vehicle Plate No:</label><br>
                    <input class="mb-2" type="text" id="v_id" name="v_id" placeholder="Enter your Vehicle Plate No" required /><br>
                    <label for="p_id">Parking Space:</label><br>
                    <div class="select">
                        <select class="form-select" id="p_id" aria-label="Default select example" name="p_id">
                            <?php 
                                $allarea = mysqli_query($conn, "SELECT * from ParkingSpace");
                                while($c = mysqli_fetch_array($allarea)){
                            ?>
                                <option value="<?php echo $c['p_id']?>"><?php echo $c['p_id']?></option>
                            <?php } ?>
                        </select>
                        <div class="select_arrow"></div>
                    </div><br>
                    <label for="startDateTime">Start:</label><br>
                    <input class="mb-2" type="datetime-local" id="startDateTime" name="startDateTime" required /><br>
                    <label for="endDateTime">End:</label><br>
                    <input class="mb-2" type="datetime-local" id="endDateTime" name="endDateTime" required /><br>
                    <input id="btnCBook" name="btnCBook" class="btn btn-primary" type="submit" value="Confirm" />
                </form>
            </div>
        </div>
    </div>

</body>

</html>