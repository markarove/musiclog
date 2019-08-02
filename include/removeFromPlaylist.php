<?php
    require 'dbConnection.php';
    $userID = $_GET["userID"];
    $playlistID = $_GET["playlistID"];
    $musicID = $_GET["musicID"];
    
    if(!conn){
        echo "Sorry the server is down";
    }else{
        $sql ="DELETE FROM entries WHERE user_id=$userID AND playlist_id=$playlistID AND music_id=$musicID";
        $delete = $conn->query($sql);
        header("location: ../main.php?deleteSucess");
    }
    
?>