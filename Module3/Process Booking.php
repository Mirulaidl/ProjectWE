<?php
    if (isset($_POST['btnCBook'])){
        $uid = $_SESSION['User'];
        $queryvehicle = mysqli_query($conn,"SELECT * from vehicle WHERE u_id = '" . $uid . "'");
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)){
            $_SESSION['Vehicle'] = $row['v_id'];
        }

        $vid = $_SESSION['Vehicle'];
        $bid = $uid + $vid;
        $status = "Pending";
        $querybooking = mysqli_query($conn, "INSERT INTO Booking (b_id, v_id, b_status) VALUES ('$bid, $vid, $status')");

        if($query){
            echo 'Successfully';
        }else{
            echo 'Failed';
        }
    }
    ?>
