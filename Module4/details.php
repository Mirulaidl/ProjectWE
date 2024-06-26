<!DOCTYPE html>
<html>
<head>
    <title>Summon Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style4.css">
    <!-- Bootstrap -->
    <?php
        session_start();
        include '../includes/connect.php';
        include '../includes/bootstrap.php';
    ?>
</head>

<?php
    include '../includes/headerLoggedIn.php';

    // Fetch summon details based on s_id from URL
    $s_id = isset($_GET['s_id']) ? htmlspecialchars($_GET['s_id']) : '';

    // Initialize variables
    $vehicle_plate_no = '';
    $violation_type = '';
    $violation_date = '';
    $violation_notes = '';

    if ($s_id && isset($conn)) {
        $stmt = $conn->prepare("SELECT v_id, s_violation, s_date, s_note FROM Summon WHERE s_id = ?");
        $stmt->bind_param("s", $s_id);
        $stmt->execute();
        $stmt->bind_result($vehicle_plate_no, $violation_type, $violation_date, $violation_notes);
        $stmt->fetch();
        $stmt->close();

        // Format the date to only show the date without time
        $violation_date = (new DateTime($violation_date))->format('Y-m-d');
    } else {
        echo "No summon details found.";
        exit;
    }
?>

<body>
    <div class="row">
        <div class="col leftcol"></div>

        <div class="col midcol">
            <div class="form outer text-center" style="margin-top:30vh;">
                <div class="row">
                    <div class="col">
                        <h1>Your Summon Details</h1>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <div class="receipt" id="receiptContent">
                            <p class="p1">Plate No: <?php echo $vehicle_plate_no; ?></p>
                            <p class="p1">Violation: <?php echo $violation_type; ?></p>
                            <p class="p1">Dated: <?php echo $violation_date; ?></p>
                            <p class="p1">Notes: <?php echo $violation_notes; ?></p>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
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
                                    <td>10 points</td>
                                    <td>Parking Violation</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>15 points</td>
                                    <td>Traffic Violation</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>20 points</td>
                                    <td>Accident</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary" href="ukDashboard.php">Done</a>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" onclick="printDetails()">Print</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col rightcol"></div>
    </div>

    <script>
        function printDetails() {
            var printContents = document.getElementById('receiptContent').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>
