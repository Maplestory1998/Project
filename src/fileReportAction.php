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
    include_once('conn.php');

    if (isset($_POST["Add"])) {
        $reportDesc = $_POST["reportDesc"];
        $time = $_POST["time"];
        $VehicleLic = $_POST["VehicleLic"];
        $PeopleLic = $_POST["PeopleLic"];

        $sql1 = "INSERT INTO Vehicle(Vehicle_type, Vehicle_colour,Vehicle_licence) VALUES('$model', '$color', '$vLic');";
        if (TRUE == mysqli_query($conn, $sql1)) {
            $sql2 = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$vLic';";
            $result2 = mysqli_query($conn, $sql2);
            $vID = mysqli_fetch_assoc($result2)['Vehicle_ID'];

            $sql3 = "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES('$ownerID', '$vID');";
            echo $sql3;
            if (TRUE == mysqli_query($conn, $sql3)) {
                // "Enter details for new Cars successful!"
                $msg = "0";
            } else {
                // Fail to add owner INFO for new Cars.
                $msg = "1";
            }
        } else {
            // Fail to add new Cars INFO.
            $msg = "2";
        }
        // header("Location: addCars.php?msg=$msg");
    }



</body>

</html>