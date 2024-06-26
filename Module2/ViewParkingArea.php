<!DOCTYPE html>
<html>
<head>
    <title>Parking Areas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/connect.php'; ?>
    <!-- Include CSS -->
    <link rel="stylesheet" href="parking.css">
    <!-- Include QRCode.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?> 
    <center>
    
    <div class="containerP plain-container"> 
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Parking Area</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Parking Spot</button>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <!-- // tab parking area -->
            <h1>PARKING AREAS</h1>
            <table id="parkingTable" class="table table-striped caption-top">
                <thead class="table-success">
                    <tr>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
            <div class="containerButton">
            <button class="btn addUpdate-button" onclick="history.go(-1);">Back </button>
                <button class="btn addUpdate-button" onclick="addParking()">Add</button>
            </div>
            <!-- // end parking area -->
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <!-- // tab parking spot -->
            <h1>PARKING SPOT</h1>
            <!-- Search Input Field for Parking Spot -->
            <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" id="searchParkingSpot" class="form-control form-control-sm" placeholder="Search for parking area">
                <button class="btn btn-primary btn-sm" onclick="searchParkingSpot()">Search</button>
            </div>
            <table id="parkingSpotTable" class="table table-striped caption-top">
                <thead class="table-success">
                    <tr>
                        <th>Spot</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>QR Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
            <div class="containerButton">
            <button class="btn addUpdate-button" onclick="history.go(-1);">Back </button>
                <button class="btn addUpdate-button" onclick="addParkingSpot()">Add</button>
            </div>
            <!-- // end parking spot -->
        </div>
    </div>
    </center>

    <script>
        // Function to fetch data from the database for parking area
        function fetchData() {
            fetch('getData.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#parkingTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.p_area}</td>
                            <td>${row.p_status}</td>
                            <td>
                                <button class="btn Edit-button" onclick="editParking('${row.p_id}')">Edit</button>
                                <button class="btn Delete-button" onclick="deleteParking('${row.p_id}')">Delete</button>
                            </td>
                        `;

                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchData() when the page loads to populate the table
        fetchData();

        function fetchDataSpot() {
            fetch('getDataSpot.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#parkingSpotTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.ps_name}</td>
                            <td>${row.p_id}</td>
                            <td>${row.ps_status}</td>
                            <td><div id="qrcode-${row.ps_id}"></div></td>
                            <td>
                                <button class="btn Edit-button" onclick="editParkingSpot('${row.ps_id}')">Edit</button>
                                <button class="btn Delete-button" onclick="deleteParkingSpot('${row.ps_id}')">Delete</button>
                            </td>
                        `;

                        tableBody.appendChild(newRow);

                        // Generate QR code
                        new QRCode(document.getElementById(`qrcode-${row.ps_id}`), {
                            text: `Parking Spot: ${row.ps_name}, Area: ${row.p_id}`,
                            width: 100,
                            height: 100
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchDataSpot() when the page loads to populate the table
        fetchDataSpot();

        function editParking(p_id) {
            // Redirect to the edit page with the specified id
            window.location.href = `editParking.php?p_id=${p_id}`;
        }

        function deleteParking(p_id) {
            // Perform delete operation or show confirmation dialog
            if (confirm("Are you sure you want to delete this parking area?")) {
                // Redirect to deleteParking.php with the id parameter
                window.location.href = `deleteParking.php?p_id=${p_id}`;
            }
        }

        function addParking() {
            // Redirect to the add parking page
            window.location.href = 'addParking.php';
        }

        function addParkingSpot() {
            // Redirect to the add parking page
            window.location.href = 'addParkingSpot.php';
        }

        function editParkingSpot(ps_id) {
            window.location.href = `editParkingSpot.php?ps_id=${ps_id}`;
        }

        function deleteParkingSpot(ps_id) {
            if (confirm("Are you sure you want to delete this parking spot?")) {
                window.location.href = `deleteParkingSpot.php?ps_id=${ps_id}`;
            }   
        }

        // Function to search and filter parking spots
        function searchParkingSpot() {
            const input = document.getElementById('searchParkingSpot').value.toLowerCase();
            const table = document.getElementById('parkingSpotTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                const spotCell = rows[i].getElementsByTagName('td')[0];
                const areaCell = rows[i].getElementsByTagName('td')[1];
                if (spotCell || areaCell) {
                    const spotText = spotCell.textContent || spotCell.innerText;
                    const areaText = areaCell.textContent || areaCell.innerText;
                    rows[i].style.display = (spotText.toLowerCase().indexOf(input) > -1 || areaText.toLowerCase().indexOf(input) > -1) ? '' : 'none';
                }
            }
        }
    </script>

</body>
</html>
