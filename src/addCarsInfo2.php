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

    $msg = "";
    $ownerID = $_GET["ownerID"];
    if ($ownerID != "-1") {
        $msg = "-1";
        header("Location: addCars.php?msg=$msg");
    }

    if (isset($_POST["addcarinfo"])) {
        $vLic = $_POST["vLic"];
        $model = $_POST["model"];
        $color = $_POST["color"];
        $ownerName = $_POST["ownerName"];
        $ownerLic = $_POST["ownerLic"];
        $ownerAdd = $_POST["ownerAdd"];

        if ($ownerAdd == "") {
            // Address isn't entered. Set Address NULL.
            $sql1 = "INSERT INTO People(People_name, People_licence) VALUES('$ownerName', '$ownerLic'); ";
        } else $sql1 = "INSERT INTO People(People_name, People_licence, People_address) VALUES('$ownerName', '$ownerLic', '$ownerAdd');";

        //Add new owner
        if (FALSE == mysqli_query($conn, $sql1)) {
            //Fail to add new people!
            $msg = "3";
            header("Location: addCars.php?msg=$msg");
        }

        // get owenrID
        $sql2 = "SELECT * FROM People WHERE People_licence = '$ownerLic';";

        $result2 = mysqli_query($conn, $sql2);
        $pID = mysqli_fetch_assoc($result2)['People_ID'];

        //Add car INFO
        $sql3 = "INSERT INTO Vehicle(Vehicle_type, Vehicle_colour,Vehicle_licence) VALUES('$model', '$color', '$vLic');";
        $result3 = mysqli_query($conn, $sql3);

        // get Vehicle_ID
        $sql4 = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$vLic';";
        $result4 = mysqli_query($conn, $sql4);
        $vID = mysqli_fetch_assoc($result4)['Vehicle_ID'];

        //Add Table Ownership
        $sql5 = "INSERT INTO Ownership(People_ID, Vehicle_ID) VALUES('$pID', '$vID');";
        $result5 = mysqli_query($conn, $sql5);

        //succeed to add new People and Cars.
        $msg = "0";
        header("Location: addCars.php?msg=$msg");
    }

    ?>
    <div class="addCarsInfoForm2">
        <form name="addCarsInfo2" method="post">
            <label for "vLic">Please input Vehicle Licence</label>
            <input type="text" name="vLic" placeholder="Vehicle Licence" required><br>
            <label for "model">Please input model</label>
            <input type="text" name="model" placeholder="model" required><br>
            <label for "color">Please input color</label>
            <input type="text" name="color" placeholder="color" required><br>
            <label for "ownerName">Please input owner's name</label>
            <input type="text" name="ownerName" placeholder="owner name" required><br>
            <label for "ownerLic">Please input owner's licence</label>
            <input type="text" name="ownerLic" placeholder="owner licence" required><br>
            <label for "ownerAdd">Please input owner's address(optional)</label>
            <input type="text" name="ownerAdd" placeholder="owner address"><br>

            <button type="submit" name="addcarinfo">Add Car</button>
        </form>
    </div>


</body>

</html>