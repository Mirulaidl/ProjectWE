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

            <button type="button" class="col buttonsummon">
                <h1>Create Summon</h1>
            </button>
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
