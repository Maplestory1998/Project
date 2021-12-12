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

    $ownerID = $_GET["ownerID"];
    if ($ownerID == "") {
        $msg = "-1";
        header("Location: addCars.php?msg=$msg");
    }
    if (isset($_POST["addcarinfo"])) {
        $vLic = $_POST["vLic"];
        $model = $_POST["model"];
        $color = $_POST["color"];

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

    ?>
    <div class="addCarsInfoForm">
        <form name="addCarsInfo" method="post">
            <label for "vLic">Please input Vehicle Licence</label>
            <input type="text" name="vLic" placeholder="Vehicle Licence" required><br>
            <label for "model">Please input model</label>
            <input type="text" name="model" placeholder="model" required><br>
            <label for "color">Please input color</label>
            <input type="text" name="color" placeholder="color" required><br>
            <button type="submit" name="addcarinfo">Add Car</button>
        </form>
    </div>


</body>

</html>