<style type="text/css">
        .topnav {
            margin-top: 0px;
            margin-right: 0px;
            margin-left: 0px;
            background-color: #33ab9f;
            overflow: hidden;
            height: 20px;
            padding: 8px;

        }
 
        .bottomnav {
            margin-right: 0px;
            margin-left: 0px;
            background-color: #fff;
            overflow: hidden;
            height: 80px;
            padding: 5px;

        }

        .img-nav{
            margin-left: 10vw;
        }
 
    </style>
<header class="fixed-top">
<div class="topnav">
        
        <!-- <a class="active" href="#">Home</a>
        <a href="#">Feature</a>
        <a href="#">Deals</a>
        <a href="#">Blog</a>
        <a href="#" class="float-right">Login</a> -->
    </div>
    <div class="bottomnav">
        <img class="img-nav" src="../Asset/Img/Logo.svg" alt="Home" style="height: 7vh;">
            <a href="" class="usericon" id="dropdownUserButton" data-bs-toggle="dropdown" aria-expanded="false" style="float: right;">
                <img src="../Asset/Img/user.svg" alt="User" style="float: right; margin-right: 15vw; margin-top: 1vh; height: 5vh;">
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <?php 
                // session_start();

                // $admin = $_SESSION['Admin'];
                // $user = $_SESSION['User'];
                // $uk = $_SESSION['UnitKeselamatan'];
                

                if (isset($_SESSION['Admin'])){
                    echo '<li><a class="dropdown-item" href="../Profile/adminprofile.php">Profile</a></li>';
                }else if (isset($_SESSION['UnitKeselamatan'])){
                    echo '<li><a class="dropdown-item" href="../Profile/ukprofile.php">Profile</a></li>';
                }else{
                    echo '<li><a class="dropdown-item" href="../Profile/profile.php">Profile</a></li>';
                }
                ?>
                
                <li><a class="dropdown-item" href="../Logout.php">Log Out</a></li>
            </ul>

    </div>
</header>