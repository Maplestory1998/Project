<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search People</title>
        <link rel="stylesheet" type="text/css" href="../css/searchpeople">
    </head>
    <form name="getPeopleByName" method="post" action="getPeopleaction.php">
        <label for "name">Please input name</label>
        <input type="text" name="name">
        <button type="submit" name="submitByName">Submit</button>
    </form>
    <br>
    <form name="getPeopleByLic"  method="post" action="getPeopleaction">
        <label for "licence">Please input Licence Number</label>
        <input type="text" name="licence">
        <button type="submit" name="submitByLic">Submit</button>
    </form>
</html>