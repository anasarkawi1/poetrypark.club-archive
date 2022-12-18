<?php
include_once 'functionSet_db.php';

function getPost($postId) {
    $con = dbConnect();
    
    $postContentStmnt = 'SELECT * FROM postData where ID = ?';
    $statementPrepared = mysqli_prepare($con, $postContentStmnt);
    $statementPrepared->bind_param('i', $postId);
    $statementPrepared->execute();
    $result = $statementPrepared->get_result();
    $statementPrepared->close();
    
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
    $post['likesRecord'] = json_decode($postContent[3]);
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
    $con->close();
    return $post;
}

function getLikesRecords($postId) {
    $con = dbConnect();
    
    $postContentStmnt = 'SELECT LIKES_RECORDS FROM postData where ID = ?';
    $statementPrepared = mysqli_prepare($con, $postContentStmnt);
    $statementPrepared->bind_param('i', $postId);
    $statementPrepared->execute();
    $result = $statementPrepared->get_result();
    $statementPrepared->close();
    
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                foreach ($row as $key => $r)
                {
                    $likesRecords = $r;
                }
            }

    $con->close();
    return $likesRecords;
}

function getPostAuthor($posterId, $postId) {
    $con = dbConnect();
    
    $postContentStmnt = 'SELECT * FROM postData where POSTER_ID = ? && ID = ?';
    $statementPrepared = mysqli_prepare($con, $postContentStmnt);
    $statementPrepared->bind_param('ii', $posterId, $postId);
    $statementPrepared->execute();
    $result = $statementPrepared->get_result();
    $statementPrepared->close();
    
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
    $statementPosterData->bind_param('i', $posterId);
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
    $con->close();
    return $post;
}

function getLatestPostId() {
    $con = dbConnect();
    $latestStatement = 'SELECT ID FROM postData ORDER BY id DESC LIMIT 1';
    $latestStatement = mysqli_prepare($con, $latestStatement);
    $latestStatement->execute();
    $result = $latestStatement->get_result();
    $latestStatement->close();

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                foreach ($row as $key => $r)
                {
                    $latestId = $r;
                }
            }
    $con->close();
    return $latestId;
}


function getLatestPostIdAuthor($authorId) {
    $con = dbConnect();
    $latestStatement = 'SELECT ID FROM postData WHERE POSTER_ID = ? ORDER BY id DESC LIMIT 1';
    $latestStatement = mysqli_prepare($con, $latestStatement);
    $latestStatement->bind_param('i', $authorId);
    $latestStatement->execute();
    $result = $latestStatement->get_result();
    $latestStatement->close();

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                foreach ($row as $key => $r)
                {
                    $latestId = $r;
                }
            }
    $con->close();
    return $latestId;
}



?>