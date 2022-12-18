<?php
include '../../functionSet/functionSet_db.php';

$con = dbConnect();

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    header('Location: /login/login.php');
}

$postContent = $_POST['postContent'];
$postEscaped = htmlspecialchars($postContent); // Implement input sanitization

$id = $_SESSION['id'];

if ($inputSanitiezed == '') {
    header('Location: /posts/newPost/newPost.php');
}

$statement = 'INSERT INTO postdata (ID, POSTER_ID, LIKES_NUMBER, LIKES_RECORDS, CONTENT, DATE_TIME_CREATED) VALUE (NULL, ?, 0, ?, ?, NULL)';
$likeRecords = '{"likeRecords": []}';
// $statementPrepared = prepareStatement($statement);
$statementPrepared = mysqli_prepare($con, $statement);
$statementPrepared->bind_param('iss', $id, $likeRecords, $postEscaped);
$statementPrepared->execute();
$statementPrepared->close();

header('Location: /index.php');


?>