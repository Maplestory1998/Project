<?php
    session_start();
    include_once('conn.php');

    $uname = $_POST['username'];
    $psw = $_POST['psw'];

    $sqlCheckLog = "SELECT Password FROM PoliceOffice WHERE Username = '$uname' AND Password = '$psw' " ;
    $resultCheckLog = mysqli_query($conn, $sqlCheckLog);
    echo $sqlCheckLog;
    /*
    if(mysqli_num_rows($resultCheckLog) > 0)
    {
        $_SESSION['username'] = $uname ;
        $_SESSION['conn'] = $conn;
        $_SESSION['role'] = mysqli_fetch_assoc($resultCheckLog)['role']; // 1-admin ;
        header('Location: main.php');
    }
    else
    {
        $msg="Invalid Username or Password!";
        header('Location: login.php?msg=$msg');
    }
    exit;
    */
?>

