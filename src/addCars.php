<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Add cars</title>
    <script src="getQueryResult.js" type="text/javascript"></script>
    <style>
        .form {
            width: 1000px;
        }

        #menu4 {
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
        exit;
    }
    include_once("header.php");
    include_once("left-nav.php");
    ?>
    <div class="sentence">Use the form below to add new cars information</div>
    <div class="divForm">
        <form name="findOwner" class="form" method="post">
            <label for "owner">Please enter the owner's licence of the new car first:</label><br>
            <input type="text" name="owner" placeholder="owner licence" required><br>
            <button type="submit" name="findOwnerExist">Submit</button>
        </form>
    </div>
    <?php
    include_once('conn.php');
    if (isset($_POST["findOwnerExist"])) {
        $owner = $_POST["owner"];
        $sql_query = "SELECT * FROM People WHERE People_licence = '$owner';";
        $result = mysqli_query($conn, $sql_query);

        if (mysqli_num_rows($result) > 0) {
            $ownerID = mysqli_fetch_assoc($result)['People_ID'];
            header("Location: addCarsInfo1.php?ownerID=$ownerID");
        } else {
            $ownerID = "-1";
            header("Location: addCarsInfo2.php?ownerID=$ownerID");
        }
    }   
    ob_end_flush();
    ?>
    <script>
        var content = getQueryVariable("msg");
        switch (content) {
            case "-1":
                alert("Please enter the car owner information first!");
                break;
            case "0":
                alert("Enter details for new Cars successful.");
                break;
            case "1":
                alert("Failed to add owner Information for new Cars.");
                break;
            case "2":
                alert("Failed to add new Cars information.");
                break;
            case "3":
                alert("Failed to add new people information!");
        }
    </script>

</body>

</html>