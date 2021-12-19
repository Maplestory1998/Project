<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Police Traffic System | Log in</title>
    <style>

    </style>
</head>

<body>
    <div id="login">
        <h1>Police Traffic System  </h1>
        <form name="loginform" method="post" action="loginAction.php">
            <label for "username">Username:</label><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <label for "psw">Password:</label><br>
            <input type="password" name="psw" placeholder="Password" required><br>
            <?php
            // print login error information
            $ret = $_GET["msg"];
            echo "<p style=\"color:red\">$ret</p>"  ;
            ?>
            <button type="submit" name="submit">LOGIN</button>
        </form>
    </div>

</body>

</html>