<?php
include '../../app/functionSet/functionSet_db.php';
$con = dbConnect();

$postId = $_GET['postId'];


$postContentStmnt = 'SELECT * FROM postData where ID = ?';
$statementPrepared = mysqli_prepare($con, $postContentStmnt);
$statementPrepared->bind_param('i', $postId);
$statementPrepared->execute();
$result = $statementPrepared->get_result();
$statementPrepared->close();

$content = '';


while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            foreach ($row as $key => $r)
            {
                $postContent[$key] = $r;
            }
        }


$post['id'] = $postContent[0];
$post['posterId'] = $postContent[1];
$post['likes'] = $postContent[2];
$post['likesRecord'] = $postContent[3];
$post['content'] = $postContent[4];
$post['timestamp'] = $postContent[5];


$statementPosterData = 'SELECT * FROM userData WHERE ID = ?';
$statementPosterData = mysqli_prepare($con, $statementPosterData);
$statementPosterData->bind_param('i', $post['posterId']);
$statementPosterData->execute();
$result = $statementPosterData->get_result();
$statementPosterData->close();

while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
    foreach ($rows as $key => $r) {
        $posterData[$key] = $r;
    }
}

$post['posterUserame'] = $posterData[1];
$post['posterName'] = $posterData[2];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home | PoetryPark</title>
        <link rel="stylesheet" type="text/css" href="../../main.css">
        <link rel="stylesheet" type="text/css" href="post.css">
    </head>
    
    <body>
        <nav class="navBar">
            <div class="navLinks">
                <a class="navBarLink topPostsLink" href="posts/top/top.php">Top</a>
                <a class="navBarLink newPostLink" href="posts/newPost/newPost.php">New Post</a>
                <a class="navBarLink profileLink" href="profile/profile.php">Profile</a>
            </div>
        </nav>
        
        <main>
            <div class="postContainer"> 
                <div class="post">
                    <div class="postMeta">
                        <h5 class="postAuthor postMetaItem"><?php echo $post['posterName']; ?></h5> <!-- Turn into link to profile php -->
                        <article class="postMetaDate postMetaItem"><?php echo $post['timestamp']; ?></article>
                    </div>
                    
                    <div class="postContent">
                        <p><?php echo nl2br($post['content']); ?></p>
                    </div>
                    
                    <div class="postData">
                        <p class="postDataItem likesNumber">Likes <?php echo $post['likes']; ?></p>
                    </div>
                    
                    <div class="postActions">
                        <forum id="postAction" name="postAction" class="postActionInput" action="#">
                            <input id="likeButton" name="likeButton" class="likeButtonInput postActionInput" type="button" value="Like">
                        </forum>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>