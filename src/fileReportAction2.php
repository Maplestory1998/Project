<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>File report</title>
</head>

<body>
    <?php
    session_start();
    ob_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }
    include_once("header.php");
    include_once("left-nav.php");
    include_once('conn.php');
    if ($_GET["msg"] == "") {
        $msg = "-1";
        header("Location: fileReport.php?msg=$msg");
    }

    ?>
    <div class="divForm">
        <form name="Info" id="Info" class="form" method="post">
            <label for "model" id="formodel">Please input model:</label><br>
            <input type="text" name="model" id="model" placeholder="model" required><br>
            <label for "color" id="forcolor">Please input color:</label><br>
            <input type="text" name="color" id="color" placeholder="color" required><br>
            <label for "ownerName" id="forownerName">Please input owner's name:</label><br>
            <input type="text" id="ownerName" name="ownerName" placeholder="owner name" required><br>
            <label for "ownerAdd" id="forownerAdd">Please input owner's address(optional)</label><br>
            <input type="text" name="ownerAdd" id="ownerAdd" placeholder="owner address"><br>

            <button type="submit" name="addinfo">Add Car</button>
        </form>
    </div>


    <script>
        function deletePeopleInfoForm() {
            var info = document.getElementById("Info");
            var ownerName = document.getElementById("ownerName");
            var forownerName = document.getElementById("forownerName");

            var ownerAdd = document.getElementById("ownerAdd");
            var forownerAdd = document.getElementById("forownerAdd");

            info.removeChild(forownerName);
            info.removeChild(ownerName);
            info.removeChild(ownerAdd);
            info.removeChild(forownerAdd);

            return;
        }

        function deleteVehicleInfoForm() {
            var info = document.getElementById("Info");
            var model = document.getElementById("model");
            var formodel = document.getElementById("formodel");

            var forcolor = document.getElementById("forcolor");
            var color = document.getElementById("color");

            info.removeChild(model);
            info.removeChild(formodel);
            info.removeChild(forcolor);
            info.removeChild(color);
        }

        var content = getQueryVariable("msg");
        switch (content) {
            case "2":
                // only lack VehicleInfo
                deletePeopleInfoForm();
                break;
            case "3":
                deleteVehicleInfoForm();
                break;
        }
    </script>

    <?php
    if (isset($_POST["addinfo"])) {
        $VehicleLic = $_GET["VehicleLic"];
        $PeopleLic = $_GET["PeopleLic"];
        $time = $_GET["time"];
        $OffenceID = $_GET["OffenceID"];
        
        $model = $_POST["model"];
        $color = $_POST["color"];
        $ownerName = $_POST["ownerName"];
        $ownerAdd = $_POST["ownerAdd"];
        $msg = $_GET["msg"];

        // lack People INFO
        if ($msg == "1" || $msg == "3") {
            if ($ownerAdd == "") {
                // Address isn't entered. Set Address NULL.
                $sql1 = "INSERT INTO People(People_name, People_licence) VALUES('$ownerName', '$PeopleLic'); ";
                
            } else $sql1 = "INSERT INTO People(People_name, People_licence, People_address) VALUES('$ownerName', '$PeopleLic', '$ownerAdd');";
            echo $sql1;
            //Add new owner
            if (FALSE == mysqli_query($conn, $sql1)) {
                //Fail to add new people!
                $msg = "-2";
            }
        }

        // get owenrID
        $sql2 = "SELECT * FROM People WHERE People_licence = '$PeopleLic';";

        $result2 = mysqli_query($conn, $sql2);
        $pID = mysqli_fetch_assoc($result2)['People_ID'];

        // lack Vehicle INFO
        if ($msg == "1" || $msg == "2") {
            //Add car INFO
            $sql3 = "INSERT INTO Vehicle(Vehicle_type, Vehicle_colour,Vehicle_licence) VALUES('$model', '$color', '$VehicleLic');";
            $result3 = mysqli_query($conn, $sql3);
        }

        // get Vehicle_ID
        $sql4 = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$VehicleLic';";
        $result4 = mysqli_query($conn, $sql4);
        $vID = mysqli_fetch_assoc($result4)['Vehicle_ID'];

        $sql5 = "INSERT INTO Incident(Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID) VALUES('$vID', '$pID', '$time', '$reportDesc', '$OffenceID');";
        $result5 = mysqli_query($conn, $sql5);
        //succeed to add new People and Cars.
        $msg = "0";

        header("Location: fileReport.php?msg=$msg");
    }
    ob_end_flush();
    ?>
</body>

</html>