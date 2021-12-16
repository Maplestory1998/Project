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
            height:1000px;
            padding:10px 0px;
            background-color: rgb(19,27,38);
            color: white;
            /* margin: 50px 10px; */
            float: left;    
        }

        .left-nav .features{
            height: 45px;
            line-height: 45px;
            padding-left: 40px ;
            padding-top: 30px;
            padding-bottom: 30px;    
        }

        .features:hover{
            background-color: rgb(0,71,153);
        }

        .features a{
            font-size: 30px;
            color: white;
            text-decoration:  none;
        }

        .features a:hover{
            color: #993300;
        }

        .feature a:active{
            color: #ff0033;
            text-decoration: none;  
        }
    </style>
</head>

<body>
    <div class="left-nav">
        <div class="features" id="menu1">
            <a href="changePsw.php">Change Password</a>
        </div>
        <div class="features" id="menu2">
            <a href="lookUpPeople.php">Look up People</a>
        </div>
        <div class="features" id="menu3">
            <a href="lookUpVehicle.php">Look up Vehicle</a>
        </div>
        <div class="features" id="menu4">
            <a href="addCars.php">Add Cars</a>
        </div>
        <div class="features" id="menu5">
            <a href="fileReport.php">File Report</a>
        </div>
        <div class="features" id="menu6">
            <a href="createAccount.php">Create Accounts (Admin)</a>
        </div>
        <div class="features" id="menu7">
            <a href="addFines.php">Add Fines (Admin)</a>
        </div>
    </div>

</body>

</html>