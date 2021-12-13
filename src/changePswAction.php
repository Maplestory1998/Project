<?php
session_start();
include_once('conn.php');
if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
    $msg = "Please log in!";
    header("Location: login.php?msg=$msg");
}
if (isset($_POST["subPsw"])) {
    $username = $_SESSION['username'];
    $curpsw = $_POST['curPsw'];
    $newpsw = $_POST['newPsw'];
    $newpsw2 = $_POST['newPsw2'];


    $msg = "";
    $sql1 = "SELECT Password FROM PoliceOffice WHERE Username = '$username' ;";
    $result = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result) > 0) {
        $psw = mysqli_fetch_assoc($result)["Password"];
        echo $psw;
        if ($psw !== $curpsw) {
            // Current Password is incorrect
            $msg = "1";
        } else {
            $sql2 = "UPDATE PoliceOffice SET Password = '$newpsw' WHERE Username = '$username';";
            //change psw;
            mysqli_query($conn, $sql2);
            //verify if the password has been changed;
            $sql3 = "SELECT * FROM PoliceOffice WHERE Username = '$username' AND Password = '$newpsw' ";
            mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result) > 0) //success
                // Change Password Successful!
                $msg = "2";
            else
                // Fail to change Password!
                $msg = "3";
        }
    } else {
        // Fail to find current account!
        $msg = "4";
    }
    mysqli_close($conn);
    header("Location: changePsw.php?msg=$msg");
}
?>