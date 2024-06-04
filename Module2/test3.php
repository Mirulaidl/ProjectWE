<!DOCTYPE html>
<html>
<head>
    <title>Parking Areas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap -->
    <?php include '../includes/bootstrap.php'; ?>
    <!-- Include CSS -->
    <link rel="stylesheet" href="parking.css">
</head>
<body>
    <?php include '../includes/headerLoggedIn.php'; ?> 
    <center>
    <div class="containerP plain-container"> 
    <h1>PARKING AREAS</h1>
        <table id="parkingTable">
            <thead>
                <tr>
                    <th>Parking</th>
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
            <button class="addUpdate-button" onclick="addParking()">Add</button>
        </div>
    </div>
    </center>

    <script>
        // Function to fetch data from the database
        function fetchData() {
            fetch('getData.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#parkingTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(row => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${row.p_id}</td>
                            <td>${row.p_area}</td>
                            <td>${row.p_status}</td>
                            <td>
                                <button class="Edit-button" onclick="editParking('${row.p_id}')">Edit</button>
                                <button class="Delete-button" onclick="deleteParking('${row.p_id}')">Delete</button>
                            </td>
                        `;

                        tableBody.appendChild(newRow);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call fetchData() when the page loads to populate the table
        fetchData();

        function editParking(p_id) {
            // Redirect to the edit page with the specified id
            window.location.href = `editParking.php?id=${p_id}`;
        }

        function deleteParking(p_id) {
            // Perform delete operation or show confirmation dialog
            if (confirm("Are you sure you want to delete this parking area?")) {
                // Redirect to deleteParking.php with the id parameter
                window.location.href = `deleteParking.php?p_id=${p_id}`; // Use 'p_id' in the URL parameter
            }
        }

        function addParking() {
            // Redirect to the add parking page
            window.location.href = 'addParking.php';
        }
    </script>

</body>
</html>
