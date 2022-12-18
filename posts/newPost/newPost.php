<?php

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    header('Location: /login/login.html');
}


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../main.css">
        <link rel="stylesheet" type="text/css" href="newPost.css">
        <title>New Post | PoetryPark.Club</title>
    </head>
    
    <body>
        <nav class="navBar">
            <div class="navLinks">
                <a class="navBarLink homeLink" href="../../index.php">Home</a>
                <a class="navBarLink topPostsLink" href="../top/top.php">Top</a>
                <a class="navBarLink profileLink" href="../../profile/profile.php">Profile</a>
                <a class="navBarLink logoutLink" href="../../app/logout/logout.php">Logout</a>
            </div>
        </nav>
        <main>
            <div class="postEditorContainer">
                <form class="postEditor" id="postEditor" method="post" action="../../app/posts/newPost/newPostProcess.php">
                    <textarea name="postContent" class="postContentInput" placeholder="Content" cols="50" rows="6" required></textarea>
                    <input class="newPostSubmit" type="submit" value="Post">
                </form>
            </div>
        </main>
    </body>
</html>