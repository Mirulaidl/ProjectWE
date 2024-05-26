<?php
session_start();

require_once('../includes/connect.php');

if (isset($_POST['submit'])) {

    $Admin = "Administrator";
    $decryptedPass = md5($_POST['password']);
    if ($_POST['userType'] == $Admin){

        $query = "SELECT * FROM Administrator WHERE a_email='" . $_POST['email'] . "' AND a_password='" . $decryptedPass . "'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['Admin'] = $row['a_id'];
            $_SESSION['AdminName'] = $row['a_name'];
            echo '
                <script type="text/javascript">
                      setTimeout(function(){
                        window.location.href="../Module2/adminDashboard.php";
                    },2000);

                    </script>
                ';

        }else{
            echo "<script>alert('Invalid Login'); window.location='../login.php';</script>";
        }

        //Belum siap navigate ke admin dashboard
    }else if ($_POST['userType'] == "Student"){
        $Student = "Student";
        $Status = "Pending"; //tukar nanti bila admin boleh approve new user
        $query = "SELECT * FROM users WHERE u_email='" . $_POST['email'] . "' AND u_password='" . $decryptedPass . "' AND u_type = '$Student'" . " AND u_status = '$Status'";
        $result = mysqli_query($conn, $query);


        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['User'] = $row['u_id'];
            $_SESSION['UserType'] = $row['u_type'];
            $_SESSION['UserName'] = $row['u_name'];
            echo '
                <script type="text/javascript">
                      setTimeout(function(){
                        window.location.href="../Module1/userDashboard.php";
                    },2000);

                    </script>
                ';
        }else{
            echo "<script>alert('Invalid Login'); window.location='../Login.php';</script>";
        }
    }else{
        $query = "SELECT * FROM UnitKeselamatan WHERE uk_email='" . $_POST['email'] . "' AND uk_password='" . $decryptedPass . "'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['UnitKeselamatan'] = $row['uk_id'];
            $_SESSION['UKName'] = $row['uk_name'];

            header("location:../Module4/ukDashboard.php");
        }else{
            echo "<script>alert('Invalid Email or Password'); window.location='../login.php';</script>";
        }
    }
} else{
    echo 'Submit not working';
}