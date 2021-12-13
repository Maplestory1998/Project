<?php
    include_once('conn.php');

    if(isset($_POST['submit']))
    {
        $uname = $_POST['username'];
        $psw = $_POST['psw'];
    
        $sqlCheckLog = "SELECT Password, role FROM PoliceOffice WHERE Username = '$uname' AND Password = '$psw'; " ;
        
        $resultCheckLog = mysqli_query($conn, $sqlCheckLog);
    
        if(mysqli_num_rows($resultCheckLog) > 0)
        {  
            $row = mysqli_fetch_assoc($resultCheckLog);
            session_start();
            $_SESSION['username'] = $uname ;
            $_SESSION['role'] = $row["role"]; // 1-admin ;
            mysqli_close($conn);
    
            header('Location: index.php');
        }
        else
        {
            $msg="Invalid Username or Password!";
            mysqli_close($conn);
            header("Location: login.php?msg=$msg");
        }
    }
?>
   
