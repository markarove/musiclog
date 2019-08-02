<?php 
session_start();

if(!isset($_SESSION['UserID'])){
    header("location: index.php?works");
    
}
else{
    include 'include/dbConnection.php';
    //Check if user has a directory file created
    $userID = $_SESSION['UserID'];
    if(!file_exists("include/uploads/$userID")){
        mkdir("include/uploads/$userID/");
    }
?>
<!DOCTYPE html>
<html>
<head>
<link href="css/mainStyle.css" rel="stylesheet" type="text/css" />   
<link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<title>Musiclog</title>
</head>
<body>
<div id="header">
    <div id="logo">
       <a href="main.php">MusicLog</a>
    </div>
    <div id="play2"></div>
    <div class="indexAction"><button class="button button2" onclick="openMenu()">
        <span>Profile</span>
    </button>
    <div id="menuContent" class="mContent" style="display:none;">
        <a href=""><span class="sContent"><a href="include/logout.php">Logout</a></span></a>
    </div>
    </div>
</div>
    <div id="navBar">
    <div id="buttons">
        <button class="button button1" onclick="openUpload()">
            <span class="but1">Add Song</span>
        </button><br/>
        <button class="button button1" onclick="openPlaylistAdd()">
            <span class="but1">Create Playlist</span>
        </button>
    </div>
    <div id="addPlaylistBox" style="display:none;">        
            <form method="post" action="include/createPlaylist.php">
                <input type="text" name="p_name" placeholder="Playlist Name" /><br/>
                <input type="submit" value="Create Playlist" name="create_playlist" />
            </form>
        </div>
    <div id="playlists_navBar">
        <span class="PlayTitle2"><strong>Playlists</strong></span><br/>
        <br/>
        <div class="PlayTitle"><?php require 'include/getAllPlaylists.php'; ?></div>
    </div>
    </div>
    <div id="content" style="text-align: center; vertical-align: middle;"><!-- CONTENT-----------------------CONTENT-->
    <div id="addMusic" style="display:none;">
       <div id="actionAddMusic"> 
           <span>Select a song to be uploaded</span>
            <br/>
            <br/>
            <form action="include/upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="audioFile"  value="Select File" required/><br />
                <input type="text" name="title" placeholder="Title" required/><br/>
                <input type="text" name="artist" placeholder="Artist" required /><br/>
               <!-- <input type="text" name="album" placeholder="Album" /><br/>
                <input type="text" name="year" placeholder="Year of Release" /><br/>-->
                <input type="submit" value="Upload Song" name="save_audio" />
            </form>
        </div>
            <div id="uploadClose"><span class="uploadCloseSpan" onclick="openUpload()" >close</span></div>
        </div>
    <div id="mainScreen" >
        <ol id="songList" style="width:100%;">
            <div id="showMusic" style="color:black;">
                <?php require 'include/getAllMusic.php'; ?>
                
            </div>
            
        </ol>
    </div>
    </div><!-- END CONTENT----------------------- END CONTENT-->
<div id="player" style="text-align: center;">
    <audio src="" controls="controls" id="audioPlayer" style="margin-top:10px;">
        Sorry, Your browser does not support HTML5
    </audio>
</div>
    
<!-- JavaScript-->
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script>

function openMenu(){
    var x = document.getElementById("menuContent");
    if(x.style.display == "none"){
        x.style.display = "block";
    }else{
        x.style.display ="none";
    }
}
    
//Function to Open Upload Div
function openUpload(){
    var x = document.getElementById("addMusic");
    var y = document.getElementById("mainScreen");
    var i = document.getElementById("player");
    var show = document.getElementById("showMusic");
    if(x.style.display == "none"){
        x.style.display = "block";
        y.style.height = "50vh";        
        i.style.marginTop = "75vh";        
    }else{
        x.style.display ="none";
        y.style.height = "83vh";
    }
};
//Function to Open add playlist Div
function openPlaylistAdd(){
    var x = document.getElementById("addPlaylistBox");
    var y = document.getElementById("playlists_navBar");
    if(x.style.display == "none"){
        x.style.display = "block";
        y.style.height = "60vh";
    }else{
        x.style.display ="none";
        y.style.height = "62vh";
    }
};
    

$(document).ready(function(){
    //Function to Open Menu
//AJAX GET PLAYLISTS RESULTS 
   $("a.playlist_result").on("click", function(e){
       e.preventDefault();
       var url = $(this).attr('href');
       $("#showMusic").load(url);
       audioPlayer();
   });

    
// AJAX ADD TO PLAYLIST

    $("a.addSongPlay").on("click",function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    $(".addToPlaylist").load(url);
    });   


      
//Audio Player Song Select/Controller    
    audioPlayer();
    function audioPlayer(){
        var currentSong = 0;
        //On click, play this song
        $("#songList").on("click", "li a",(function(e){
            e.preventDefault();
            $("#songList li").removeClass("current-song");
                currentSong = $("#songList li").parent().index();
                $(this).parent().addClass("current-song");
            $("#audioPlayer")[0].src = this;
            $("#audioPlayer")[0].play();
            
        }));
        //Play next song, after first one is over
        $("#audioPlayer")[0].addEventListener("ended", function(){
            $("#songList li:eq("+currentSong+")").removeClass("current-song");
                currentSong++;
            if(currentSong == $("#songList li a").length)
                currentSong = 0;
            $("#songList li").removeClass("current-song");
            $("#songList li:eq("+currentSong+")").addClass("current-song");
            $("#audioPlayer")[0].src = $("#songList li a")[currentSong].href;
            $("#audioPlayer")[0].play();        
        })
    };//END AudiO Player Selector 
    
});

</script>
</body>
</html>
<?php
    }
?>