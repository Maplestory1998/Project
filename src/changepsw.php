<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="../css/changepsw.css">
    </head>
    <body>
        <p>Use the form below to change the password for your account</p>
        <form name="changepsw" method="post" action="changepswaction.php" >
            <label for "curpsw">Current Password</label>
            <input type="password" name="curpsw">
            <label for "newpsw">New Password:</label>
            <input type="password" name="newpsw"><br>
            <label for "newpsw2">Re-enter new Password:</label>
            <input type="password" name="newpsw2"><br>
            <button type="submit" name="subpsw">Save changes</button>

        </form>

    </body>
</html>