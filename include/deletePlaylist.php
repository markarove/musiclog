<?php
require 'dbConnection.php';
$userID= $_GET["userID"];
$playlistID= $_GET["playlistID"];
    if(!$conn){
        echo "server is down";
    }else{
        $entries ="SELECT * FROM entries WHERE playlist_id=$playlistID AND user_id=$userID";
        $checkEntries = $conn->query($entries);
        if($checkEntries -> num_rows > 0){
            $deleteEntries = "DELETE FROM entries WHERE playlist_id=$playlistID AND user_id=$userID";
            $delActionEntries = $conn->query($deleteEntries);
            echo "<br /> Results obtained in Entries <br />";
            if($delActionEntries == true){
                $sql ="DELETE FROM playlist WHERE user_id=$userID and playlist_id=$playlistID";
                $delete = $conn->query($sql);
                header("location: ../main.php?deletesuccess");
            }
        }else{
            echo "<br /> No results in Entries <br />";
            $sql ="DELETE FROM playlist WHERE user_id=$userID and playlist_id=$playlistID";
            $delete = $conn->query($sql);
            header("location: ../main.php?deletesuccess");
        }
                   
    }
?>