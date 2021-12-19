<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <title>Document</title>
    <style>
        .result{
            margin-left: 400px;
        }
        #menu2 {
            background-color: rgb(0, 71, 153);
        }


    </style>
</head>

<body>
    <?php
    session_start();
    ob_start();
    include_once('conn.php');
    include_once("header.php");
    include_once("left-nav.php");
    
    //No user logged in, illegal access, jump to login.php with msg.
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }

    if(isset($_POST['submitByLic']) ||isset($_POST['submitByName']) )
    {
        $sql = "";
        // query by People licence
        if (isset($_POST['submitByLic'])) {
            $licNum = $_POST['licence'];
            $sql = "SELECT * FROM People WHERE People_licence = '$licNum';";
        }
        // query by People Nmae
        if (isset($_POST['submitByName'])) {
            $name = $_POST['name'];
            $sql = "SELECT * FROM People WHERE People_name LIKE '%$name%'; ";
        }
    
        $result = mysqli_query($conn, $sql);
        //Person is not existing
        if (mysqli_num_rows($result) == 0)
        {
            $msg = "1";
            header("Location: lookUpPeople.php?msg=$msg");
            exit;
        }

    }
    else header("Location: lookUpPeople.php");
    ob_end_flush();
    
    // print result
    ?>
    <div class="result">
        <table border="2" width="75%" align="center">
            <caption>People Information</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Licence</th>
                    <th>Fines</th>
                    <th>Penalty points</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $People_ID = $row["People_ID"];
                //query fined amount and points.
                $sql_getFine = "SELECT SUM(Fine_Amount) AS Fines, SUM(Fine_Points) as Points FROM Fines AS F WHERE F.Incident_ID in (SELECT Incident_ID FROM Incident WHERE People_ID = $People_ID)";
                $result_getFine = mysqli_query($conn, $sql_getFine);
                $row_getFine = mysqli_fetch_assoc($result_getFine);

                echo "<tr>";
                echo "<td>" . $row["People_name"] . "</td>";
                echo "<td>" . $row["People_address"] . "</td>";
                echo "<td>" . $row["People_licence"] . "</td>";
                echo "<td>" . $row_getFine["Fines"] . "</td>";
                echo "<td>" . $row_getFine["Points"] . "</td>";
                echo "</tr>";
            }
            mysqli_close($conn);
            ?>

        </table>
    </div>


</body>

</html>