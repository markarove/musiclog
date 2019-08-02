<?php
require 'dbConnection.php';
$userId = $_GET["userId"];
if(!$conn){
    echo"<br /> Database Not Connected";
}else{
    $sql = "select * from mp3music where user_id=$userId";
    $result = $conn->query($sql);
    $getNumber = mysqli_num_rows($result);
    if($result->num_rows > 0){
        //output Data of each row
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
                    height:50vh;
                    max-height:500px;
                    margin-left:25%;
                    overflow:auto;
                    scrollbar-width:none;
                }
                     
                .playlistInfo{
                    width:40%;
                    height:13vh;
                    background-color: 	#404040;
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
                    background-color: 	#404040;
                    border:none;
                    color:white;
                    font-size:20px;
                }
                
                .addToPlaylist option{
                    font-size:20px;
                }
                
                </style>";
        echo "<div class=\"playlistInfo\">
            <div class=\"playlistTitle\"><span><strong>Your Library</strong></span></div>
            <div class=\"numOfSongs\"><span>".$getNumber." songs</span></div>
        </div>";
        echo "<div class=\"addToPlaylist\"></div>";
        echo "<div class=\"trackBox\">"; 
        while($row = $result->fetch_assoc()){
            $MusicPath = $row["file_renamed"];
            $musicID = $row["music_id"];
            $title = $row["title"];
            $artist = $row["artist"];
            $songLink = "include/uploads/$userId/$MusicPath";
           echo "
            <div class=\"playlistTrack\">
                <div class=\"playlistTrackContent\">
                    <li class=\"\"><a href=\"$songLink\">$title by $artist</a></li>
                </div>
                <div class=\"playlistTrackMenu\">
                    <a class=\"addSongPlay\" href=\"include/addToPlaylist.php?userID=$userId&musicID=$musicID\">Add to Playlist<a/> ||
                    <a class=\"songA\" href=\"include/deleteSong.php?userID=$userId&musicID=$musicID&musicPath=$MusicPath\">Delete Song</a>
                </div>
            </div>    
            ";// END ECHO
          }
        echo "<script>
        $(document).ready(function(){
        $(\"a.addSongPlay\").on(\"click\",function(e){
        e.preventDefault();
            var url = $(this).attr('href');
            $(\".addToPlaylist\").load(url);
            });
        });
</script></div>";
    }else{
        echo "<span style=\"color:white;\">You haven't added a song yet :( </span> <br/><br/>";
        echo "
        <style>
            .noMusicA{
                border-bottom:1px solid white;
                cursor: pointer;
                color:white;
            }
            .noMusicA:hover{
                border-bottom:1px solid orange;
                cursor: pointer;
                color:orange;
            }
             .trackBox{
                    margin-top:3vh;
                }
        </style>
        <a class=\"noMusicA\" onclick=\"openUpload()\">Click here to upload one!</a> 
        ";
        
    }
}
?>