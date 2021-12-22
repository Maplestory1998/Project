<?php
error_reporting(0);
include_once('conn.php');

if (isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $psw = $_POST['psw'];

    //query Password and User authority
    $sqlCheckLog = "SELECT Police_ID, Password, role FROM PoliceOfficer WHERE Username = '$uname' AND Password = '$psw'; ";

    $resultCheckLog = mysqli_query($conn, $sqlCheckLog);

    if (mysqli_num_rows($resultCheckLog) > 0) {
        $row = mysqli_fetch_assoc($resultCheckLog);
        session_start();
        $_SESSION['username'] = $uname;  //keep username
        $_SESSION['role'] = $row["role"]; // 1-admin    0-ordinary police ;
        $_SESSION['ID'] = $row["Police_ID"];
        mysqli_close($conn);

        header('Location: index.php');
    } else {
        $msg = "Invalid Username or Password!";
        mysqli_close($conn);
        header("Location: login.php?msg=$msg");
    }
}
