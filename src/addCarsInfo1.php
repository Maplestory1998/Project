<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        *{
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

            background-color: rgb(19,27,38);
        }

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

        button:hover{
            color: #993300;
            text-decoration: none;
        }

        button:active{
            color: #ff0033;
            text-decoration: none;

        }

        #menu4 {
            background-color: rgb(0, 71, 153);
        }
    </style>

<body>

    <?php
    session_start();
    ob_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
        exit;
    }
    include_once("header.php");
    include_once("left-nav.php");
    include_once('conn.php');
    ?>
    <div class="sentence">Owner exists in system. Please enter vehicle information</div>
    <div class="addCarsInfoForm">
        <form name="addCarsInfo" class="form" method="post">
            <label for "vLic">Please input Vehicle Licence</label>
            <input type="text" name="vLic" placeholder="Vehicle Licence" required><br>
            <label for "model">Please input model</label>
            <input type="text" name="model" placeholder="model" required><br>
            <label for "color">Please input color</label>
            <input type="text" name="color" placeholder="color" required><br>
            <button type="submit" name="addcarinfo">Add Car</button>
        </form>
    </div>

    <?php
    $ownerID = $_GET["ownerID"];
    if ($ownerID == "") {
        $msg = "-1";
        header("Location: addCars.php?msg=$msg");
        exit;
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
        header("Location: addCars.php?msg=$msg");
    }
    ob_end_flush();
    exit;

    ?>


</body>

</html>