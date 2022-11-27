<?php

include("connect.php");

if(isset($_POST['login']))

{

$mobile   =	      mysqli_real_escape_string($connect,$_POST['mobile']);
$password =  mysqli_real_escape_string($connect,$_POST['password']);
$role     =   $_POST['role'];

$sql = "SELECT * FROM `user` WHERE mobile = $mobile AND password = '$password'";

$check= mysqli_query($connect,$sql);

//if($check){echo mysqli_num_rows($check);}


If(mysqli_num_rows($check)>0){



    $userdata=mysqli_fetch_array($check);
    
    $groups=mysqli_query($connect,"SELECT * FROM user WHERE role=2");

    $groupsdata=mysqli_fetch_all($groups,MYSQLI_ASSOC);
    session_start();
    $_SESSION['userdata']=$userdata;
    $_SESSION['groupsdata']=$groupsdata;

    echo '<script>
    window.location="../routes/dashboard.php";
    </script>';
}

else{
    echo'<script>
    alert("Invalid Credentails or User not found!");
    window.location="../";
    </script>';
}
}

?>