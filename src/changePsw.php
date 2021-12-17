<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <script src="getQueryResult.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <style>
        #menu1 {
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
    }
    include_once("header.php");
    include_once("left-nav.php");
    ob_end_flush();
    ?>

    <div class="sentence">Use the form below to change the password for your account</div>
    <div class="divForm">
        <form name="changePsw" class="form" action="changePswAction.php" onsubmit="return validateForm()" method="post">
            <label for "curpsw">Current Password:</label><br>
            <input type="password" name="curPsw" id="curPsw" maxlength="45" required><br>
            <label for "newpsw">New Password:</label><br>
            <input type="password" name="newPsw" id="newPsw" maxlength="45" required><br>
            <label for "newpsw2">Re-enter new Password:</label><br>
            <input type="password" name="newPsw2" id="newPsw2" maxlength="45" required><br>
            <button type="submit" name="subPsw">Save changes</button>
        </form>
    </div>

    <script>
        // confirm that the two new passwords are the same
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
                alert("Current Password is incorrect!");
                break;
            case "2":
                alert("Password Changed successful!");
                break;
            case "3":
                alert("Failed to change Password!");
                break;
            case "4":
                alert("Failed to find current account!");
                break;
        }
    </script>


</body>

</html>