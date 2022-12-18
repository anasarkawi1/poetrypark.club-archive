<?php
include 'app/functionSet/functionSet_db.php';
include 'app/functionSet/functionSet_posts.php';

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    session_abort();
    header('Location: /login/login.php');
}
/*
$_SESSION['currentIteration'] = 0;


$latestId = getLatestPostId();


$initialId = $latestId - ($_SESSION['currentIteration'] * 5);
$id = $initialId;
for ($i = 0; $i <= 5; $i++) {
    $posts[$i] = getPost($id);
    $id = $id - 1;
}

$postsEncoded = json_encode($posts);
// setcookie('test', $postsEncoded);
*/
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="main.css">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" type="text/css" href="posts/post/post.css">
        <script src="scripts/homePage/index_posts.js"></script>
        <script src="scripts/homePage/index_like.js"></script>
    </head>
    
    <body onscroll="pageEnd()" onload="sortPosts()">
        <nav class="navBar">
            <div class="navLinks">
                <a class="navBarLink topPostsLink" href="posts/top/top.php">Top</a>
                <a class="navBarLink newPostLink" href="posts/newPost/newPost.php">New Post</a>
                <a class="navBarLink profileLink" href="profile/profile.php">Profile</a>
                <a class="navBarLink logoutLink" href="app/logout/logout.php">Logout</a>
            </div>
        </nav>
        
            <div class="postContainer"> 
                <template>
                    <div class="post" id="post" data-postid="">
                        <div class="postMeta">
                            <img class="profilePhotoPost" id="profilePhotoPost" src="#">
                            <a class="postLink userLink" id="userLink" href="#"><h5 id="screenName" class="postAuthor postMetaItem">Author</h5></a> <!-- Turn into link to profile php -->
                            <article id="postDate" class="postMetaDate postMetaItem">9/16/2020</article>
                        </div>

                        <div class="postContent">
                            <a class="postLink contentLink" id="contentLink" href="#"> <p class="contentActual" id="content">Content</p> </a>
                        </div>

                        <div class="postData">
                            <p class="postDataItem likesNumber"><a class="postLink likeLink" href="#">Likes 0</a></p>
                        </div>

                        <div class="postActions">
                            <button id="likeButton" class="likeButtonInput" value="Like">Like</button>
                        </div>
                    </div>
                </template>
            </div>
    </body>
</html>