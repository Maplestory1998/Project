<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Police Traffic</title>
    <link rel="stylesheet" type="text/css" href="../css/header.css">

</head>

<body>
    <div id="nav">
        <p>Welcome to the Police Traffic System</p>
        <?php  
            session_start();
            $user = $_SESSION["username"]; 
            echo "Log as: $user";
        ?>
        <a href="signout.php"> | Sign out</a>
    </div>

</body>

</html>