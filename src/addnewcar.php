<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Car</title>
        <link rel="stylesheet" tyoe="text/css" href="../css/addnewcar.css">
    </head>
    <form name="findowner" method="post">
        <label for "owner">Please input the new car's owner</label>
        <input type="text" name="owner" placeholder="owner name"><br>
        <button type="submit" name="findOwnerExist">Submit</button>
    </form>
    <form name="addNewCar" method="post" action="addNewCaraction.php">
        <label for "vLic">Please input Vehicle Licence</label>
        <input type="text" name="vLic" placeholder="Vehicle Licence"><br>
        <label for "make">Please input make</label>
        <input type="text" name="make" placeholder="make"><br>
        <label for "model">Please input model</label>
        <input type="text" name="model" placeholder="model"><br>
        <label for "color">Please input color</label>
        <input type="text" name="color" placeholder="color"><br>
        <label for "owner">Please input owner name</label>
        <input type="text" name="owner" placeholder="owner name"><br>
        <button type="submit" name="addcarinfo">Add Car</button>
    </form>

    <?php
        if(isset($_POST['findOwnerExist']))
        {
            $new_owner = $_POST['owner']; 
            $sql1 = "SELECT People_ID FROM people WHERE People_name = '$new_owner';";
        }
    ?>

</html>