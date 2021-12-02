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
            <label for "newpwd">New Password:</label>
            <input type="password" name="newpwd"><br>
            <label for "newpwd2">Re-enter new Password:</label>
            <input type="password" name="newpwd2"><br>
            <button type="submit" name="subpsw">Save changes</button>

        </form>

    </body>
</html>