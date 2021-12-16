<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <title>Add Fines</title>
    <style>

        #menu7 {
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
        exit;
    }
    if ($_SESSION["role"] != 1) {
        $msg = "1";
        header("Location: index.php?msg=$msg");
        exit;
    }
    include_once("header.php");
    include_once("left-nav.php");
    ?>

    <div class="sentence">Use the form below to add fines</div>
    <div class="divForm">
        <form name="addFines" class="form" method="post">
            <label for "incidentID">Incident ID:</label><br>
            <input type="text" name="incidentID" required><br>
            <label for "amount">Fine Amount:</label><br>
            <input type="text" name="amount" id="amount" required><br>
            <label for "points">Points:</label><br>
            <input type="text" name="points" id="points" required><br>
            <button type="submit" name="submit">Add Fine</button>
        </form>
    </div>

    <?php
    include_once('conn.php');
    $msg = "";
    if (isset($_POST['submit'])) {
        $id = $_POST["incidentID"];
        $amount = $_POST["amount"];
        $points = $_POST["points"];

        // find if incidentID exist
        $sql1 = "SELECT * FROM Incident WHERE Incident_ID=$id;";
        $res1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($res1) > 0) {
            $sql = "INSERT INTO Fines(Incident_ID, Fine_Amount, Fine_Points) VALUES($id ,$amount, $points);";
            $result = mysqli_query($conn, $sql);

            $sql_verify = "SELECT * FROM Fines WHERE Incident_ID=$id AND Fine_Amount=$amount AND Fine_Points=$points;";
            $result_verify = mysqli_query($conn, $sql_verify);
            echo $sql_verify;
            if (mysqli_num_rows($result_verify) > 0) {
                $msg = "0";
            } else $msg = "1";
        } else {
            $msg = "2";
        }
        mysqli_close($conn);
        header("Location: addFines.php?msg=$msg");
    }
    ob_end_flush();
    ?>
    <script>
        var content = getQueryVariable("msg");
        switch (content) {
            case "0":
                alert("Add fine successuful.");
                break;
            case "1":
                alert("Fail to add fine!");
                break;
            case "2":
                alert("Incident isn't exist!");
        }
    </script>
</body>

</html>