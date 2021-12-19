<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <title>Create Account</title>
    <style>

        #menu6 {
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
    if ($_SESSION["role"] != 1) {
        $msg = "1";
        header("Location: index.php?msg=$msg");
        exit;
    }
    include_once("header.php");
    include_once("left-nav.php");
    include_once('conn.php');
    ?>

    <div class="sentence">Use the form below to create new police officer accounts:</div>
    <div class="divForm">
        <form name="createAccount" class="form" method="post">
            <label for "new_username">New Username:</label><br>
            <input type="text" name="new_username" maxlength="45" required><br>
            <label for "new_password">Password:</label><br>
            <input type="password" name="new_password" maxlength="45" required><br>
            <button type="submit" name="submit">Create Account</button>
        </form>
    </div>

    <?php
    $msg = "";
    if (isset($_POST['submit'])) {
        $new_username = $_POST["new_username"];
        $new_password = $_POST["new_password"];

        $sql_verify = "SELECT * FROM PoliceOfficer WHERE Username='$new_username';";
        $res_verify = mysqli_query($conn, $sql_verify);
        if (mysqli_num_rows($res_verify) > 0) {
            //account has been existed!
            $msg = "1";
        } else {
            $sql = "INSERT INTO PoliceOfficer(Username, Password, role) VALUES('$new_username', '$new_password', 0);";
            $result = mysqli_query($conn, $sql);
            if ($result == TRUE) {
                $msg = "0";
            } else {
                $msg = "2";
            }
        }
        header("Location: createAccount.php?msg=$msg");
    }
    ob_end_flush();
    ?>
    <script>
        var content = getQueryVariable("msg");
        switch (content) {
            case "0":
                alert("create new Police Officer account successuful.");
                break;
            case "1":
                alert("account has been existed!!");
                break;
            case "2":
                alert("Fail to create account!");
        }
    </script>
</body>

</html>