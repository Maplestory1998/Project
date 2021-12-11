<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Police Traffic </title>
    <link rel="stylesheet" type="text/css" href="">

</head>

<script>
    function getQueryVariable(name) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == name) {
                return pair[1];
            }
        }
        return false;
    }

    var content = getQueryVariable("msg");
    switch (content) {
        case "1":
            alert("Administrator privileges required!");
            break;
    }
</script>


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