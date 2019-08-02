<?php
// Check if the user followed up the correct path to this page
    require "dbConnection.php";
    
    $un = $_GET['username'];
    $pw = $_GET['password'];
    
    if(empty($un) || empty($pw)){
        echo "Please insert an username and a password";
    }
    else{
        //Get the password that matches the inputted username and then check if it matchs the password input
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //check if the statement gets an error
            echo "Oh no! The error happened! What now?";
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $un);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($results)){
                $pwdCheck = password_verify($pw, $row['password']);
                if($pwdCheck == false){
                    echo "Wrong Password";
                }
                elseif($pwdCheck == true) {
                    session_start();
                    $_SESSION['UserID'] = $row['user_id'];
                    $_SESSION['UserName'] = $row['name'];
                    $userName = $_SESSION['UserName'];
                    $userNum = $_SESSION['UserID'];
                    setcookie($userName, $userNum, time() + (86400*30), "/");
                    header("location: ../main.php?user");
                }
                else{
                    echo "the <ELSE> Wrong Password";
                }
            }
            else{
               echo "the username doesn't exist"; 
                
            }
        }
    }
?>