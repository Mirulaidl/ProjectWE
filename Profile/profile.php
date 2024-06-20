<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
 <!-- Bootstrap -->
 <?php
    include '../includes/bootstrap.php'; 
    include '../includes/connect.php';
 ?>
</head>
<!-- Connect Css -->
 <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->
 <?php
include '../includes/headerLoggedIn.php';
?>

    <?php
    session_start();
    $uid = $_SESSION['User'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE u_id = '$uid'");

    while ($row = mysqli_fetch_array($q)){
        // $pass =  $row['u_password'];
        // if (md5($str) == $pass)
        // {
        //     echo "<br>Hello world!";
        //     exit;
        // }

        
        ?>
<body>
<div class="background-image">

<div class="row">

        <div class="col"></div>
        <div class="colmid col rounded" style="margin-top: 20vh;">
        <button class="btn btn-primary mx-2 mb-2 mt-2" onclick="history.go(-1);">Back </button>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Vehicle</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Summon</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="book-tab" data-bs-toggle="tab" data-bs-target="#book" type="button" role="tab" aria-controls="profile" aria-selected="false">Booking</button>
                </li>
                
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="name" class="form-label">Name</label>
                              <h4 id="name"><?php echo $row['u_name'];?></h4>
                              <button type="button" class="btn btn_primary" data-bs-toggle="modal" data-bs-target="#modalName">
                                change name
                              </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="pass" class="form-label">Password</label>
                              <br>
                              <button type="button" class="btn btn_primary" data-bs-toggle="modal" data-bs-target="#modalPass">
                                change password
                              </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">Email</label>
                              <h4 id="email"><?php echo $row['u_email'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="type" class="form-label">User Type</label>
                              <h4 id="email"><?php echo $row['u_type'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <button type="submit" id="btnDeactivate" name="btnDeactivate" class="text-danger">Delete Account</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="book-tab">
                    <table id="bookTable">
                            <thead>
                                <tr>
                                    <th>Parking</th>
                                    <th>Vehicle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be dynamically inserted here -->
                            </tbody>
                        </table>
                        <script>
                // Function to fetch data from the database
                function fetchDataBooking() {
                    fetch('getDataBooking.php')
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.querySelector('#bookTable tbody');
                            tableBody.innerHTML = ''; // Clear existing rows

                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td>${row.v_id}</td>
                                    <td>${row.ps_id}</td>
                                     <td>
                                         <button id="vBooking" type="button" class="view-button btn btn-primary" onclick="viewBooking('${row.b_id}','${row.v_id}','${row.ps_id}')" data-bs-toggle="modal" data-bs-target="#bookingModal">View</button>
                                     </td>
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchDataBooking();

                function viewBooking(b_id, v_id, ps_id) {
                    // Redirect to the edit page with the specified id
                    document.getElementById('modalBId').value = b_id;
                    document.getElementById('modalVId').value = v_id;
                    document.getElementById('modalPSId').value = ps_id;

                }

                // document.addEventListener('DOMContentLoaded', fetchData);

            </script>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table id="summonTable">
                        <thead>
                            <tr>
                                <th>Vehicle Plate</th>
                                <th>Date Issued</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be dynamically inserted here -->
                        </tbody>
                    </table>
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
                                         <button id="vSummon" type="button" class="view-button btn btn-primary" onclick="viewSummon('${row.v_id}', '${row.s_date}', '${row.s_violation}', '${row.s_note}')" data-bs-toggle="modal" data-bs-target="#summonModal">View</button>
                                     </td>
                                `;

                                tableBody.appendChild(newRow);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Call fetchData() when the page loads to populate the table
                fetchData();

                function viewSummon(v_id, s_date, s_violation, s_note) {
                    // Redirect to the edit page with the specified id
                    document.getElementById('modalVId').value = v_id;
                    document.getElementById('modalSDate').value = s_date;
                    document.getElementById('modalViolation').value = s_violation;
                    document.getElementById('modalNote').value = s_note;

                }

                // document.addEventListener('DOMContentLoaded', fetchData);

            </script>
                </div>

                <!-- Vehicle -->
                <?php 
                    $uid = $_SESSION['User'];

                    $l = mysqli_query($conn, "SELECT * FROM vehicle WHERE u_id = '$uid'");
                
                    while ($row = mysqli_fetch_array($l)){
                ?>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="plate" class="form-label">Plate</label>
                              <input class="form-control" type="text" id="plate" name="plate" value="<?php echo $row['v_plate_num']; ?>" Disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">Type</label>
                              <input class="form-control" type="text" id="type" name="type" value="<?php echo $row['v_type']; ?>" Disabled/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="brand" class="form-label">Brand</label>
                              <input class="form-control" type="text" id="brand" name="brand" value="<?php echo $row['v_brand']; ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="color" class="form-label">Color</label>
                              <input class="form-control" type="text" id="color" name="color" value="<?php echo $row['v_color']; ?>"/>
                            </div>
                        </div>
                        <div class="row">
                        <label class="form-label">Sticker</label>
                            <div class="mb-3 col-md-6 qr-code" id="qrcode">
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <button id="btnSave" name="btnSave" type="submit" class="btn btn-primary me-2">Save changes</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        // Generate QR code with link to details.php
                        var v_id = "<?php $vid = $row['v_id']; echo $vid; ?>";
                        var url = "indah.ump.edu.my/CD22098/FKPark/Module1/sticker.php?v_id=" + v_id;
                        new QRCode(document.getElementById("qrcode"), {
                            text: url,
                            width: 128,
                            height: 128
                        });
                    </script>
                </div>
                <?php 

                    if (isset($_POST['btnSave'])) {
                        $uid = $_SESSION['User'];
                        $brand = $_POST['brand'];
                        $color = $_POST['color'];

                        $querysave = mysqli_query($conn, "UPDATE vehicle SET v_brand = '$brand', v_color = '$color' WHERE u_id = '$uid'");
                        if ($querysave) {
                            echo '
                                    <script type="text/javascript">
                                        alert("Vehicle have been updated!");
                                          setTimeout(function(){
                                            window.location.href="profile.php";
                                        },1000);
                    
                                        </script>
                                    ';
                        } else {
                            echo '
                                    <script type="text/javascript">
                                        alert("Something went wrong!");
                                          setTimeout(function(){
                                            window.location.href="profile.php";
                                        },1000);
                    
                                        </script>
                                    ';
                        }

                    }

                }?>
                
                <!-- End Vehicle -->

            </div>
        </div>
        <div class="col"></div>
    </div>
    <!-- MODAL NAME -->

    <div class="modal fade" id="modalName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changeName" method="post">
                <div class="modal-body">
                    <label for="modalname">Type your new name</label>
                    <br>
                        <input id="modalname" type="text" name="name" placeholder="Name..."/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btnCName" name="btnCName" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <!-- MODAL PASSWORD-->
    <div class="modal fade" id="modalPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="changePass" method="post">
                <div class="modal-body">
                    <label for="modalpass">Type your new password</label>
                    <br>
                    <form id="changePass" method="post">
                        <input id="modalpass" type="text" name="password" placeholder="Password..."/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btnCPass" name="btnCPass" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> 
            </div>
        </div>
    </div>

    <!-- MODAL Summon-->
    <div class="modal fade" id="summonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Summon Details</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="modalVId">ID</label>
                            <input type="text" class="form-control" id="modalVId" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalSDate">Date</label>
                            <input type="text" class="form-control" id="modalSDate" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalViolation">Violation</label>
                            <input type="text" class="form-control" id="modalViolation" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalNote">Note</label>
                            <textarea class="form-control" id="modalNote" rows="3" readonly></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL booking-->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group">
                            <label for="modalBId">Date</label>
                            <input type="text" class="form-control" id="modalBId" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalVId">ID</label>
                            <input type="text" class="form-control" id="modalVId" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modalPSId">Violation</label>
                            <input type="text" class="form-control" id="modalPSId" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    

    <!-- CRUD -->
    <?php 
    
    if (isset($_POST['btnCName'])) {

        $uid = $_SESSION['User'];
        $name = $_POST['name'];

        $queryname = mysqli_query($conn, "UPDATE users SET u_name = '$name' WHERE u_id = '$uid'");

        if ($queryname) {
            echo '
                    <script type="text/javascript">
                        alert("Name have been updated!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        } else {
            echo '
                    <script type="text/javascript">
                        alert("Something went wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    if (isset($_POST['btnCPass'])){
        $uid = $_SESSION['User'];
        $pass = $_POST['password'];

        $querypass = mysqli_query($conn, "UPDATE users SET u_password = '$pass' WHERE u_id = '$uid'");

        if ($queryname) {
            echo '
                    <script type="text/javascript">
                        alert("Password have been updated!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        } else {
            echo '
                    <script type="text/javascript">
                        alert("Something went wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    if (isset($_POST['btnDeactivate'])){
        $uid = $_SESSION['User'];
        // $queryv = "DELETE from vehicle WHERE u_id = '$uid'";
        $queryd = "DELETE from users WHERE u_id = '$uid'";
        $result = mysqli_query($conn, $queryd);

        if ($result) {
            echo '
                    <script type="text/javascript">
                        alert("Your account have been deleted!");
                          setTimeout(function(){
                            window.location.href="../Logout.php";
                        },1000);
    
                        </script>
                    ';
        }else {
            echo '
                    <script type="text/javascript">
                        alert("There is something wrong!");
                          setTimeout(function(){
                            window.location.href="profile.php";
                        },1000);
    
                        </script>
                    ';
        }
    }

    ?>


</body>
</html>
<?php
    } ?>
