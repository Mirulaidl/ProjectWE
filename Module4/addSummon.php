<?php
session_start();
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ukid = $_SESSION['UnitKeselamatan'];
    $vid = $_POST['v_id'];
    $sviolation = $_POST['s_violation'];
    $sdate = $_POST['s_date'];
    $snote = $_POST['s_note'];

    // Generating a unique s_id (you may need a more robust method)
    $random = rand(1000, 9999);
    $sid = $ukid . $vid . $random; // Example of generating s_id

    // SQL query using prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO Summon (s_id, v_id, s_violation, s_note, uk_id, s_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $sid, $vid, $sviolation, $snote, $ukid, $sdate);

    if ($stmt->execute()) {
        // Store necessary data in session variables
        $_SESSION['s_id'] = $sid;
        $_SESSION['v_id'] = $vid;
        $_SESSION['s_violation'] = $sviolation;
        $_SESSION['s_date'] = $sdate;
        $_SESSION['s_note'] = $snote;

        // Redirect to receipt.php with s_id parameter
        header('Location: receipt.php?s_id=' . $sid);
        exit();
    } else {
        // Error handling if query fails
        echo '
            <script type="text/javascript">
                alert("There was an error processing your request.");
                window.location.href = "trafficSummon.php";
            </script>
        ';
    }

    $stmt->close();
} else {
    echo "Form submission method not valid.";
}
?>
