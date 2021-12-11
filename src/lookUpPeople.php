<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Look up People</title>
    <style>
        #lookUpPeopleForm {
            background-color: red;
            width: 1000px;
            height: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            padding: 50px;
        }

        #lookUpPeopleForm p {
            font-size: 30px;
        }

        .form {
            background-color: green;
            margin: 100px auto 100px auto;

            width: 600px;
            /* text-align:center; */
            padding-left: 100px;

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

    <div id="lookUpPeopleForm">
        <p>Use the form below to Look up people</p>
        <form name="getPeopleByName" class="form" method="post" action="lookUpPeopleAction.php">
            <label for "name">Please input name</label><br>
            <input type="text" name="name"><br>
            <button type="submit" name="submitByName">Submit</button>
        </form>
        <br>
        <form name="getPeopleByLic" class="form" method="post" action="lookUpPeopleAction.php">
            <label for "licence">Please input Licence Number</label><br>
            <input type="text" name="licence"><br>
            <button type="submit" name="submitByLic">Submit</button>
        </form>
    </div>

</html>


</body>

</html>