<?php
    $msg = "";
    $conn = $_SESSION['coon'];

    if(isset($_POST['addcarinfo']))
    {
        $vLic = $_POST['vLic'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $color = $_POST['color'];
        $owner = $_POST['owner']; 
        $sql1 = "SELECT People_ID FROM people WHERE People_name = '$owner';";
        $result1 = mysqli_query($conn, $sql1);

        //owner exists
        if(mysqli_num_rows($result1) > 0)
        {
            $peopleID = mysqli_fetch_assoc($result1)['People_ID'];
            $sql2 = "INSERT INTO vehicles (Vehicle_make, Vehicle_type, Vehicle_colour, Vehicle_licence)
                    VALUES('$make', '$model', '$color', '$vLic');";
            $result2 = mysqli_query($conn, $sql2);

            $sql3 = "SELECT Vehicle_ID FROM vehicle WHERE Vehicle_licence = '$vLic';";
            $result3 = mysqli_query($conn, $sql3);
            $vID = mysqli_fetch_assoc($result3)['Vehicle_ID'];
            
            $sql4 = "INSERT INTO ownership (People_ID, Vehicle_ID) VALUES('$peopleID', '$vID');";
            mysqli_query($conn, $sql4);
        }
        else
        {
            $sql5 = "INSERT INTO vehicles (Vehicle_make, Vehicle_type, Vehicle_colour, Vehicle_licence)
                    VALUES('$make', '$model', '$color', '$vLic');";
            $result5 = mysqli_query($conn, $sql5);

            $sql6 = "SELECT Vehicle_ID FROM vehicle WHERE Vehicle_licence = '$vLic';";
            $result6 = mysqli_query($conn, $sql6);
            $vID = mysqli_fetch_assoc($result6)['Vehicle_ID'];

            $sql7 = "INSERT"


        }

    }

?>