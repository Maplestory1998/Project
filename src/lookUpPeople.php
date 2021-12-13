<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Look up People</title>
    <style>
        * {
            font-style: serif;
            font-size: 30px;
        }

        .sentence {
            font-size: 30px;
            color: white;
            height: 70px;
            width: 100%;
            line-height: 70px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;

            background-color: rgb(19, 27, 38);
        }

        .choice {
            /* background-color: red; */
            width: 80%;
            height: 400px;
            padding: 50px;
            padding-left:100px;
        }

        .form {
            /* background-color: green; */
            margin: 100px auto 100px auto;
            background-color: white;

            width: 600px;
            padding-left: 100px;

        }

        input {
            width: 600px;
            padding: 12px 20px;
            margin: 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 300px;
            margin: 10px 150px 10px 150px; 
            border-radius: 16px;
            font-size: 30px;
        }

        button:hover{
            color: #993300;
            text-decoration: none;
        }

        button:active{
            color: #ff0033;
            text-decoration: none;

        }

        #menu2 {
            background-color: rgb(0, 71, 153);
        }
    </style>

</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
        $msg = "Please log in!";
        header("Location: login.php?msg=$msg");
    }
    include_once("header.php");
    include_once("left-nav.php");
    ?>
    <div class="sentence">Use the form below to Look up people</div>
    <div class="choice">
        <form name="getPeopleByName" class="form" method="post" action="lookUpPeopleAction.php">
            <label for "name">Look up people by name:</label><br>
            <input type="text" name="name" required placeholder="name"><br>
            <button type="submit" name="submitByName">Look up</button>
        </form>
    </div>
    <div class="choice">
        <form name="getPeopleByLic" class="form" method="post" action="lookUpPeopleAction.php">
            <label for "licence">Lookup people by licence:</label><br>
            <input type="text" name="licence" required placeholder="licence"><br>
            <button type="submit" name="submitByLic">Look up</button>
        </form>
    </div>

</html>


</body>

</html>