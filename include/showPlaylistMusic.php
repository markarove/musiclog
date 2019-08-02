<?php
    require 'dbConnection.php';
    $userID = $_GET["userID"];
    $playlistID = $_GET["playlistID"];
    $playlistName = $_GET["playlistName"];

if(!$conn){
    echo "Server is down";
}else{
    $sql = "SELECT * FROM entries AS PE
            INNER JOIN Playlist AS P ON P.playlist_id = PE.playlist_id
            INNER JOIN mp3music AS M ON PE.music_id = M.music_id
            WHERE P.user_id=$userID AND P.playlist_id=$playlistID";
    
    $results = $conn->query($sql);
    $getNumber = mysqli_num_rows($results);
    echo "
                <style>               
                #songList{
                    list-style: none;
                }
                #songList li a{
                    color:white;
                    text-decoration: none;
                }
                #songList li a:hover{
                    text-decoration: none;
                    color:orange;
                    border-bottom:1px solid orange;
                }
                #songList .current-song a{
                    color:orange;
                }
                
                .songA{
                    color:white;
                }
                .songA:hover{
                    color:orange;
                }
                
                .addSongPlay{
                    color:white;
                }
                .addSongPlay:hover{
                    color:orange;
                }
                
                .trackBox{
                    margin-top:3vh;
                    width:55%;
                    height:60vh;
                    max-height:500px;
                    margin-left:25%;
                    overflow:auto;
                    scrollbar-width:none;
                }
                     
                .playlistInfo{
                    width:40%;
                    height:13vh;
                    background-color:#404040;
                    padding-top:7px;
                    margin-left:33%;
                }
                
                .playlistTrack{
                width:100%;
                height:3vh;
                margin-top:5px;
                padding-top: 10px;
                background-color:#404040;
                color:white;
                font-size:20px;
                }
                
                .trackPlay{
                    width:20%;
                    min-width:50px;
                    height:3vh;
                    cursor:pointer;
                }
                .playlistTrackContent{
                    width:30%;
                    min-width:500px;
                    height:3vh;
                    float:left;
                    text:center;
                }

                .playlistTrackMenu{
                width:25%;
                min-width:275px;
                height:3vh;
                float:right;
                }
                
                
                .playlistTitle{
                    margin-top:20px;
                }
                .playlistTitle span{
                    color:white;
                    font-size:30px;
                }
                
                .numOfSongs{
                    margin-top:25px;
                }
                
                .numOfSongs span{
                    color:white;
                    font-size:20px;
                }
                
                .addToPlaylist{               
                    width:auto;
                    height:auto;
                }
                
                .addToPlaylist select{
                    width:200px;
                    padding-top:10px;
                    background-color:#404040;
                    border:none;
                    color:white;
                    font-size:20px;
                }
                
                .addToPlaylist option{
                    font-size:20px;
                }
                
                .deleteBox {
                width:100px;
                height:30px;
                float:right;
                }
                .deleteBox a {
                    color:white;
                    text-decoration:none;
                }
                .deleteBox a:hover {
                    color:orange;
                    text-decoration:none;
                    border-bottom:1px solid orange;
                }
                
                </style>";
        echo "<div class=\"playlistInfo\">
            <div class=\"playlistTitle\"><span><strong>".$playlistName."</strong></span></div>
            <div class=\"numOfSongs\"><span>".$getNumber." songs</span></div>
        </div>";
        echo "<div class=\"trackBox\">"; 
    if($results -> num_rows > 0){
        while($row = $results->fetch_assoc()){
        $songName = $row["title"];
        $songArtist = $row["artist"];
        $songId = $row["music_id"];
        $songPath = $row["file_renamed"];
        $songLink = "include/uploads/$userID/$songPath";
        
        echo "<div class=\"playlistTrack\"> 
        <!--<div class=\"trackPlay\">PLAY</div>-->
        <div class=\"playlistTrackContent\">
            <li class=\"\"><a href=\"$songLink\">$songName by $songArtist</a></li>
        </div>
        <div class=\"playlistTrackMenu\">
        <a class=\"songA\" href=\"include/removeFromPlaylist.php?userID=$userID&playlistID=$playlistID&musicID=$songId\">Remove From Playlist</a> 
        </div>
        </div>
        "; 
        }
    echo "</div>
    <div class=\"deleteBox\"><a class=\"deletePLa\" href=\"include/deletePlaylist.php?playlistID=$playlistID&userID=$userID\">Delete Playlist</a></div>
    ";
    
    }else{
        echo "<style>
                .trackBox{
                    margin-top:3vh;
                }
                  #allSongs a{
                        text-decoration:none;
                        font-size:20px;
                        color:white;
                        border-bottom:1px solid white;
                    }
                    
                    #allSongs a:hover{
                        text-decoration:none;
                        color:orange;
                        border-bottom:1px solid orange;
                    }
                
                </style>";
        echo "<div class=\"trackBox\">
        <span style=\"color:white;\">You don't have any songs in this playlist.</span>
        <br/>
        <br/>
        <div id=\"allSongs\"><span style=\"color:white;\">Select a song from  <a class=\"playlist_result\" href=\"include/getAllMusicBack.php?userId=$userID\">Your Library</a> to add to this playlist</span>
        </div>";
        echo "<script>
        $(document).ready(function(){
         $(\"a.playlist_result\").on(\"click\", function(e){
       e.preventDefault();
       var url = $(this).attr('href');
       $(\"#showMusic\").load(url);
        audioPlayer();
        });

        });
        </script>";
    }
}
?>