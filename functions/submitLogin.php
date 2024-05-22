<?php
session_start();

require_once('../includes/connect.php');

if (isset($_POST['submit'])) {

    $Admin = "Administrator";

    if ($_POST['userType'] == $Admin){

        $query = "SELECT * FROM administrator WHERE a_email='" . $_POST['email'] . "' AND a_password='" . $_POST['password'];
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['Admin'] = $row['a_id'];
            $_SESSION['AdminName'] = $row['a_name'];

            header("location:../Module2/adminDashboard.php");
        }else{
            echo "<script>alert('Invalid Login'); window.location='../login.php';</script>";
        }

        //Belum siap navigate ke admin dashboard
    }else if ($_POST['userType'] == "Student"){
        $Student = "Student";
        $query = "SELECT * FROM user_ WHERE u_email='" . $_POST['email'] . "' AND u_password='" . $_POST['password'] . "' AND u_type = '$Student'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['User'] = $row['u_id'];
            $_SESSION['UserType'] = $row['u_type'];
            $_SESSION['UserName'] = $row['u_name'];

            header("location:../Module1/userDashboard.php");
        }else{
            echo "<script>alert('Invalid Login'); window.location='../login.php';</script>";
        }
    }else if ($_POST['userType'] == "Staff"){
        $Staff = "Staff";
        $query = "SELECT * FROM user_ WHERE u_email='" . $_POST['email'] . "' AND u_password='" . $_POST['password'] . "' AND UserType = '$Staff'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['User'] = $row['u_id'];
            $_SESSION['UserType'] = $row['u_type'];
            $_SESSION['UserName'] = $row['u_name'];

            header("location:../Module1/userDashboard.php");
        }else{
            echo "<script>alert('Invalid Login'); window.location='../login.php';</script>";
        }
    }else{
        $query = "SELECT * FROM unit_keselamatan WHERE uk_email='" . $_POST['email'] . "' AND uk_password='" . $_POST['password'];
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['UnitKeselamatan'] = $row['uk_id'];
            $_SESSION['UKName'] = $row['uk_name'];

            header("location:../Module4/ukDashboard.php");
        }else{
            echo "<script>alert('Invalid Login'); window.location='../login.php';</script>";
        }
    }
} else{
    echo 'Submit not working';
}