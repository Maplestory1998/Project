<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Look up People</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="getQueryResult.js" type="text/javascript"></script>
    <style>
        #menu2 {
            background-color: rgb(0, 71, 153);
        }

        .divForm {
            border-bottom-style: solid;
            border-bottom-color: rgb(239, 239, 239);
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
    <div class="divForm">
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
    </div>
    <script>
        var content = getQueryVariable("msg");
        if(content == "1")
        {
            alert("The person is not in the system.");
        }
    </script>
</html>


</body>

</html>