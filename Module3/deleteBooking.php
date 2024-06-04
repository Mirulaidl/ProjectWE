<?php
session_start();
include '../includes/connect.php';

if (isset($_POST['b_id'])) {
    $bookingId = $_POST['b_id'];

    // Prepare and execute the delete statement for BookingDuration
    $stmt2 = $conn->prepare("DELETE FROM BookingDuration WHERE b_id = ?");
    $stmt2->bind_param("s", $bookingId);

    if (!$stmt2) {
        die("Prepare statement failed: " . $conn->error);
    }

    if ($stmt2->execute()) {
        // Prepare and execute the delete statement for Booking
        $stmt1 = $conn->prepare("DELETE FROM Booking WHERE b_id = ?");
        $stmt1->bind_param("s", $bookingId);

        if (!$stmt1) {
            die("Prepare statement failed: " . $conn->error);
        }

        if ($stmt1->execute()) {
            // Redirect back to a page, for example, the homepage
            header("Location: Booking.php");
            exit(); // Stop further execution
        } else {
            die("Failed to delete booking: " . $stmt1->error);
        }
    } else {
        die("Failed to delete booking duration: " . $stmt2->error);
    }
} else {
    die("Booking ID is required.");
}

$stmt1->close();
$stmt2->close();
$conn->close();
