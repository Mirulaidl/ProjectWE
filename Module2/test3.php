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
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Area</th>
                    <th>Parking</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>B1</td>
                    <td>STU66</td>
                    <td>Available</td>
                    <td><button class="Edit-button">Edit</button> <button class="Delete-button">Delete</button></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <div class="containerButton">
        <button class="addUpdate-button">Add</button>
        <button class="addUpdate-button">Update</button>
    </div>
    </div>
</center>

</body>
</html>
