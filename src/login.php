<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Police Traffic | Sign in</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>

<body>
    <div id="login">
        <h1>Police Traffic</h1>
        <form name="loginform" method="post" action="loginAction.php" >
            <label for "username">Username:</label><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <label for "psw">Password:</label><br>
            <input type="password" name="psw" placeholder="Password" required><br>
            <?php
                $ret = $_GET["msg"];
                echo "<p style=\"color:red\">$ret</p>";
            ?>
            <input type="submit" value="LOGIN">
        </form>
    </div>

</body>

</html>