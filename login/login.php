<?php

session_start();

if(isset($_SESSION['loggedin'])) {
    header('Location: /index.php');
}

if(isset($_GET['condition'])) {
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    
    <body>
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
                <h2 class="loginBoxTitle">Login</h2>
                <form id="login" class="loginForm" method="post" action="../app/login/loginProcess.php">
                    <input id="username" name="usernameInput" class="usernameInput input" type="text" placeholder="Username" required>
                    <input id="password" name="passwordInput" class="passwordInput input" type="password"  minlength="8" placeholder="Password" required>
                    <input id="submit" name="submitInput" class="submitInput input" type="submit" value="Login" required>
                </form>
                <article class="signupMessage">Don't have an account? <a class="signupLink" href="../signup/signup.php">Signup</a></article>
            </div>
        </main>
    </body>
</html>