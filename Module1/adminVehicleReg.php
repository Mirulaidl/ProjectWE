<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Registeration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/connect.php'; ?>
    <!-- Include CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Include QRCode.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>
<?php include '../includes/headerLoggedIn.php'; ?> 
    <div class="container" style="margin-top:15vh;"> 
    <h1>Vehicle Registration</h1>
            <table id="vehicleTable" class="table caption-top">
                <thead class="table-success">
                    <tr>
                        <th>Plate</th>
                        <th>Type</th>
                        <th>Grant</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
            
    </div>
    <script>
                function fetchData() {
                    fetch('getDataV.php')
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.querySelector('#vehicleTable tbody');
                            tableBody.innerHTML = ''; // Clear existing rows

                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td>${row.v_plate_num}</td>
                                    <td>${row.v_type}</td>
                                    <td>${row.v_type}</td>
                                    <td>${row.v_status}</td>
                                        
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchData();
            </script>
</body>

</html>