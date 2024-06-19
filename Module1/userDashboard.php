<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Bootstrap -->
<?php 
    session_start();
    include '../includes/connect.php';
    include '../includes/bootstrap.php';

    $sql = "
SELECT ps.p_id, ps_name AS parking_space_name, ps.ps_status, COUNT(ps.ps_id) AS count
FROM ParkingSpot ps
JOIN ParkingSpace p ON ps.p_id = p.p_id
GROUP BY ps.p_id, ps.ps_status
ORDER BY ps.p_id, ps.ps_status";

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $p_id = $row['p_id'];
        $status = $row['ps_status'];
        $count = $row['count'];
        $name = $row['parking_space_name'];

        if (!isset($data[$p_id])) {
            $data[$p_id] = [
                'ps_name' => $name,
                'Available' => 0,
                'Occupied' => 0,
            ];
        }

        if ($status == 'Available') {
            $data[$p_id]['Available'] = $count;
        } else {
            $data[$p_id]['Occupied'] = $count;
        }
    }
} else {
    echo "0 results";
}
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
                        <p>Welcome Back</p>
                    </div>
                    <div class="col">
                        <p>Your Vehicle</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1>
                            <?php 
                                $username = $_SESSION['UserName'];
                                $uid = $_SESSION['User'];
                                echo '<input id="userID" value="' . $uid . '" hidden>';
                                // $username = getname($userID);
                                echo "$username";
                            ?>
                        </h1>
                    </div>
                    <div class="col">
                        <?php
                        $query = "SELECT * FROM vehicle WHERE u_id = '" . $_SESSION['User'] . "'";
                        $result = mysqli_query($conn, $query);
                            if($row = mysqli_fetch_assoc($result)){
                                $plate = $row['v_plate_num'];
                                $status = $row['v_status'];
                                $_SESSION['VehiclePlate'] = $row['v_plate_num'];
                                if($row['v_status'] != NULL){
                                    $_SESSION['VehicleStatus'] = $row['v_status'];
                                    $status = $_SESSION['VehicleStatus'];
                                }
                                
                                echo '
                                <div class="row">
                                    ' . $plate . '
                                </div>
                                <div class="row">
                                    ' . $status . '
                                </div>
                                ';
                            }else{
                                echo '<a href="registerVehicle.php" class="buttonClass" style="
                                text-decoration: none;
                                font-size:30px;
                                width:30vw;
                                height:15vh;
                                border-width:1px;
                                color:#fff;
                                font-weight:bold;
                                padding: 3px 30px 5px 30px;
                                border-radius: 5px;
                                background:#44c767;"
                                >Register</a>';
                            }
                        ?>
                        
                    </div>
                </div>
                
            </div>
            <?php
            $status = "";
                if($status == "Pending"){
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\' disabled">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }else if ($status == "Approved"){
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\'">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }else{
                    echo '<button class="col buttonbook" onclick="location.href=\'../Module3/Booking.php\'">
                            <h1>Book Parking</h1>
                            
                        </button>';
                }
            ?>
            
        </div>
        <div class="row">
            <div class="col outer">
                <div class="row">
                    <p>Fakulti Komputeran Parking Area</p>
                    <img src="../Asset/Img/Parking.svg" alt="Parking" style="height: 55vh;">
                </div>

            </div>
            <div id="graph" class="col outer">
            <table>
            <tr>
                <th>Parking Space</th>
            </tr>
            <?php
            $colors = [
                ['#FFB6C1', '#FFDAB9'],
                ['#a6a6ff', '#FFFACD'],
                ['#D3FFCE', '#DDA0DD'],
                ['#B0E0E6', '#FF69B4'],
                ['#87CEFA', '#FFDEAD']
            ];
            $counter = 0;
            foreach ($data as $p_id => $details):
                if ($counter % 2 == 0 && $counter != 0) {
                    echo '</tr><tr>';
                }
                $colorIndex = $counter % count($colors);
            ?>
                <td>
                    <h3><?php echo $p_id; ?></h3>
                    <canvas id="pieChart<?php echo $p_id; ?>" width="400" height="400"></canvas>
                </td>
                <script>
                    var ctx = document.getElementById('pieChart<?php echo $p_id; ?>').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Available', 'Occupied'],
                            datasets: [{
                                data: [<?php echo $details['Available']; ?>, <?php echo $details['Occupied']; ?>],
                                backgroundColor: ['<?php echo $colors[$colorIndex][0]; ?>', '<?php echo $colors[$colorIndex][1]; ?>']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            }
                        }
                    });
                </script>
            <?php
                $counter++;
            endforeach;
            ?>
        </table>
            </div>
        </div>
    </div>
</body>

<script>
    // $(document).ready(function(){
    //     var UserID = document.getElementById('userID').value;

    //     $.post

    // })
</script>

</html>