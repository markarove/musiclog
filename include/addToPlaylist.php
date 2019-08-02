<?php
    require 'dbConnection.php';
    $userID = $_GET["userID"];
    $musicID= $_GET["musicID"];

if(!$conn){
    echo "Sorry Database not connected";
}else{
        
        $sql = "select * from playlist where user_id=$userID";
        $result = $conn->query($sql);    
        if($result->num_rows > 0){
        //output Data of each row
        echo "  
        <style>
            .addPlayBox{
                width:250px;
                height:50px;
                margin-top:15px;
                margin-left:45%;
                position:relative;
            }
            
            .addPlayBox select{
                font-size:15px;
            }
        </style>
        <div class=\"addPlayBox\">
        <form id=\"addPlayForm\" action=\"include/addToPlaylistAction.php\" method=\"POST\">
        <select name=\"playlistID\" onchange=\"this.form.submit()\">
        <option value=\"\">Select a Playlist</option>        
        ";
        while($row = $result->fetch_assoc()){
            $playlist_name = $row['playlist_name'];
            $playlist_id = $row['playlist_id'];
            echo "<option value=\"$playlist_id\">$playlist_name</option>"; 
        }
        echo "
            <input type=\"hidden\" value=\"$userID\" name=\"userID\" />
            <input type=\"hidden\" value=\"$musicID\" name=\"musicID\" />
            <noscript><input type=\"submit\" value=\"Add To Playlist\"/></noscript>
            </select>
            </form>
            </div>";   
    }else{
        echo "<span style=\"color:white;\">You need to create a playlist first.<span>";
    }
}
    
?>