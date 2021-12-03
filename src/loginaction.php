<?php
    include_once('conn.php');

    $uname = $_POST['username'];
    $psw = $_POST['psw'];

    $sqlCheckLog = "SELECT Password FROM PoliceOffice WHERE Username = '$uname' AND Password = '$psw'; " ;
    
    $resultCheckLog = mysqli_query($conn, $sqlCheckLog);

    if(mysqli_num_rows($resultCheckLog) > 0)
    {
        session_start();   
        $_SESSION['username'] = $uname ;
        $_SESSION['role'] = mysqli_fetch_assoc($resultCheckLog)['role']; // 1-admin ;
        mysqli_close($conn);

        header('Location: main.html');
    }
    else
    {
        $msg="Invalid Username or Password!";
        mysqli_close($conn);
        header("Location: login.php?msg=$msg");
    }
    exit;

?>

