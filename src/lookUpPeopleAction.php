<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include_once('conn.php');
    include_once("header.php");
    include_once("left-nav.php");

    $sql = "";
    if (isset($_POST['submitByLic'])) {
        $licNum = $_POST['licence'];
        $sql = "SELECT * FROM People WHERE People_licence = '$licNum';";
    }
    echo $sql;
    if (isset($_POST['submitByName'])) {
        $name = $_POST['name'];
        $sql = "SELECT * FROM People WHERE People_name LIKE '%$name%'; ";
    }

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);


    ?>
    <div class="table">
        <table border="1" width="50%" align="center">
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
            }
            mysqli_close($conn);
            ?>

        </table>
    </div>


</body>

</html>