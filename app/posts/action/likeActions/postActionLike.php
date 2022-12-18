<?php
include_once '../../../functionSet/functionSet_posts.php';
include_once '../../../functionSet/functionSet_db.php';

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    session_abort();
    header('Location: /login/login.php');
}

$action = $_GET['like'];
$postId = $_GET['postId'];
$viewerId = (int)$_GET['viewerId'];

if($action) {
    likePost($postId, $viewerId);
} 
else if ($action != true) {
    dislikePost($postId, $viewerId);
}

function likePost($postId, $viewerId) {
    $con = dbConnect();
    $currentRecords = getLikesRecords($postId);
    $recordsDecoded = json_decode($currentRecords);
    
    if(in_array($viewerId, $recordsDecoded->likeRecords)) {
        http_response_code(409);
        exit();
    }
    
    $recordsDecoded->likeRecords[] = (int)$viewerId;
    // echo array_search((int)$viewerId, $recordsDecoded->likeRecords);
    
    $recordsEncoded = json_encode($recordsDecoded);
    
    $statement = "UPDATE postData SET LIKES_RECORDS = ? WHERE ID = ?";
    $statementPrepared = mysqli_prepare($con, $statement);
    $statementPrepared->bind_param("si", $recordsEncoded, $postId);
    $statementPrepared->execute();
    $statementPrepared->close();
    $con->close();
}

function dislikePost($postId, $viewerId) {
    $con = dbConnect();
    $currentRecords = getLikesRecords($postId);
    $recordsDecoded = json_decode($currentRecords);
    
    if(in_array($viewerId, $recordsDecoded->likeRecords) === false) {
        http_response_code(409);
        exit();
    }
    
    $index = array_search($viewerId, $recordsDecoded->likeRecords);
    $recordsDecoded->likeRecords = array_splice($recordsDecoded->likeRecords, 1, $index);
    
    $recordsEncoded = json_encode($recordsDecoded);
    
    $statement = "UPDATE postData SET LIKES_RECORDS = ? WHERE ID = ?";
    $statementPrepared = mysqli_prepare($con, $statement);
    $statementPrepared->bind_param("si", $recordsEncoded, $postId);
    $statementPrepared->execute();
    $statementPrepared->close();
    $con->close();
}

?>