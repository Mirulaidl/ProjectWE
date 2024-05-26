<!DOCTYPE html>
<html>
    <head>
        <title>Booking Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">

        <!-- Bootstrap -->
        <?php
        include '../includes/bootstrap.php';
        ?>
    </head>

    <!-- Connect Css -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->

    <?php
    include '../includes/headerLoggedIn.php';
    ?>

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

    <body>
    <div class="container text-center">
        <div class="booking-details mx-auto" style="margin-top:20vh;">
            <h1>Your Booking Details</h1>
            <div class="overview">
                <p><strong>Vehicle Plate No.:</strong></p>
                <p><strong>Parking Space:</strong></p>
                <p><strong>Date:</strong></p>
                <p><strong>Duration:</strong></p>
                <div class="qr-code">
                    <img src="generate_qr_code.php?data=" alt="QR Code">
                </div>
            </div>
            <button class="btn btn-primary" onclick="editBooking()">Edit</button>
            <button class="btn btn-danger" onclick="deleteBooking()">Delete</button>
        </div>
    </div>

        <script>
            function editBooking() {
                window.history.back();
            }
            
            function deleteBooking() {
                // Implement booking deletion logic here
                alert('Booking deleted.');
            }
        </script>
    </body>
</html>