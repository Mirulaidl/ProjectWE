<?php
session_start();
include '../includes/connect.php';

// Fetch booking details based on the booking ID passed in the URL
$bookingId = isset($_GET['b_id']) ? $_GET['b_id'] : '';

if ($bookingId) {
    $stmt = $conn->prepare("SELECT * FROM Booking WHERE b_id = ?");

    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();


    $stmt->close();
} else {
    die("Booking ID is required.");
}

// Retrieve the BookingDuration data
$stmt2 = $conn->prepare("SELECT * FROM BookingDuration WHERE b_id = ?");
if (!$stmt2) {
    throw new Exception("Prepare statement failed: " . $conn->error);
}
$stmt2->bind_param("s", $bookingId);
$stmt2->execute();
$bookingDurationResult = $stmt2->get_result();

// Check if the BookingDuration data exists
if ($bookingDurationResult->num_rows > 0) {
    // Fetch the data
    $bookingDurationData = $bookingDurationResult->fetch_assoc();
} else {
    echo 'BookingDuration data not found.';
}

$stmt2->close();
$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <!-- Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/headerLoggedIn.php'; ?>
    <style>
        .booking-details {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10vh;
        }

        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container text-center">
        <div class="booking-details mx-auto" style="margin-top:20vh;">
            <h1>Your Booking Details</h1>
            <div class="overview">
                <p><strong>Vehicle Plate No.:</strong> <?php echo $booking['v_id']; ?></p>
                <p><strong>Parking Space:</strong> <?php echo $booking['p_id']; ?></p>
                <p><strong>Start:</strong> <?php echo $bookingDurationData['bd_start_time']; ?></p>
                <p><strong>End:</strong> <?php echo $bookingDurationData['bd_end_time']; ?></p>
                <div class="d-flex justify-content-center mb-2">
                    <div class="qr-code text-center" id="qr_code"></div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" onclick="window.location.href = 'EditBooking.php?b_id=<?php echo $booking['b_id']; ?>'">Edit</button>
            <form action="deleteBooking.php" method="POST">
                <input type="hidden" name="b_id" value="<?php echo $booking['b_id']; ?>">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>

    <script>
        var qrCodeData = "<?php echo $booking['v_id'] . ' ' . $booking['p_id']; ?>";
        var qrcode = new QRCode("qr_code", {
            text: qrCodeData,
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>
</body>

</html>