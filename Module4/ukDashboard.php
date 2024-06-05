<!DOCTYPE html>
<html>
<head>
    <title>UK Dashboard</title>
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

                    <div class="col">
                        <div class="row"></div>
                        <div class="row"></div>
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
                    <img src="" alt="Chart" style="height: 25vh;">
                    <img src="" alt="Chart" style="height: 25vh;">
                </div>

                <div class="row">
                    
                </div>
            </div>

            <div class="col outer">

            <div > 
                <h3>Summon Issued</h3>
                    <table id="summonTable">
                        <thead>
                            <tr>
                                <th>Vehicle Plate No</th>
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
                        window.location.href = `deleteSummon.php?s_id=${s_id}`; // Use 's_id' in the URL parameter
                        
                    }
                }
            </script>


                <div class="row">
                    <div class="col" >
                        <p>FAJ5812</p>
                    </div>

                    <div class="col">
                        <p>22.4.2024</p>
                    </div> 
                                    
                    <div class="col">
                        <p>Icon Document</p>
                    </div> 
                </div>
            </div>

            

        </div>
    </div>
</body>
</html>
