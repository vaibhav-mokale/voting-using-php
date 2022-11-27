<?php
$connect = mysqli_connect("localhost","root","","voting")or die("Connection failed");

 if($connect){
    echo "  ";
}
else{
    echo "Not connected!";
} 
