<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <title>Add Fines</title>
    <style>
        * {
            font-style: serif;
            font-size: 30px;
        }

        .sentence {
            font-size: 30px;
            color: white;
            height: 70px;
            width: 100%;
            line-height: 70px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;

            background-color: rgb(19, 27, 38);
        }

        #addFinesForm {
            width: 80%;
            height: 850px;
            padding: 50px;
            /* background-color: red; */
        }

        .form {
            margin: 100px auto 100px auto;
            background-color: white;

            width: 600px;
            padding-left: 100px;

        }


        input {
            width: 600px;
            padding: 12px 20px;
            margin: 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 300px;
            margin: 10px 150px 10px 150px;
            border-radius: 16px;
            font-size: 30px;
        }

        button:hover {
            color: #993300;
            text-decoration: none;
        }

        button:active {
            color: #ff0033;
            text-decoration: none;

        }

        #menu1 {
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
    <div class="addFinesForm">
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
                $msg = "1";
            } else $msg = "2";
        } else {
            $msg = "3";
        }
        mysqli_close($conn);
        header("Location: addFines.php?msg=$msg");
        ob_end_flush();
    }
    ?>
    <script>
        var content = getQueryVariable("msg");
        switch (content) {
            case "1":
                alert("Add fine successuful.");
                break;
            case "2":
                alert("Fail to add fine!");
                break;
            case "3":
                alert("Incident isn't exist!");
        }
    </script>
</body>

</html>