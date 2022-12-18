<?php

session_start();

if(isset($_SESSION['loggedin'])) {
    header('Location: /index.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <link rel="stylesheet" type="text/css" href="signup.css">
        <script src="../scripts/signup/signup_main.js"></script>
    </head>
    
    <body onload="disableSubmit()">
        <nav class="navBar">
            <div class="navLinks">
                <!--
                <a class="navBarLink topPostsLink" href="../posts/top/top.html">Top</a>
                <a class="navBarLink profileLink" href="../profile/profile.html">Profile</a>
                -->
            </div>
        </nav>
        
        <main>
            <div class="loginBoxDiv">
                <h2 class="loginBoxTitle">Sign Up</h2>
                <form id="login" class="loginForm" method="post" action="../app/signup/signupProcess.php">
                    <input id="username" name="usernameInput" class="usernameInput input" type="text" placeholder="Username" required>
                    <input id="password" name="passwordInput" class="passwordInput input" type="password"  minlength="8" placeholder="Password" required>
                    <input id="name" name="nameInput" class="nameInput input" type="text"  minlength="3" placeholder="Screen Name" required>
                    <input id="email" name="emailInput" class="emailInput input" type="email" minlength="24" placeholder="Email" required>
                    <input id="birthday" name="birthdayInput" class="birthdayInput input" type="date" placeholder="Birthday" required pattern="\d{4}-\d{2}-\d{2}" required>
                    <article>I agree on our <a class="tos" href="../legal/tos/termsofservice.php">Terms Of Service</a> and our <a class="privacypolicy" href="../legal/privacypolicy/privacypolicy.php">Privacy Policy</a>.<input id="acceptTerms" name="termsInput" class="termsInput input" type="checkbox" required onchange="activateButton(this)"></article>
                    <input id="submit" name="submitInput" class="submitInput input" type="submit" value="Login" required>
                    </form>
                <article class="signupMessage">Have an account? <a class="signupLink" href="../login/login.php">Login</a></article>
            </div>
        </main>
    </body>
</html>