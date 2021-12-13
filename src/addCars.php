<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <style>
        * {
            font-style: serif;
            font-size: 30px;
        }

        .sentence {
            font-size: 30px;
            color: white;
            height: 70px;
            width: 100%;
            line-height: 70px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;

            background-color: rgb(19, 27, 38);
        }

        .form {
            margin: 100px auto 100px auto;
            background-color: white;

            width: 700px;
            padding-left: 100px;

        }


        input {
            width: 600px;
            padding: 12px 20px;
            margin: 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 300px;
            margin: 10px 150px 10px 150px;
            border-radius: 16px;
            font-size: 30px;
        }

        button:hover {
            color: #993300;
            text-decoration: none;
        }

        button:active {
            color: #ff0033;
            text-decoration: none;

        }

        #menu4 {
            background-color: rgb(0, 71, 153);
        }
    </style>
    <title>Document</title>
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
    <div id="addCarsForm">
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
            exit();
        } else {
            $ownerID = "-1";
            header("Location: addCarsInfo2.php?ownerID=$ownerID");
            exit();
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