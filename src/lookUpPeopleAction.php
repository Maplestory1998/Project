<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .result{
            width:80%;
            margin: 0 auto;
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
        
        #menu2 {
            background-color: rgb(0, 71, 153);
        }

        caption{
            text-align: center;
            font-size: 30px;
        }
    </style>
</head>

<body>

    <?php
    include_once('conn.php');
    include_once("header.php");
    include_once("left-nav.php");
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }

    if(isset($_POST['submitByLic']) ||isset($_POST['submitByName']) )
    {
        $sql = "";
        if (isset($_POST['submitByLic'])) {
            $licNum = $_POST['licence'];
            $sql = "SELECT * FROM People WHERE People_licence = '$licNum';";
        }
        if (isset($_POST['submitByName'])) {
            $name = $_POST['name'];
            $sql = "SELECT * FROM People WHERE People_name LIKE '%$name%'; ";
        }
    
        $result = mysqli_query($conn, $sql);
    }
    else header("Location: lookUpPeople.php");
    
    ?>
    <div class="result">
        <table border="2" width="75%" align="center">
            <caption>People Information</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Licence</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["People_name"] . "</td>";
                echo "<td>" . $row["People_address"] . "</td>";
                echo "<td>" . $row["People_licence"] . "</td>";
                echo "</tr>";
            }
            mysqli_close($conn);
            ?>

        </table>
    </div>


</body>

</html>