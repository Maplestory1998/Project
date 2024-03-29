<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Add cars</title>
    <style>

        .addCarsInfoForm {
            height: 850px;
            padding: 50px;
            margin: 0 auto;
        }

        .form {
            margin: 50px auto 0 auto;
            width: 50%;
            padding-left: 500px;

        }
        #menu4 {
            background-color: rgb(0, 71, 153);
        }
    </style>
</head>

<body>
    <?php
    error_reporting(0);
    session_start();
    ob_start();
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
        exit;
    }
    ?>
    <div class="sentence">Owner isn't in system. Please enter detailed information</div>
    <div class="addCarsInfoForm">
        <form name="addCarsInfo2" class="form" method="post">
            <label for "vLic">Please input Vehicle Licence:</label><br>
            <input type="text" name="vLic" placeholder="Vehicle Licence" maxlength="7" required><br>
            <label for "make">Please input make:</label><br>
            <input type="text" name="make" placeholder="make" maxlength="20" required><br>
            <label for "model">Please input model:</label><br>
            <input type="text" name="model" placeholder="model" maxlength="20" required><br>
            <label for "color">Please input color:</label><br>
            <input type="text" name="color" placeholder="color" maxlength="20" required><br>
            <label for "ownerName">Please input owner's name:</label><br>
            <input type="text" name="ownerName" placeholder="owner name" maxlength="50" required><br>
            <label for "ownerLic">Please input owner's licence:</label><br>
            <input type="text" name="ownerLic" placeholder="owner licence" maxlength="16" required><br>
            <label for "ownerAdd">Please input owner's address(optional)</label><br>
            <input type="text" name="ownerAdd" placeholder="owner address" maxlength="50"><br>

            <button type="submit" name="addcarinfo">Add Car</button>
        </form>
    </div>
    <?php
    if (isset($_POST["addcarinfo"])) {
        $vLic = $_POST["vLic"];
        $make = $_POST['make'];
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
            exit;
        }
        
        // get owenrID
        $sql2 = "SELECT * FROM People WHERE People_licence = '$ownerLic';";

        $result2 = mysqli_query($conn, $sql2);
        $pID = mysqli_fetch_assoc($result2)['People_ID'];

        //Add car INFO
        $sql3 = "INSERT INTO Vehicle(Vehicle_make, Vehicle_model, Vehicle_colour,Vehicle_licence) VALUES('$make', '$model', '$color', '$vLic');";
        if(FALSE == mysqli_query($conn, $sql3) )
        {
            //Fail to add car INFO, delete the onwen's Info just addd
            $sql_del = "DELETE FROM People WHERE People_ID = $pID;";
            mysqli_query($conn, $sql_del);
            $msg = "2";
            header("Location: addCars.php?msg=$msg");
            exit;
        }

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
    ob_end_flush();
    exit;

    ?>



</body>

</html>