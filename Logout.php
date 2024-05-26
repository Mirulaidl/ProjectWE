<?php
    session_start();
    if(basename($_SERVER['PHP_SELF']) == "adminDashboard.php"){
        unset($_SESSION["Admin"]);
        unset($_SESSION["AdminName"]);
    }else if(basename($_SERVER['PHP_SELF']) == "userDashboard.php"){
        unset($_SESSION["User"]);
        unset($_SESSION["UserType"]);
        unset($_SESSION["UserName"]);
    }else if(basename($_SERVER['PHP_SELF']) == "ukDashboard.php"){
        unset($_SESSION["UnitKeselamatan"]);
        unset($_SESSION["UKName"]);
    }  
    session_destroy();
    header("Location:login.php");
?>