<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .left-nav{
            width:400px;
            height:700px;
            padding:10px 0px;
            background-color: grey;
            margin: 50px 10px;
        }

        .left-nav .features{
            height: 45px;
            line-height: 45px;
            margin: 30px ;
            padding-left:18px;
        }

        .features:hover{
            background-color: #d9d9d9;
        }

        .features a{
            font-size: 32px;
            color:#333;
            text-decoration:  none;
        }

        .features a:hover{
            color:#c81623;
        }
    </style>
</head>

<body>
    <div class="left-nav">
        <div class="features">
            <a href="changePsw.php">Change Password</a>
        </div>
        <div class="features">
            <a href="lookUpPeople.php">Look up People</a>
        </div>
        <div class="features">
            <a href="lookUpVehicle.php">Look up Vehicle</a>
        </div>
        <div class="features">
            <a href="addCars.php">Add Cars</a>
        </div>
        <div class="features">
            <a href="fileReport.php">File Report</a>
        </div>
        <div class="features">
            <a href="createAccount.php">Create Accounts</a>
        </div>
        <div class="features">
            <a href="addFines.php">Add Fines</a>
        </div>
    </div>

</body>

</html>