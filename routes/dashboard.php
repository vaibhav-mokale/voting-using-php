<?php
include("../api/connect.php");
session_start();
error_reporting(0);
if (!isset($_SESSION['userdata'])) {
    header("location:../");
}

$userdata = $_SESSION['userdata'];
$voted = $_SESSION['userdata']['status'];

if ($voted == 0) {
    $status = '<b style ="color:red">Notvoted</b>';
} else {
    $status = '<b style ="color:green">Voted</b>';
}

?>




<html>

<head>
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <style>
        #backbtn {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: left;
            margin: 10px;
        }

        #logoutbtn {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: right;
            margin: 10px;
        }

        #headerSection {

            width: 100%;
            padding: 5px;

        }

        #Profile {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group {
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
        }

        #votebtn {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
        }

        #mainpanel {
            padding: 10px;
        }

        #voted {
            padding: 5px;
            font-size: 15px;
            background-color: green;
            color: white;
            border-radius: 5px;

        }
    </style>
    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="../"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>



        <div id="mainpanel">
            <div id="Profile">
                <center><img src=" ../uploads/<?php echo $userdata['photo']  ?>" height="100" width="100"></center><br><br>
                <b>Name:</b><?php echo $userdata['name'] ?><br><br>
                <b>Mobile:</b><?php echo $userdata['mobile'] ?><br><br>
                <b>Address:</b><?php echo $userdata['address'] ?><br><br>
                <b>Status:</b><?php echo $status ?><br><br>
            </div>


</body>

<div id="Group">
    <?php

    $sql = "SELECT * FROM user WHERE role = 2";

    $run = mysqli_query($connect, $sql);

    $voted = $_SESSION['userdata']['status'];

    while ($data = mysqli_fetch_assoc($run)) {
        if ($voted == 0) {
            $status = "active";
        } else {
            $status = "hidden";
        }
        $photo = "../uploads/" . $data['photo'] . " ";
        echo '
                        <div class="group_div">
                            <img style="float:right" src="' . $photo . '" height="100" width="100">
                                <b>Group Name:</b>' . $data['name'] . '<br><br>
                                <b>Votes:</b>' . $data['vote'] . '<br><br>
                                <form action="../api/vote.php" method="Post">
                                <input type="hidden" name="gvotes" value="' . $data['vote'] . '">
                                <input type="hidden" name="gid" value="' . $data['id'] . '">

                                <input type="submit" name="votebtn" class="' . $status . '" value="Vote" id="voted">
                            </form>
                            <br>
                            <hr>
                        </div>';
    }
    ?>


</div>
<style>
    .hidden {
        display: none;
    }

    .group_div {
        margin: 20px auto !important;
        padding: 10px;
        text-align: left;
    }
</style>

</html>