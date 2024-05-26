<!DOCTYPE html>
<html>
<head>
    <title>Summon Receipt</title>
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
 <!-- Connect Css -->
 <!-- <link rel="stylesheet" type="text/css" href="assets/css/style2.scss"> -->

<?php
    include '../includes/headerLoggedIn.php';
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

                        <div class="col" >
                             <!--<div class="column right">-->
                            <div class="qr-code">
                                <div class="buttons">
                                    <a href="download_receipt.php?s_id=<?php echo htmlspecialchars($s_id); ?>" class="button">Download</a>
                                </div>
                            </div>
                             <!--</div>-->
                        </div>
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
                                    <p class="p1">Plate No: </p>
                                    <p class="p1">Violation: </p>
                                    <p class="p1">Date: </p>
                                    <p class="p1">Issued by: </p>
                                </div>
                        </div>

                        <div class="col">
                            <div class="qr-code">
                                <img src="generate_qr.php?s_id=<?php echo htmlspecialchars($s_id); ?>" alt="QR Code">
                            </div>
                        </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col"> 
                            <div class="btn btn-primary" style="text-align: right;" >
                                <button type="submit"class="btn btn-primary">Done</button>
                            </div>
                        </div>

                        <div class="col">
                            <div class="btn btn-primary">
                                <form action="summon.php" method="POST" style="text-align: left;">
                                    <input type="hidden" name="s_id" value="<?php echo htmlspecialchars($s_id); ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
                        <div class="col rightcol">

                        </div>
                        
        </div>


</body>
</html>

