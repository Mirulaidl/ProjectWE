<!DOCTYPE html>
<html>
<head>
    <title>Summon Receipt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style4.css">
    <!-- Bootstrap -->
    <?php
        session_start();
        include '../includes/connect.php';
        include '../includes/bootstrap.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
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
            <div class="col leftcol">
            </div>

            <div class="col midcol">
                <div class="form outer text-center" style="margin-top:30vh;">
                    
                    <div class="row">
                        <div class="col" > 
                        <!--<div class="column left">-->
                            <h1>Your Summon Receipt</h1>
                         </div>
                         <!--</div>-->

                        <!--<div class="col" >-->
                             <!--<div class="column right">-->
                            <!--<div class="qr-code">-->
                                <!--<div class="buttons">-->
                                    <!--<a href="download_receipt.php?s_id=<?php echo htmlspecialchars($s_id); ?>" class="button">Download</a>-->
                                <!--</div>-->
                            <!--</div>-->
                             <!--</div>-->
                        <!--</div>-->
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col"> 
                            <h4>Overview: </h4>
                        </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col"> 
                                <div class="receipt">
                                    <p class="p1">Plate No: <?php echo $vehicle_plate_no; ?></p>
                                    <p class="p1">Violation: <?php echo $violation_type; ?></p>
                                    <p class="p1">Dated: <?php echo $violation_date; ?></p>
                                    <p class="p1">Notes: <?php echo $violation_notes; ?></p>
                                </div>
                        </div>

                        <div class="col">
                            <div class="qr-code" id="qrcode"></div>
                        </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col"> 
                            <div class="btn btn-primary" style="text-align: right;" >
                                <a type="submit"class="btn btn-primary"  href="ukDashboard.php">Done</a>
                            </div>
                        </div>

                        <div class="col">
                            <div class="btn btn-primary" style="text-align: left;">
                                <a type="submit" class="btn btn-primary" href="details.php?s_id=<?php echo $s_id; ?>">Details</a>
                            </div>
                        </div>

                        <!--<div class="col">-->
                             <!--<div class="btn btn-primary">-->
                                 <!--<form action="deleteReceipt.php" method="POST" style="text-align: left;">-->
                                     <!--<input type="hidden" name="s_id" value="<?php echo $s_id; ?>">-->
                                     <!--<button type="submit" class="btn btn-primary">Delete</button>-->
                                 <!--</form>-->
                             <!--</div>-->
                         <!--</div>-->
                    </div>

                    
                </div>
            </div>
                        <div class="col rightcol">

                        </div>
                        
        </div>
        <script>
            // Generate QR code with link to details.php
            var s_id = "<?php echo $s_id; ?>";
            var url = "details.php?s_id=" + s_id;
            new QRCode(document.getElementById("qrcode"), {
                text: url,
                width: 128,
                height: 128
            });
        </script>


</body>
</html>

