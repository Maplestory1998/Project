
<?php
session_start();
ob_start();
$msg = "";
if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
    $msg = "Please log in!";
    header("Location: login.php?msg=$msg");
}
include_once('conn.php');

if (isset($_POST["Add"])) {
    $reportDesc = $_POST["reportDesc"];
    $time = $_POST["time"];
    $VehicleLic = $_POST["VehicleLic"];
    $PeopleLic = $_POST["PeopleLic"];
    $OffenceID = $_POST["OffenceDescr"];


    $sql_query1 = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$VehicleLic';";
    $res_query1 = mysqli_query($conn, $sql_query1);
    $num1 = mysqli_num_rows($res_query1);

    $sql_query2 = "SELECT People_ID FROM People WHERE People_licence = '$PeopleLic';";
    $res_query2 = mysqli_query($conn, $sql_query2);
    $num2 = mysqli_num_rows($res_query2);

    $VID = mysqli_fetch_assoc($res_query1)["Vehicle_ID"];
    $PID = mysqli_fetch_assoc($res_query2)["People_ID"];

    // Both Person and Vehicle exist
    if ($num1 > 0 && $num2 > 0) {

        $sql1 = "INSERT INTO Incident(Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID) VALUES('$VID', '$PID', '$time', '$reportDesc', '$OffenceID');";
   
        if (mysqli_query($conn, $sql1)) {
            // successful
            $msg = "0";
        } else $msg = "-2";
        header("Location: fileReport.php?msg=$msg");
    } else {
        if (!$num1 && !$num2) $msg = "1";   //lack Person and Vehicle Info
        else if (!$num1) $msg = "2";               //lack Vehicle Info
        else if (!$num2) $msg = "3";              //lack People Info

        header("Location: fileReportAction2.php?msg=$msg&VehicleLic=$VehicleLic&PeopleLic=$PeopleLic&time=$time&reportDesc=$reportDesc&OffenceID=$OffenceID");
    }
}
ob_end_flush();
?>


