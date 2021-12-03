<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="../css/changepsw.css">

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
    <div id="changepswform">
        <form name="changepsw" action="changepswaction.php" onsubmit="return validateForm()" method="post">
            <label for "curpsw">Current Password:</label><br>
            <input type="password" name="curpsw" id="curpsw" required><br>
            <label for "newpsw">New Password:</label><br>
            <input type="password" name="newpsw" id="newpsw" required><br>
            <label for "newpsw2">Re-enter new Password:</label><br>
            <input type="password" name="newpsw2" id="newpsw2" required><br>
            <button type="submit" name="subpsw">Save changes</button>
        </form>
    </div>

    <script>

        function validateForm() {
            let x = document.getElementById("newpsw").value;

            let y = document.getElementById("newpsw2").value;
            if (x !== y) {
                alert("Passwords do not match!");
                return false;
            }

        }
    </script>

</body>

</html>