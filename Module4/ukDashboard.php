<?php

    session_start();
    include '../includes/connect.php'; 
    include '../includes/bootstrap.php';

    // Fetch data for the chart
    $violationData = [];
    if (isset($conn)) {
        $query = "SELECT s_violation, COUNT(*) as count FROM Summon GROUP BY s_violation";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $violationData[] = $row;
        }
    }

    // Encode data as JSON
    $violationDataJSON = json_encode($violationData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>UK Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style4.css">

    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

    <?php
        include '../includes/headerLoggedIn.php';
    ?>

<body>

    <div class="container" style="margin-top:15vh;">
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <div class="col">
                        <p>Welcome Back Unit Keselamatan Staff,</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <h1>
                            <?php 
                                $username = $_SESSION['UKName'];
                                // $username = getname($userID);
                                echo "$username";
                            ?>
                        </h1>
                    </div>
                </div>
            </div>

           
            <a type="button" class="col buttonsummon" href="trafficSummon.php">
                <h1>Create Summon</h1>
            </a>

        </div>

        <div class="row">
            <div class="col outer">
                <div class="row">
                    <p>VIOLATION</p>
                    <canvas id="violationTypeChart" width="400" height="200"></canvas>
                

                    <p>DEMERIT POINT</p>
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Total Point</th>
                                <th scope="col">Enforcement Type</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Less than 20 points</td>
                                <td>Warning given</td>
                            </tr>

                            <tr>
                                <th scope="row">2</th>
                                <td>Less than 50 points</td>
                                <td>Revoke of in campus vehicle permission for 1 semester</td>
                            </tr>

                            <tr>
                                <th scope="row">3</th>
                                <td>Less than 80 points</td>
                                <td>Revoke of in campus vehicle permission for 2 semesters</td>
                            </tr>
                            
                            <tr>
                                <th scope="row">4</th>
                                <td>More than 80 points</td>
                                <td>Revoke of in campus vehicle permission for the entire study duration</td>
                            </tr>
                        </tbody>
                    
                    </table>
                </div>

            </div>

            <div class="col outer">

            <div > 
                <p>Summon Issued</p>
                    <table id="summonTable" class="table table-striped caption-top">
                        <thead>
                            <tr>
                                <th>Plate No</th>
                                <th>Date Issued</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Data will be dynamically inserted here -->
                        </tbody>
                    </table>

            </div>

            <script>
               
                // Function to fetch data from the database
                function fetchData() {
                    fetch('getData.php')
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.querySelector('#summonTable tbody');
                            tableBody.innerHTML = ''; // Clear existing rows

                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td>${row.v_id}</td>
                                    <td>${row.s_date}</td>
                                    <td>
                                        <button class="Edit-button" onclick="editSummon('${row.s_id}')">Edit</button>
                                        <button class="Delete-button" onclick="deleteSummon('${row.s_id}')">Delete</button>
                                    </td>
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchData();

                function editSummon(s_id) {
                    // Redirect to the edit page with the specified id
                    window.location.href = `editSummon.php?s_id=${s_id}`;
                }

                function deleteSummon(s_id) {
                    // Perform delete operation or show confirmation dialog
                    if (confirm("Are you sure you want to delete this traffic summon?")) {
                        // Redirect to deleteSummon.php with the id parameter
                        window.location.href = `deleteSummon.php?s_id=${s_id}`; 
                        
                    }
                }

                // Function to render the chart using Chart.js
                function renderChart() {
                        const ctx = document.getElementById('violationTypeChart').getContext('2d');
                        const violationData = <?php echo $violationDataJSON; ?>;

                        const labels = violationData.map(data => data.s_violation);
                        const dataCounts = violationData.map(data => data.count);

                        const chart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Violations by Type',
                                    data: dataCounts,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Total Violations by Type'
                                    }
                                }
                            },
                        });
                    }

                    // Call renderChart() when the page loads
                    window.onload = renderChart;
            </script>


    
            </div>

            

        </div>
    </div>
</body>
</html>
