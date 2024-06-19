<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styleAdmin.css">
    <!-- Bootstrap -->
    <?php 
        session_start();
        include '../includes/connect.php';
        include '../includes/bootstrap.php';
    ?>
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?php include '../includes/headerLoggedIn.php'; ?>
<body>
    <div class="container" style="margin-top:15vh;">
        <center>
            <button type="button" class="col buttonAdmin" onclick="window.location.href='ViewParkingArea.php'" style="background-color:  dodgerblue;">
                <h3>Parking Area</h3>
            </button>
            <button type="button" class="col buttonAdmin" onclick="window.location.href='../Module1/adminUserApproval.php'" style="background-color:  dodgerblue;">
                <h3>User Approval</h3>
            </button>
            <button type="button" class="col buttonAdmin" onclick="window.location.href='../Module1/adminVehicleReg.php'" style="background-color:  dodgerblue;">
                <h3>Vehicle Registration</h3>
            </button>
        </center>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <div class="col">
                        <p>Welcome Back</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1>
                            <?php 
                                $username = $_SESSION['AdminName'];
                                echo "$username";
                            ?>
                        </h1>
                    </div>
                    <div class="col">
                        <div class="row"></div>
                        <div class="row"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <p>Fakulti Komputeran Parking Area</p>
                    <img src="../Asset/Img/Parking.svg" alt="Parking" style="height: 55vh;">
                </div>
                <div class="row"></div>
            </div>
            <div class="col outer">
                <canvas id="parkingSpotChart"></canvas>
                
                <h3 class="text-center">Total Booking</h3>
                <?php 
                    $sql = "SELECT COUNT(b_id) as booking_count FROM booking";
                    $result = $conn->query($sql);

                    $booking_count = 0;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $booking_count = $row["booking_count"];
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Function to fetch parking spot data and create chart
        function fetchParkingSpotData() {
            fetch('getDataSpot.php')
                .then(response => response.json())
                .then(data => {
                    const available = data.filter(spot => spot.ps_status === 'Available').length;
                    const occupied = data.filter(spot => spot.ps_status === 'Occupied').length;

                    // Create the chart
                    const ctx = document.getElementById('parkingSpotChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Available', 'Occupied'],
                            datasets: [{
                                label: 'Parking Spots',
                                data: [available, occupied],
                                backgroundColor: ['#4CAF50', '#FF5733'],
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Parking Spot Status'
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchParkingSpotData() when the page loads
        fetchParkingSpotData();

        // Function to fetch parking booking data and create chart
        var bookingCount = <?php echo $booking_count; ?>;

        // Prepare data for Chart.js
        var labels = ["Total Bookings"];
        var data = {
            labels: labels,
            datasets: [{
                label: 'Number of Bookings',
                data: [bookingCount],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configure the chart
        var config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            }
        };

        // Render the chart
        var bookingChart = new Chart(
            document.getElementById('bookingChart'),
            config
        );
    </script>
</body>
</html>
