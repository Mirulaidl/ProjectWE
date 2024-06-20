<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Registeration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Include Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <?php include '../includes/connect.php'; ?>
    <!-- Include CSS -->
    
</head>
<?php include '../includes/headerLoggedIn.php'; ?> 
<body>
<ul class="nav nav-pills mx-5 bg-light px-2 pt-2 rounded-top" id="pills-tab" role="tablist" style="margin-top:15vh;">
<button class="btn btn-primary mx-2 mb-2 mt-2" onclick="history.go(-1);">Back </button>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pending</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link btn-secondary" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Approved</button>
  </li>
</ul>
<div class="tab-content mx-5 bg-light px-2 pt-2 rounded-bottom" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <h1>Pending Vehicle Registration</h1>
            <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" id="vehiclePending" class="form-control form-control-sm" placeholder="Search for vehicle">
                <button class="btn btn-primary btn-sm" onclick="vehiclePending()">Search</button>
            </div>
            <table id="vehicleTable" class="table caption-top">
                <thead class="table-success">
                    <tr>
                        <th>Plate</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <h1>Approved Vehicle</h1>
            <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" id="vehicleApproved" class="form-control form-control-sm" placeholder="Search for vehicle">
                <button class="btn btn-primary btn-sm" onclick="vehicleApproved()">Search</button>
            </div>
            <table id="avehicleTable" class="table caption-top">
                <thead class="table-success">
                    <tr>
                        <th>Plate</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
            </table>
  </div>
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
                                    <td>${row.v_brand}</td>
                                    <td>${row.v_status}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="Approve('${row.v_id}')">Approve</button>
                                        <button class="btn btn-danger" onclick="Reject('${row.v_id}')">Delete</button>
                                    </td>   
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchData();

                function Approve(v_id) {
                    // Redirect to the edit page with the specified id
                    window.location.href = `Approve.php?v_id=${v_id}`;
                }

                function Reject(v_id) {
                    // Redirect to the edit page with the specified id
                    window.location.href = `Reject.php?v_id=${v_id}`;
                }

                function fetchDataApproved() {
                    fetch('getDataVA.php')
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.querySelector('#avehicleTable tbody');
                            tableBody.innerHTML = ''; // Clear existing rows

                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td>${row.v_plate_num}</td>
                                    <td>${row.v_type}</td>
                                    <td>${row.v_brand}</td>
                                    <td>${row.v_status}</td>  
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchDataApproved();

                function vehiclePending() {
                    const input = document.getElementById('vehiclePending').value.toLowerCase();
                    const table = document.getElementById('avehicleTable');
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

                function vehicleApproved() {
                    const input = document.getElementById('vehicleApproved').value.toLowerCase();
                    const table = document.getElementById('vehicleTable');
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