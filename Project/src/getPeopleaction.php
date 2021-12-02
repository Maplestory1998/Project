<?php
    $conn = $_SESSION['coon'];
    $sql = "";
    if(isset($_POST['submiByLic']))
    {
        $licNum = $_POST['licence'];
        $sql = "SELECT * FROM people WHERE People_licence = '$licNum'";
    }
    if(isset($_POST['submitByName']))
    {
        $name = $_POST['name'];
        $sql = "SELECT * FROM people WHERE People_name LIKE '%$name%' ";
    }

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result))
    {
        echo $row['People_name'];
        echo $row['People_address'];
        echo $row['People_licence'];
        echo "<br/>";
    }
    exit();

?>
