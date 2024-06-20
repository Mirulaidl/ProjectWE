<!DOCTYPE html>
<html>
<head>
<title>User Approval</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap -->
    <?php 
        session_start();
        include '../includes/connect.php';
        include '../includes/bootstrap.php';
    ?>
</head>
<?php include '../includes/headerLoggedIn.php'; ?>
<body>

<nav class="mx-5 bg-light px-2 pt-2 rounded-top" style="margin-top:15vh;">
<button class="btn btn-primary mx-2 mb-2 mt-2" onclick="history.go(-1);">Back </button>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pending</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Approved</button>
  </div>
</nav>
<div class="tab-content mx-5 bg-light px-2 pt-2 rounded" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <h1>Pending User Registration</h1>
  <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" id="searchUserPending" class="form-control form-control-sm" placeholder="Search for user">
                <button class="btn btn-primary btn-sm" onclick="searchUserPending()">Search</button>
            </div>
    <table id="userTable" class="table table-striped caption-top">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <h1>Pending User Registration</h1>
  <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" id="searchUserApproved" class="form-control form-control-sm" placeholder="Search for user">
                <button class="btn btn-primary btn-sm" onclick="searchUserApproved()">Search</button>
            </div>
    <table id="auserTable" class="table table-striped caption-top">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
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
        // Function to fetch data from the database for parking area
        function fetchData() {
            fetch('getDataU.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#userTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.u_id}</td>
                            <td>${row.u_name}</td>
                            <td>${row.u_email}</td>
                            <td>${row.u_status}</td>
                            <td>
                                <button class="btn btn-success" onclick="Approve('${row.u_id}')">Approve</button>
                                <button class="btn btn-danger" onclick="Reject('${row.u_id}')">Delete</button>
                            </td>  
                            
                        `;

                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchData() when the page loads to populate the table
        fetchData();

        function Approve(u_id) {
                    // Redirect to the edit page with the specified id
                    window.location.href = `ApproveU.php?u_id=${u_id}`;
                }

        function Reject(u_id) {
                    // Redirect to the edit page with the specified id
                    window.location.href = `RejectU.php?u_id=${u_id}`;
                }
        function fetchDataApproved() {
            fetch('getDataUA.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#auserTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.u_id}</td>
                            <td>${row.u_name}</td>
                            <td>${row.u_email}</td>
                            <td>${row.u_status}</td>
                            
                        `;

                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchData() when the page loads to populate the table
        fetchDataApproved();

        function searchUserPending() {
            const input = document.getElementById('searchUserPending').value.toLowerCase();
            const table = document.getElementById('userTable');
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

        function searchUserApproved() {
            const input = document.getElementById('searchUserApproved').value.toLowerCase();
            const table = document.getElementById('auserTable');
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