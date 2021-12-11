<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        #changePswForm {
            background-color: red;
            width: 1000px;
            height: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            padding: 50px;
        }

        #changePswForm p {
            font-size: 30px;

        }

        .form {
            background-color: green;
            margin: 100px auto 100px auto;

            width: 600px;
            /* text-align:center; */
            padding-left: 100px;

        }

        input {
            width: 400px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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


    <div id="changePswForm">
        <p>Use the form below to change the password for your account</p>
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