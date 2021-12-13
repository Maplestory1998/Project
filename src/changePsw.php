<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <script src="getQueryResult.js" type="text/javascript"></script>
    <style>
        *{
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

            background-color: rgb(19,27,38);
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

        button:hover{
            color: #993300;
            text-decoration: none;
        }

        button:active{
            color: #ff0033;
            text-decoration: none;

        }

        #menu1 {
            background-color: rgb(0, 71, 153);
        }
    </style>
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

    <div class="sentence">Use the form below to change the password for your account</div>
    <div id="changePswForm">
         <form name="changePsw" class="form" action="changePswAction.php" onsubmit="return validateForm()" method="post">
            <label for "curpsw">Current Password:</label><br>
            <input type="password" name="curPsw" id="curPsw" required><br>
            <label for "newpsw">New Password:</label><br>
            <input type="password" name="newPsw" id="newPsw" required><br>
            <label for "newpsw2">Re-enter new Password:</label><br>
            <input type="password" name="newPsw2" id="newPsw2" required><br>
            <button type="submit" name="subPsw">Save changes</button>
            </form>
    </div>

    <script>
        function validateForm() {
            let x = document.getElementById("newPsw").value;

            let y = document.getElementById("newPsw2").value;
            if (x !== y) {
                alert("New Passwords do not match!");
                return false;
            }

        }

        var content = getQueryVariable("msg");
        switch (content) {
            case "1":
                alert("Current Password is incorrect");
                break;
            case "2":
                alert("Change Password Successful!");
                break;
            case "3":
                alert("Fail to change Password!");
                break;
            case "4":
                alert("Fail to find current account!");
                break;
        }
    </script>


</body>

</html>