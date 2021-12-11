<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Look up Vehicle</title>
    <style>
        #lookUpVehicleForm {
            background-color: red;
            width: 1000px;
            height: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            padding: 50px;
        }

        #lookUpVehicleForm p {
            font-size: 30px;
        }

        .form {
            background-color: green;
            margin: 100px auto 100px auto;

            width: 600px;
            /* text-align:center; */
            padding-left: 100px;

        }

        input {
            width: 400px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

    <div id="lookUpVehicleForm">
        <p>Use the form below to Look up Vehecle</p>
        <form name="lookUpVehicle" class="form" method="post">
            <label for "licence">Please input Vehicle licence</label><br>
            <input type="text" name="licence"><br>
            <button type="submit" name="submit">Submit</button>
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
        if (mysqli_num_rows($result) > 0) 
        {
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
                echo "<td>" . $row["People_licence"] . "</td>";
            }
            
        }

    }
    mysqli_close($conn);
    ?>

</html>


</body>

</html>