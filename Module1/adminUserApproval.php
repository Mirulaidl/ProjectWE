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
    <div class="container" style="margin-top:15vh;">
    <h1>User Registration</h1>
    <table id="userTable" class="table table-striped caption-top">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be dynamically inserted here -->
                </tbody>
    </table>
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
                            <td>${row.u_email}</td>
                            <td>${row.u_name}</td>
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