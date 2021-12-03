<?php
session_start();
include_once('conn.php');
$username = $_SESSION['username'];
$curpsw = $_POST['curpsw'];
$newpsw = $_POST['newpsw'];
$newpsw2 = $_POST['newpsw2'];


$msg = "";
$sql1 = "SELECT Password FROM PoliceOffice WHERE Username = '$username' ;";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
    $psw = mysqli_fetch_assoc($result)["Password"];
    echo $psw;
    if ($psw !== $curpsw) {
        $msg = "Current Password is incorrect";
    } else {
        $sql2 = "UPDATE PoliceOffice SET Password = '$newpsw' WHERE Username = '$username';";
        //change psw;
        mysqli_query($conn, $sql2);
        //verify if the password has been changed;
        $sql3 = "SELECT * FROM PoliceOffice WHERE Username = '$username' AND Password = '$newpsw' ";
        mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) //success
            $msg = "Change Password Successful!";
        else
            $msg = "Fail to change Password!";
    }
} else {
    $msg = "Fail to find current account!";
}
mysqli_close($conn);
header('Location: changepsw.php?msg=$msg');
