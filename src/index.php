<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Police Traffic </title>
    <script src="getQueryResult.js" type="text/javascript"></script>

</head>
<body>
<script>
    var content = getQueryVariable("msg");
    switch (content) {
        case "1":
            alert("Administrator privileges required!");
            break;
    }
</script>
</body>


<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
    $msg = "Please log in!";
    header("Location: login.php?msg=$msg");
}
include_once("header.php");
include_once("left-nav.php");

?>

</html>