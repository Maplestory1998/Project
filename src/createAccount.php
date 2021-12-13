<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <title>Create Account</title>
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

        #changePswForm {
            width: 80%;
            height: 850px;
            padding: 50px;
            /* background-color: red; */
        }

        .form {
            margin: 100px auto 100px auto;
            background-color: white;

            width: 600px;
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
    ?>

    <div class="sentence">Use the form below to create new police officer accounts:</div>
    <div class="createAccountForm">
        <form name="createAccount" class="form" method="post">
            <label for "new_username">New Username:</label><br>
            <input type="text" name="new_username" required><br>
            <label for "new_password">Password:</label><br>
            <input type="password" name="new_password" required><br>
            <button type="submit" name="submit">Create Account</button>
        </form>
    </div>

    <?php
    include_once('conn.php');
    $msg = "";
    if (isset($_POST['submit'])) {
        $new_username = $_POST["new_username"];
        $new_password = $_POST["new_password"];

        $sql_verify = "SELECT * FROM PoliceOffice WHERE Username='$new#';";
        $res_verify = mysqli_query($conn, $sql_verify);
        if (mysqli_num_rows($res_verify) > 0) {
            //account has been existed!
            $msg = "1";
        } else {
            $sql = "INSERT INTO PoliceOffice(Username, Password, role) VALUES('$new_username', '$new_password', 0);";
            $result = mysqli_query($conn, $sql);
            if ($result == TRUE) {
                $msg = "0";
            } else {
                $msg = "2";
            }
        }
        header("Location: createAccount.php?msg=$msg");
        exit;
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
            case "3":
                alert("Fail to create account!");
        }
    </script>
</body>

</html>