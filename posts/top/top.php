<!DOCTYPE html>
<html>
    <head>
        <title>Top Posts | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="../../main.css">
        <link rel="stylesheet" type="text/css" href="../../index.css">
        <link rel="stylesheet" type="text/css" href="top.css">
    </head>
    
    <body>
        <nav class="navBar">
            <div class="navLinks">
                <a class="navBarLink topPostsLink" href="../../index.php">Home</a>
                <a class="navBarLink newPostLink" href="../newPost/newPost.php">New Post</a>
                <a class="navBarLink profileLink" href="../../profile/profile.php">Profile</a>
                <a class="navBarLink logoutLink" href="../../app/logout/logout.php">Logout</a>
            </div>
        </nav>
        
        <main>
            <div class="post">
                    <div class="postMeta">
                        <h5 class="postAuthor postMetaItem">Author</h5> <!-- Turn into link to profile php -->
                        <article class="postMetaDate postMetaItem">9/16/2020</article>
                    </div>
                    
                    <div class="postContent">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac mi leo. Donec ut laoreet nulla. Nunc vulputate aliquam tellus, non pharetra tortor ultricies at.</p>
                    </div>
                    
                    <div class="postData">
                        <p class="postDataItem likesNumber">Likes 0</p>
                    </div>
                    
                    <div class="postActions">
                        <forum id="postAction" name="postAction" class="postActionInput" action="#">
                            <input id="likeButton" name="likeButton" class="likeButtonInput postActionInput" type="button" value="Like">
                        </forum>
                    </div>
                </div>
        </main>
    </body>
</html>