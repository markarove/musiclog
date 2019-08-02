<?php
require 'dbConnection.php';
$userId = $_SESSION['UserID'];
if(!$conn){
    echo"<br /> Database Not Connected";
}else{
    $sql = "select * from playlist where user_id=$userId";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        //output Data of each row
        echo "<style>
                    .playlistBox a{
                        text-decoration:none;
                        font-size:20px;
                        color:white;
                    }
                   .playlistBox a:hover{
                        text-decoration:none;
                        border-bottom:1px solid white;
                    }
                    p.playlistout{
                        margin:5;
                        color:white
                    }
                    
                    .playlistBox{
                        width:100%;
                        height:2vh;
                        margin-top:15px;
                    }
                    
                    
                    #allSongs a{
                        text-decoration:none;
                        font-size:20px;
                        color:white;
                    }
                    
                    #allSongs a:hover{
                        text-decoration:none;
                        color:white;
                        border-bottom:1px solid white;
                    }
                    
                </style>";
        echo "<div id=\"allSongs\"><a class=\"playlist_result\" href=\"include/getAllMusicBack.php?userId=$userId\">Your Library</a></div> ";
        while($row = $result->fetch_assoc()){
            $playlistId = $row["playlist_id"];
            $playlistName = $row["playlist_name"];
            echo"                        
                 <div class=\"playlistBox\"> 
                    <p class=\"playlistout\">
                    <a class=\"playlist_result\" href=\"include/showPlaylistMusic.php?userID=$userId&playlistID=$playlistId&playlistName=$playlistName\"
                    >$playlistName</a>
                    </p>
                </div>
            ";
          }
    }else{
        echo "You haven't created a playlist";
    }
}

?>

