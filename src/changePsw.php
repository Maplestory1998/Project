<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>

</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION["username"]) || $_SESSION["username"] == "")
        {
            $msg="Please log in!";
            header("Location: login.php?msg=$msg");
        }
    ?>
    <p>Use the form below to change the password for your account</p>
    <div id="changePswForm">
        <form name="changePsw" action="changePswAction.php" onsubmit="return validateForm()" method="post">
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
                alert("Passwords do not match!");
                return false;
            }

        }
    </script>

</body>

</html>