<?php
include '../app/functionSet/functionSet_db.php';
include '../app/functionSet/functionSet_profiles.php';

$con = dbConnect();

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    session_abort();
    header('Location: /login/login.php');
}

$userData = getUserData($_SESSION['id']);

$screenName = htmlspecialchars($userData[2]);
$profilePicture = '/userData/' . $_SESSION['id'] . '/profilePhoto/' . htmlspecialchars($userData[3]);
$bio = htmlspecialchars($userData[4]);
$posts = htmlspecialchars(postsNumber($_SESSION['id'])[0]);

// setcookie('id', $_SESSION['id']);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <link rel="stylesheet" type="text/css" href="../index.css">
        <link rel="stylesheet" type="text/css" href="profile.css">
        <link rel="stylesheet" type="text/css" href="../posts/post/post.css">
        <script src="../scripts/profile/profile_posts.js"></script>
    </head>
    
    <body  onscroll="pageEnd()" onload="id(); sortPosts()">
        <nav class="navBar">
            <div class="navLinks">
                <a class="navBarLink homeLink" href="../index.php">Home</a>
                <a class="navBarLink newPostLink" href="posts/newPost/newPost.php">New Post</a>
                <a class="navBarLink topPostsLink" href="../posts/top/top.php">Top</a>
                <a class="navBarLink logoutLink" href="../app/logout/logout.php">Logout</a>
            </div>
        </nav>
        
        <main>
            <div class="profileInfo">
                <div class="profilePicture">
                    <img class="profilePicture" src="<?php echo $profilePicture ?>">
                </div>
                <div class="profileInfoBasic">
                    <h3 class="usernameProfile"> <?php echo $screenName ?> </h3>
                    <p class="profileBio"> <?php echo $bio ?> </p>
                    <p class="numberOfPoems">Posts: <?php echo $posts ?> </p>
                </div>
                <form class="profileOptions" method="get" action="profileOptions.php" target="_blank">
                    <button id="editProfile" name="profileOptions" class="editProfileButtonInput profileOptionsInput" type="submit" value="editProfile">Edit Profile</button>
                    <button id="settingsProfile" name="profileOptions" class="editProfileButtonInput profileOptionsInput" type="submit" value="settings">Settings</button>
                </form>
            </div>
            
            <template>
                    <div class="post" id="post">
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
                            <forum id="postAction" name="postAction" class="postActionInput" action="#">
                                <input id="likeButton" name="likeButton" class="likeButtonInput postActionInput" type="button" value="Like">
                            </forum>
                        </div>
                    </div>
                </template>
        </main>
    </body>
</html>