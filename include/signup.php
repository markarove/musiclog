<?php 
// SIGN UP 

//---------->ADD PATH CHECKER<------------- 
    require 'dbConnection.php';
    
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $email = $_POST['email'];
    $country = $_POST['country'];

    $error = false;
    $errorEmpty = false;
    $errorUsername = false;
    $errorEmail = false;
    $errorPassword = false;
    
    
    if(empty($name) || empty($username) || empty($password) || empty($passwordRepeat) || empty($email) || empty($country)){
        echo "<span style=\"color:red; background-color:white;\" ><strong>Please Fill up all fields in the form</strong></span>";
        $errorEmpty = true;
    }
    //Check if the user typed a valid email
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span style=\"color:red;\"><strong>Invalid email</strong></span>";
    } 
    //check if the username is valid
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        echo "<span style=\"color:red background-color:white;\"><strong>Please use only letters or numbers for your username</strong></span>";
        $errorUsername = true;
    }
    else if($password != $passwordRepeat){
        echo "<span style=\"color:red; background-color:white;\"><strong>Passwords didn't match</strong></span>";
        $errorPassword = true;
    }
	else{
        //Check if the username is available
        $sql="SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
           echo "error";
        }else{
            mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
                echo "<span style=\"color:red; background-color:white;\"><strong>The username you selected is no longer valid</strong></span>";
                $errorUsername = true;
        }else{
            //Check if the email is available
            $sql="SELECT email FROM users WHERE email=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "error";
            }else{
                mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                echo "<span style=\"color:red; background-color:white;\"><strong>The email you selected is no longer valid</strong></span>";
                $errorEmail = true;
            }else{
                //Complete Sign Up
                $sql = "INSERT INTO users (name, username, password, email, country) VALUES(?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "<span style=\"color:red; background-color:white;\">An error as occured, please try again</span>";
                    $error = true;
                } 
                else{
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $name, $username, $hashedPassword, $email, $country);
                    mysqli_stmt_execute($stmt);
                    echo "<span style=\"color:green; background-color:white;\"><strong>Account Created!</strong></span>";
                }
            }
            }
            
        }
        }
        
    }
?>
<script>
    
    var error = "<?php echo $error ?>";
    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorUsername = "<?php echo $errorUsername ?>";
    var errorEmail = "<?php echo $errorEmail ?>";
    var errorPassword = "<?php echo $errorPassword ?>";
       
</script>