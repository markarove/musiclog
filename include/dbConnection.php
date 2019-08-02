<?php
//Database connection
    $servername="localhost";
    $dBUsername="root";
    $dBPassword="";
    $dBName="musiclog";
    
    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
    
    //Check connection
    if(!$conn){
        die("Connection Failed: ".mysqli_connect_error());
    }
    else{
        //do nothing
    }
?>