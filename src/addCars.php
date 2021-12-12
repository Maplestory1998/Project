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
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }
    include_once("header.php");
    include_once("left-nav.php");
    ?>

    <div id="addCarsForm">
        <p>Use the form below to add new cars</p>
        <form name="findOwner" method="post">
            <label for "owner">Please enter the owner's licence of the new car first</label>
            <input type="text" name="owner" placeholder="owner licence" required><br>
            <button type="submit" name="findOwnerExist">Submit</button>
        </form>
    </div>
    <?php
    include_once('conn.php');
    if (isset($_POST["findOwnerExist"])) {
        $owner = $_POST["owner"];
        $sql_query = "SELECT * FROM People WHERE People_licence = '$owner';";
        echo $sql_query;
        $result = mysqli_query($conn, $sql_query);

        if (mysqli_num_rows($result) > 0) {
            $ownerID = mysqli_fetch_assoc($result)['People_ID'];
            header("Location: addCarsInfo1.php?ownerID=$ownerID");
        } else {
            $ownerID = "-1";
            header("Location: addCarsInfo2.php?ownerID=$ownerID");
        }
    }
    ?>
    <script>
        function getQueryVariable(name) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == name) {
                    return pair[1];
                }
            }
            return false;
        }

        var content = getQueryVariable("msg");
        switch (content) {
            case "-1":
                alert("Please enter the car owner information first!");
                break;
            case "0":
                alert("Enter details for new Cars successful.");
                break;
            case "1":
                alert("Fail to add owner INFO for new Cars.");
                break;
            case "2":
                alert("Fail to add new Cars INFO.");
                break;
            case "3":
                alert("Fail to add new people info!");
        }
    </script>

</body>

</html>