<?php
require 'dbConnection.php';
$userID = $_POST["userID"];
$playlistID = $_POST["playlistID"];
$musicID = $_POST["musicID"];
    
if(!$conn){
    echo "<br /> Sorry the server is down";
}else{
    $sql = "INSERT INTO entries (music_id, playlist_id, user_id) VALUES ($musicID, $playlistID, $userID)";
    mysqli_query($conn, $sql);
    header ("location: ../main.php");
}
?>