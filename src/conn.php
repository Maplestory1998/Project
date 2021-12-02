<?php
    //read MySQL database information
    $server = file_get_contents("../config/mysql.json");
    $serverdata = json_decode($server, true);
    $hostname = $serverdata["hostname"];
    $username = $serverdata["username"];
    $password = $serverdata["password"];
    $dbname = $serverdata["dbname"];
    
    //connect to the database
    
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    if(mysqli_connect_errno())
    {
        echo "Fail to connect MySQL";
        die();
    }

?>