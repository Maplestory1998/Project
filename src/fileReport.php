<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <title>File report</title>
    <style>
        .divForm {
            height: 200px;
            padding: 0;
        }

        .form {
            margin: 0px auto;
            background-color: white;
            width: 1000px;
            padding: 70px 0 0 100px;
            border-bottom-style: solid;
            border-bottom-color: rgb(239, 239, 239);
        }

        .FilereportForm {

            margin-left: 400px;
            height: 800px;

            border-bottom-style: solid;
            border-bottom-color: rgb(239, 239, 239);
            /* background-color: red; */
        }

        #tips {
            margin: 0 auto;
            font-size: 30px;
            color: white;
            height: 70px;
            line-height: 70px;
            text-align: center;
            background-color: rgb(19, 27, 38);
        }

        select {
            width: 600px;
            padding: 12px 20px;
            margin: 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        #menu5 {
            background-color: rgb(0, 71, 153);
        }
    </style>
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

    ?>
    <div class="sentence">Use the form below to file or retrieve reports</div>
    <div class="divForm">
        <form name="retrieve" class="form" method="post" action="retrieveReports.php">
            <button type="submit" name="retrieve">Retrieve Reports</button>
        </form>
    </div>

    <div class="FilereportForm">
        <div id="tips">Enter details to file a report</div>
        <form name="fileReport" class="form" method="post" action="fileReportAction.php">
            <label for "reportDesc">Please enter the description of incident</label><br>
            <input type="text" name="reportDesc" placeholder="reportDesc" required><br>
            <label for "time">Please enter the time of incident</label><br>
            <input type="date" name="time" placeholder="xxxx-xx-xx" required><br>
            <label for "VehicleLic">Please enter the licence of vehicle involved</label><br>
            <input type="text" name="VehicleLic" placeholder="VehicleLic" required><br>
            <label for "PeopleLic">Please enter the licence of people involved</label><br>
            <input type="text" name="PeopleLic" placeholder="PeopleLic" required><br>
            <p>Please select the Offence descriptin</p>
            <select name="OffenceDescr">
                <?php
                $sql = "SELECT Offence_ID, Offence_description FROM Offence";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['Offence_ID'] . "'>" . $row['Offence_description'] . "</option>";
                }
                ob_end_flush();
                ?>
            </select>
            <button type="submit" name="Add">Submit</button>
        </form>
    </div>

    <script>
        var content = getQueryVariable("msg");
        switch (content) {
            case "-2":
                alert("SQL error");
                break;
            case "-1":
                alert("Please enter report information first.");
                break;
            case "0":
                alert("File report successful!");
                break;
        }
    </script>
</body>

</html>