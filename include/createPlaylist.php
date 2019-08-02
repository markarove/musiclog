<?php
session_start();
if(!isset($_SESSION['UserID'])){
    echo "hi there non-logged in user o/";
}else{
    require 'dbConnection.php';
    $userIdVar = $_SESSION['UserID'];
    $playlistName = $_POST['p_name'];
    
    //Start verifications
    
    //Check Database Connection
    if(!$conn){
    echo "Sorry, the server is down!";
    }else{
        //Check if field is empty
        if(empty($playlistName)){
            echo "Please enter a name for your new playlist";
        }else{
            $sql = "INSERT INTO playlist (playlist_name, user_id) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "Something when wrong with the SQL";
            }else{
                mysqli_stmt_bind_param($stmt, "ss", $playlistName, $userIdVar);
                mysqli_stmt_execute($stmt);
                echo "Playlist Created!";
                header ("location: ../main.php");
            }
        }
        
    }
        
}

?>