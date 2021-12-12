<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }

    include_once("header.php");
    include_once("left-nav.php");
    ?>

    <div id="retrieveForm">
        <form name="retrieve" class="form" method="post" action="retrieveReports.php">
            <button type="submit" name="retrieve">Retrieve Reports</button>
        </form>
    </div>

    <div id="File report">
        <form name="fileReport" class="form" method="post" action="fileReportAction.php">
            <label for "reportDesc">Please enter the description of incident</label>
            <input type="text" name="reportDesc" placeholder="reportDesc" required><br>
            <label for "time">Please enter the time of incident</label>
            <input type="text" name="time" placeholder="time" required><br>
            <label for "VehicleLic">Please enter the licence of vehicle involved</label>
            <input type="text" name="VehicleLic" placeholder="VehicleLic" required><br>
            <label for "PeopleLic">Please enter the licence of people involved</label>
            <input type="text" name="PeopleLic" placeholder="PeopleLic" required><br>
            
            <button type="submit" name="Add">Submit</button>
        </form>
    </div>
</body>

</html>