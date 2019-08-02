<?php
session_start();
if(!isset($_SESSION['UserID'])){
    echo "hi non-logged in user o/";
}else{
    //Include Database Connection
    require 'dbConnection.php';
   
    $userIdVar = $_SESSION['UserID']; 
    
//Start verifications

// Check Database Connection
if(!$conn){
    echo "Sorry, the server is down!";
}else{
    //echo "Database Connected <br />";
//Check if it followed from the upload button 
if(isset($_POST['save_audio']) && $_POST['save_audio']=='Upload Song'){ 
 //Check if there is a file selected
    if(!empty($_FILES["audioFile"])){
    //Check if file is audio type
    if(strpos($_FILES["audioFile"]["type"], "audio")!==false){
 
            $temp = explode(".", $_FILES["audioFile"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($_FILES["audioFile"]["tmp_name"], "uploads/$userIdVar/" . $newfilename);
            
            
           //Update Database
                $title = $_POST['title'];
                $artist = $_POST['artist'];
                $album = $_POST['album'];
                $year = $_POST['year'];
                $query = "INSERT INTO mp3music (title, artist, album, year, user_id,music_file, file_renamed) values ('$title' ,'$artist' ,'$album' , '$year', '$userIdVar','$newfilename', '$newfilename')";
                mysqli_query($conn, $query);

                if(mysqli_affected_rows($conn)>0){
                    echo "<br />";
                    echo "audio file uploaded to the database";
                    header ("location: ../main.php?uploadOk");
                }else{
                    echo "<br /> Audio file NOT uploaded to the database";
                }         
        
    }else{
        echo "Please select only an mp3 file type!";
    //Echo File type Check
    }       
    }else{
        echo "Please select a file";
    // END File Existance Check
    }   
 
}else{
    echo "hey hey no cheating!";
}
    
//End Database Connection Checl
}

//End User Login Check
}
?>