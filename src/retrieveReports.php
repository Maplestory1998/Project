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
    .result {
        width: 80%;
        margin: 0 auto;
    }

    #menu5 {
        background-color: rgb(0, 71, 153);
    }

    #edit {
        color: red;
        font-size: 15px;
    }

    .form {
    margin: 100px auto 100px auto;
    background-color: white;
    width: 600px;
    padding-left: 100px;
}
</style>

<body>

    <?php
    session_start();
    ob_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }
    include_once('conn.php');
    include_once("header.php");
    include_once("left-nav.php");



    $sql = "SELECT Incident_ID, Vehicle_licence, People_name, People_licence, Incident_Date, Incident_Report, Offence_description
                FROM Incident AS I, People AS P, Vehicle AS V, Offence AS O WHERE I.Vehicle_ID = V.Vehicle_ID AND I.People_ID = P.People_ID AND O.Offence_ID = I.Offence_iD;";


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
                    <th>Delete</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $Incident_ID = $row["Incident_ID"];
                echo "<tr>";
                echo "<td>" . $row["Incident_ID"] . "</td>";
                echo "<td>" . $row["Vehicle_licence"] . "</td>";
                echo "<td>" . $row["People_name"] . "</td>";
                echo "<td>" . $row["People_licence"] . "</td>";
                echo "<td>" . $row["Incident_Date"] .  "   <a id='edit' href='?id=$Incident_ID&date=1'>edit</a>" . "</td>";
                echo "<td>" . $row["Incident_Report"] . "   <a id='edit' href='?id=$Incident_ID&report=1'>edit</a>" . "</td>";
                echo "<td>" . $row["Offence_description"] . "   <a id='edit' href='?id=$Incident_ID&desc=1'>edit</a>" . "</td>";
                echo "<td>" . "<button onclick=confirmDelete($Incident_ID)>Delete" . "</td>";
                echo "</tr>";
            }

            ?>

        </table>
    </div>


    <?php
        if (isset($_GET['del'])) {
            // construct the DELETE query
            $ID = $_GET['del'];
            $sql_delete = "DELETE FROM Incident WHERE Incident_ID=$ID;";
        
            $result_delete = mysqli_query($conn, $sql_delete);
            header("Location: retrieveReports.php");
          }
        
        if(isset($_GET['date']))
        {
            echo "<form class='form' method='post'>";
            echo "<label for 'newDate'>Please input new Incident Date:</label><br>";
            echo "<input type='date' name='newDate' id='newDate' placeholder='newDate' required><br>";
            echo "<button type='submit' name='changeDate'>Change Incident Date</button>";
            echo "</form>";
        }   
        if(isset($_GET['report']))
        {
            echo "<form class='form' method='post'>";
            echo "<label for 'newReport'>Please input new Incident Report:</label><br>";
            echo "<input type='text' name='newReport' id='newReport' placeholder='newReport' required><br>";
            echo "<button type='submit' name='changeReport'>Change Incident Report</button>";
            echo "</form>";
        }

        if(isset($_GET['desc']))
        {
            $sql_get = "SELECT Offence_ID, Offence_description FROM Offence";
            $result_get = mysqli_query($conn, $sql_get);
            echo "<form class='form' method='post'>";
            echo "<select name='OffenceDescr'>";
            while ($row = mysqli_fetch_assoc($result_get)) {
                echo "<option value='" . $row['Offence_ID'] . "'>" . $row['Offence_description'] . "</option>";
            }
            echo "</select>";
            echo "<button type='submit' name='changeDesc'>Change Offence description</button>";
            echo "</form>";
        }


        if(isset($_POST['changeDate']))
        {
            $newDate = $_POST['newDate'];
            $ID = $_GET['id'];

            $sql_edit = "UPDATE Incident SET Incident_Date='$newDate' WHERE Incident_ID = $ID;";
            mysqli_query($conn, $sql_edit);
            header("Location: retrieveReports.php");
        }

        if(isset($_POST['changeReport']))
        {
            $newReport = $_POST['newReport'];
            $ID = $_GET['id'];
            $sql_edit = "UPDATE Incident SET Incident_Report = '$newReport' WHERE Incident_ID = $ID;";
            mysqli_query($conn, $sql_edit);
            header("Location: retrieveReports.php");
        }

        if(isset($_POST['changeDesc']))
        {
            $ID = $_GET['id'];
            $OffenceID = $_POST['OffenceDescr'];

            $sql_edit = "UPDATE Incident SET Offence_ID = '$OffenceID' WHERE Incident_ID = $ID;";
            mysqli_query($conn, $sql_edit);
            header("Location: retrieveReports.php");

        }
        ob_end_flush();
    ?>
    <script>
        // A JavaScript function to confirm delete
        function confirmDelete(ID) {
            var conf = confirm("Are you sure?");
            if (conf == true) // if OK pressed
            {
                delParam = "?del=" + ID; // add del parameter to URL
                this.document.location.href = delParam; // reload document
            }
        }
    </script>


</body>

</html>