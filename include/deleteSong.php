<?php
require 'dbConnection.php';
$userID= $_GET["userID"];
$musicID= $_GET["musicID"];
$musicPath = $_GET["musicPath"];
$musicPathi = "uploads/$userID/$musicPath";
    if(!$conn){
        echo "server is down";
    }else{
        $entries ="SELECT * FROM entries WHERE music_id=$musicID AND user_id=$userID";
        $checkEntries = $conn->query($entries);
        if($checkEntries -> num_rows > 0){
            $deleteEntries = "DELETE FROM entries WHERE music_id=$musicID AND user_id=$userID";
            $delActionEntries = $conn->query($deleteEntries);
            echo "<br /> Results obtained in Entries <br />";
            
            if($delActionEntries == true){
                $sql ="DELETE FROM mp3music WHERE user_id=$userID and music_id=$musicID";
                $delete = $conn->query($sql);
                unlink($musicPathi);
                header("location: ../main.php?deletesuccess");
            }
            else{
                echo "Entrie Found but Song wasn't deleted";
                header("location: ../main.php?EntrieFoundSongNOTDeleted");
            }
       
        }else{
                $sql ="DELETE FROM mp3music WHERE user_id=$userID and music_id=$musicID";
                $delete = $conn->query($sql);
                unlink($musicPathi);
                header("location: ../main.php?deletesuccess");
            }
        
    }
?>