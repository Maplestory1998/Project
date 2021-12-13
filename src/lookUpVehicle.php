<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Look up Vehicle</title>
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

        
        #lookUpVehicleForm {
            width: 80%;
            height: 150px;
            padding: 1px;
            border-bottom-style:solid;
            border-bottom-color: rgb(239,239,239);
        }

        .form {
            margin: 2px auto;
            background-color: white;
            /* position: relative; */

            width: 1500px;
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

        button:hover{
            color: #993300;
            text-decoration: none;
        }

        button:active{
            color: #ff0033;
            text-decoration: none;

        }

        #menu3 {
            background-color: rgb(0, 71, 153);
        }

        table{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin: 0 auto;

        }

        td,th {
            text-align: center;
            border: 2px solid #ddd;
            padding: 4px;
        }

        tr:hover{
            background-color: #f2f2f2;
        }      

        caption{
            text-align: center;
            font-size: 30px;
        }
    </style>

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

    <div class="sentence">Use the form below to Look up Vehicle</div>
    <div id="lookUpVehicleForm">
        <form name="lookUpVehicle" class="form" method="post">
            <label for "licence">Please enter the vehicle licence:</label><br>
            <input type="text" name="licence">
            <button type="submit" name="submit">Look up</button>
        </form>
    </div>

    <?php
    include_once('conn.php');
    $sql = "";
    if (isset($_POST["submit"])) {
        $licence = $_POST["licence"];
        $sql = "SELECT Vehicle_licence, Vehicle_type, Vehicle_colour, People_name, People_licence FROM Vehicle as V, People as P, Ownership as O
                    WHERE P.People_ID = O.People_ID AND O.Vehicle_ID =  V.Vehicle_ID AND V.Vehicle_licence = '$licence'; ";

        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='table'>";
            echo "<table border='1' width='80%' align='center'>";
            echo "<caption>Vehicle Information</caption>";
            echo "<thead><tr><th>Vehicle_licence</th><th>Vehicle_type</th><th>Vehicle_colour</th><th>Owner_name</th><th>Owner_licence</th></tr></thead>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Vehicle_licence"] . "</td>";
                echo "<td>" . $row["Vehicle_type"] . "</td>";
                echo "<td>" . $row["Vehicle_colour"] . "</td>";
                echo "<td>" . $row["People_name"] . "</td>";
                echo "<td>" . $row["People_licence"] . "</td>";
            }
        }
    }
    mysqli_close($conn);
    ?>

</html>


</body>

</html>