<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Traffic System | Log in</title>
    <style>
        html {
            width: 100%;
            height: 100%;
            font-style: serif;
        }

        body { 
            background-image: url("../back.jpeg");
            background-size: cover;
        }

        #login {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -200px 0 0 -200px;
            width: 400px;
            height: 400px;
            /* background-color: green; */
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

        button {
            width: 150px;
            margin: 10px 125px 10px 125px; 
            border-radius: 8px;
            font-size: 15px;

        }
        button:hover{
            color: #993300;
            text-decoration: none;
        }

        button:active{
            color: #ff0033;
            text-decoration: none;

        }
        h1 {
            text-align: center;
        }
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
            $ret = $_GET["msg"];
            echo "<p style=\"color:red\">$ret</p>"  ;
            ?>
            <button type="submit" name="submit">LOGIN</button>
        </form>
    </div>

</body>

</html>