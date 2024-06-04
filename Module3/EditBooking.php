<?php
session_start();
include '../includes/connect.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uid = 'cd22098';
        $bid = $_POST['b_id'];
        $vid = $_POST['v_id'];
        $pid = $_POST['p_id'];
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
            // Update the booking
            $stmt = $conn->prepare("UPDATE Booking SET v_id = ?, p_id = ?, b_status = ? WHERE b_id = ?");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            $stmt->bind_param("ssss", $vid, $pid, $status, $bid);

            if ($stmt->execute()) {
                // Update the booking duration
                $stmt2 = $conn->prepare("UPDATE BookingDuration SET bd_start_time = ?, bd_end_time = ? WHERE b_id = ?");
                if (!$stmt2) {
                    throw new Exception("Prepare statement failed: " . $conn->error);
                }
                $stmt2->bind_param("sss", $startDateTime, $endDateTime, $bid);

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
    } else {
        // Get the booking id from the URL
        $bid = $_GET['b_id'];

        // Retrieve the Booking data
        $stmt = $conn->prepare("SELECT * FROM Booking WHERE b_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param("s", $bid);
        $stmt->execute();
        $bookingResult = $stmt->get_result();

        // Retrieve the BookingDuration data
        $stmt2 = $conn->prepare("SELECT * FROM BookingDuration WHERE b_id = ?");
        if (!$stmt2) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt2->bind_param("s", $bid);
        $stmt2->execute();
        $bookingDurationResult = $stmt2->get_result();

        // Check if the Booking and BookingDuration data exist
        if ($bookingResult->num_rows > 0 && $bookingDurationResult->num_rows > 0) {
            // Fetch the data
            $bookingData = $bookingResult->fetch_assoc();
            $bookingDurationData = $bookingDurationResult->fetch_assoc();
        } else {
            echo 'Booking not found or does not have BookingDuration data';
        }

        $stmt->close();
        $stmt2->close();
        $conn->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/headerLoggedIn.php'; ?>

    <style>
        label {
            color: white;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col leftcol"></div>
        <div class="col midcol">
            <div class="form middleForm text-center" style="margin-top:25vh;">
                <h1 class="title fw-bolder text-light">Edit Booking</h1>
                <form action="EditBooking.php" method="POST">
                    <input type="hidden" name="b_id" value="<?php echo $_GET['b_id']; ?>">
                    <label for="v_id">Vehicle Plate No:</label><br>
                    <input class="mb-2" type="text" id="v_id" name="v_id" placeholder="Enter your Vehicle Plate No" required value="<?php echo $bookingData['v_id']; ?>" /><br>
                    <label for="p_id">Parking Space:</label><br>
                    <div class="select">
                        <select id="p_id" name="p_id" required>
                            <option value="" disabled selected>Select a space</option>
                            <option value="B1" <?php if ($bookingData['p_id'] == 'B1') echo 'selected'; ?>>B1</option>
                            <option value="B2" <?php if ($bookingData['p_id'] == 'B2') echo 'selected'; ?>>B2</option>
                            <option value="B3" <?php if ($bookingData['p_id'] == 'B3') echo 'selected'; ?>>B3</option>
                        </select>
                        <div class="select_arrow"></div>
                    </div><br>
                    <label for="startDateTime">Start:</label><br>
                    <input class="mb-2" type="datetime-local" id="startDateTime" name="startDateTime" required value="<?php echo $bookingDurationData['bd_start_time']; ?>" /><br>
                    <label for="endDateTime">End:</label><br>
                    <input class="mb-2" type="datetime-local" id="endDateTime" name="endDateTime" required value="<?php echo $bookingDurationData['bd_end_time']; ?>" /><br>
                    <input id="btnEBook" name="btnEBook" class="btn btn-primary" type="submit" value="Edit" />
                </form>
            </div>
        </div>
        <div class="col rightcol"></div>
    </div>

</body>

</html>
