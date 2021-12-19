<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <title>Look up Vehicle</title>
    <style>
        .divForm {
            height: 200px;
            padding: 0;
            border-bottom-style: solid;
            border-bottom-color: rgb(239, 239, 239);
        }

        .result {
            margin-left: 400px;
        }

        .form {
            margin: 0px auto;
            background-color: white;
            width: 700px;
            padding: 0 0 0 100px;
        }

        #menu3 {
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
    ?>

    <div class="sentence">Use the form below to Look up Vehicle</div>

    <div class="divForm">
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
        // try to query Vehicle information and Owner information
        $sql = "SELECT Vehicle_licence, Vehicle_make, Vehicle_model, Vehicle_colour, People_name, People_licence FROM Vehicle as V, People as P, Ownership as O
                    WHERE P.People_ID = O.People_ID AND O.Vehicle_ID =  V.Vehicle_ID AND V.Vehicle_licence = '$licence'; ";

        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        // Owner information exists, print all information
        if ($num > 0) {
            echo "<div class='result'>";
            echo "<table border='1' width='80%' align='center'>";
            echo "<caption>Vehicle Information</caption>";
            echo "<thead><tr><th>Vehicle_licence</th><th>Vehicle_make</th><th>Vehicle_model</th><th>Vehicle_colour</th><th>Owner_name</th><th>Owner_licence</th></tr></thead>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["Vehicle_licence"] . "</td>";
                    echo "<td>" . $row["Vehicle_make"] . "</td>";
                    echo "<td>" . $row["Vehicle_model"] . "</td>";
                    echo "<td>" . $row["Vehicle_colour"] . "</td>";
                    echo "<td>" . $row["People_name"] . "</td>";
                    echo "<td>" . $row["People_licence"] . "</td>";
                }
            }
            echo "</table>";
            echo "</div>";
        } else {
            //owner might be unknown. query excluding Owner information
            $sql2 = "SELECT Vehicle_licence, Vehicle_make, Vehicle_model, Vehicle_colour FROM Vehicle 
                        WHERE Vehicle_licence = '$licence'; ";

            $result2 = mysqli_query($conn, $sql2);
            $num2 = mysqli_num_rows($result2);
            if ($num2  > 0) {
                echo "<div class='result'>";
                echo "<table border='1' width='80%' align='center'>";
                echo "<caption>Vehicle Information</caption>";
                echo "<thead><tr><th>Vehicle_licence</th><th>Vehicle_make</th><th>Vehicle_model</th><th>Vehicle_colour</th><th>Owner_name</th><th>Owner_licence</th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result2)) {
                    echo "<tr>";
                    echo "<td>" . $row["Vehicle_licence"] . "</td>";
                    echo "<td>" . $row["Vehicle_make"] . "</td>";
                    echo "<td>" . $row["Vehicle_model"] . "</td>";
                    echo "<td>" . $row["Vehicle_colour"] . "</td>";
                    echo "<td>" . "Unknown" . "</td>";
                    echo "<td>" . "Unknown" . "</td>";
                }

                echo "</table>";
                echo "</div>";
            }
            //vehicle is not existing.
            else  echo "<p style=\"color:red\">The vehicle is not in the system</p>"  ;
        }
    }
    mysqli_close($conn);
    ob_end_flush();
    ?>

</html>


</body>

</html>