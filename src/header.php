<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Traffic System</title>
    <style>
        *{
            margin: 0 0;
            font-family: serif;
        }

        #nav {
            background-color: rgb(0, 33, 68);
            width: 100%;
            height: 100px;
            color: white;
        }

        .logo {
            font-size: 40px;
            height: 100px;
            line-height: 100px;
    
            float: left;
            margin-left: 20px;
        }

        .info {
            font-size: 30px;
            height: 100px;
            line-height: 100px;
            float: right;
            margin-right: 30px;
        }

        a {
            font-size: 30px;
            color: white;
            font-weight: 400;
            white-space: normal;
            word-wrap: break-word;
            text-align: left;
            text-decoration: none;
        }

        a:hover{
            color: #993300;
            text-decoration: underline;
        }

        a:active{
            color: #ff0033;
            text-decoration: none;

        }
    </style>
</head>


<body>
    <div id="nav">
        <div class="logo">
            Police Traffic System
        </div>
        <div class="info">
            <?php
            error_reporting(0);
            session_start();
            $user = $_SESSION["username"];
            echo "Log as: $user";
            if($_SESSION['role'] == 1)
                echo "(Administrator) | ";
            else echo "(Ordinary) | ";
            ?>
            <a href="signout.php">Sign out</a>
        </div>

    </div>

</body>

</html>