<html>
<head>
<link href="css/indexStyle.css" rel="stylesheet" type="text/css" />  
<link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<title>Musiclog</title>
</head>
<body>
<div id="header">
    <div id="logo">
        <a href="index.php">MusicLog</a>
    </div>
    <div id="play2"></div>
    <div class="indexAction"><button class="button button2" onclick="createFun()">
        <span>Create Account</span>
    </button></div>
    <div class="indexAction"><button class="button button2" onclick="loginFun()">
        <span>Login</span>
    </button></div>
</div>
<div id="formBox" style="height:; display:none;">
        <div id="loginForm" style="display:none;">
            <span class="title"><strong>Login</strong></span>
            <form method="get" action="include/login.php">
                <input type="text" name="username" placeholder="Enter Username" /><br/>
                <input type="password" name="password" placeholder="Enter Password" /><br/>
                <input type="submit" name="submit-login" value="Login" style="cursor: pointer;"/>
            </form>
        </div>
        <div id="signupForm" style="height:; display:none;">
            <h4><span class="title"><strong>Create Account</strong></span></h4>
            <form id="signup-form" method="post" action="include/signup.php">
                <input id="signup-name" type="text" name="name" placeholder="Your Name" /><br/>
                <input id="signup-username" type="text" name="username" placeholder="Username" /><br/>
                <input id="signup-password" type="password" name="password" placeholder="Password" /><br/>
                <input id="signup-passwordRepeat" type="password" name="passwordRepeat" placeholder="Repeat Your Password" /><br/>
                <input id="signup-email" type="email" name="email" placeholder="Email" /><br/>
                <!--<select name ="country">
                    <option value="blank">Select a Country</option>
                    <option value="UK">United Kingdom</option>
                    <option value="PT">Portugal</option>
                </select>-->
                <input id="signup-country" type="country" name="country" placeholder="Country" /><br/>
                <!--<input type="submit" name="submit-signup" value="Sign-Up" style="cursor: pointer;"/>-->
                <button id="signup-submit" type="submit" name="submit-signup" style="cursor: pointer;" > Sign-Up</button>
                <p id="feedBack-message"></p>
            </form>
        </div>
</div>
<div id="Top">
    <div id="content" style="margin-top:;">
        <div id="textCont">
            <h2><p>YOUR MUSIC 
                <br>EVERYWHERE.</p></h2>
            <div id="test"></div>
        </div>
        <div id="play">
            <div id="playBgMusic" style="display:block;"><button class="button soundOn" onclick="document.getElementById('player').play(); soundFun();"></button></div>
            <div id="pauseBgMusic" style="display:none;"><button class=" button soundOff" onclick="document.getElementById('player').pause(); soundFun();"></button></div>
            <audio id="player" loop src="BensoundTheJazzPiano.mp3"></audio>
        </div>
    </div> 
</div>
<div id="info">
    <div id="infoB1"><strong>Ever found a song that was not available at your favourite music platform?</strong></div>
    <div id="infoB2">MusicLog is here for you!<br/> <a href="#" onclick="createFun()" >Create an account</a> and upload your favourite songs.</div>
</div>
<div id="T1">
<div id="copyrights">
    <span><strong>Song's Source</strong></span>
    <br />
    <br />
    <br />
    All songs used in this project were obtained from <a href="https://www.bensound.com" target="_blank">Bensound.com</a>
    <br />
    <br />
    <br />
    Speaker's Icons used in this first page were obtained from:
    <div>Icons made by <a href="https://www.flaticon.com/authors/picol" title="Picol">Picol</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    <div>Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    <span>Background Image obtained from <a href="https://www.pexels.com/photo/background-blur-clean-clear-531880/">here</a></span>
    <!--<a href="#">Click Here to see song's source links.</a>-->
</div>
<div id="about">
    <span><strong>About</strong></span>
    <br />
    <br />
    <br />
    This prototype is part of the final year project for the course Business Information Technology, at Solent University. <br/>Year: 2018-2019
    <br/>
    Unit: CDA600
    <br/>
    Tutor: Martin Reid
    <br/>
    <br/>
    Designed and developed by Joao Alexandre Marques Pinto Sousa.
</div>
</div>
    
    
<!-- JavaScript --->
<script>
function createFun(){
    var x = document.getElementById("formBox");
    var k = document.getElementById("signupForm");
    var z = document.getElementById("loginForm");
    var y = document.getElementById("content");
    var info = document.getElementById("info");
    if (x.style.display === "block" && k.style.display == "none" && z.style.display == "inline-block") {
        x.style.height = "45vh";
        k.style.display = "inline-block";
        z.style.display = "none";
        y.style.marginTop = "30vh";
        
    }
    else if(x.style.display == "none" && k.style.display == "none"){
        x.style.display = "block";
        x.style.height = "45vh";
        k.style.display = "inline-block";
        z.style.display = "none";
        y.style.marginTop = "30vh";
    }else{
        x.style.display = "none";
        k.style.display = "none";
        z.style.display = "none";
        y.style.marginTop = "";
    }
}
function loginFun(){
    var x = document.getElementById("formBox");
    var k = document.getElementById("loginForm");  
    var z = document.getElementById("signupForm");   
    var y = document.getElementById("content");   
    if (x.style.display === "block" && k.style.display == "none" && z.style.display == "inline-block") {
        x.style.display = "block";
        x.style.height = "30vh";
        k.style.display = "inline-block";
        z.style.display = "none";
        y.style.marginTop = "25vh";
    }else if(x.style.display == "none" && k.style.display == "none"){
        x.style.display = "block";
        x.style.height = "30vh";
        k.style.display = "inline-block";
        z.style.display = "none";
        y.style.marginTop = "25vh";
    }else{
        x.style.display = "none";
        k.style.display = "none";
        z.style.display = "none";
        y.style.marginTop = "";
    }
}

function soundFun(){
    var soundOn = document.getElementById("playBgMusic");
    var soundOff = document.getElementById("pauseBgMusic");
    
    if(soundOn.style.display == "block" && soundOff.style.display == "none"){
        soundOn.style.display = "none";
        soundOff.style.display = "block";
    }else{
        soundOn.style.display = "block";
        soundOff.style.display = "none";
    }
}    

$(document).ready(function(){
    $('#signup-form').submit(function(event){
        event.preventDefault();
        var name = $("#signup-name").val();
        var username = $("#signup-username").val();
        var password = $("#signup-password").val();
        var passwordRepeat = $("#signup-passwordRepeat").val();
        var email = $("#signup-email").val();
        var country = $("#signup-country").val();
        var submit = $("#signup-submit").val();
        
        $("#feedBack-message").load("include/signup.php", {
        //  POST Name: Value from the inputs
            name: name,
            username: username,
            password: password,
            passwordRepeat: passwordRepeat,
            email: email,
            country: country,
            submit: submit
        });
    });
});       

</script>  

</body>
</html>