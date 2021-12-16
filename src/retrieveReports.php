<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <title>Document</title>
</head>
<style>
        .result{
            width:80%;
            margin: 0 auto;
        }
               
        #menu5 {
            background-color: rgb(0, 71, 153);
        }


    </style>
<body>

    <?php
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }
    include_once('conn.php');
    include_once("header.php");
    include_once("left-nav.php");


    if (isset($_POST['retrieve'])) {
        $sql = "SELECT Incident_ID, Vehicle_licence, People_name, People_licence, Incident_Date, Incident_Report, Offence_description
                FROM Incident AS I, People AS P, Vehicle AS V, Offence AS O WHERE I.Vehicle_ID = V.Vehicle_ID AND I.People_ID = P.People_ID AND O.Offence_ID = I.Offence_iD;";
    }
    
    $result = mysqli_query($conn, $sql);


    ?>
    <div class="table">
        <table border="1" width="50%" align="center">
            <caption>Reports</caption>
            <thead>
                <tr>
                    <th>Incident ID</th>
                    <th>Vehicle licence</th>
                    <th>People name</th>
                    <th>People licence</th>
                    <th>Incident date</th>
                    <th>Incident report</th>
                    <th>Offence_description</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Incident_ID"] . "</td>";
                echo "<td>" . $row["Vehicle_licence"] . "</td>";
                echo "<td>" . $row["People_name"] . "</td>";
                echo "<td>" . $row["People_licence"] . "</td>";
                echo "<td>" . $row["Incident_Date"] . "</td>";
                echo "<td>" . $row["Incident_Report"] . "</td>";
                echo "<td>" . $row["Offence_description"] . "</td>";
                echo "</tr>";
            }
            mysqli_close($conn);
            ?>

        </table>
    </div>


</body>

</html>