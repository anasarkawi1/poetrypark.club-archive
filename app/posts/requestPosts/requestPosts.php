<?php
include '../../functionSet/functionSet_posts.php';

session_start();

if($_SESSION['loggedin'] == false || !isset($_SESSION['loggedin'])) {
    session_abort();
    header('Location: /login/login.php');
}


$lastId = $_GET['reqId'];

if ($lastId == 'na') {
    $initialId = getLatestPostId();
    $id = $initialId;
    for ($i = 0; $i <= 2; $i++) {
        $posts[$i] = getPost($id);
        $id = $id - 1;
    }
} else {
    $initialId = $lastId - 1; // - 3;
    $id = $initialId;
    for ($i = 0; $i <= 2; $i++) {
        $posts[$i] = getPost($id);
        $id = $id - 1;
    }
}

// Escape string before proceeding

$postsEncoded = json_encode($posts);
// setcookie('test', $postsEncoded);
echo $postsEncoded;

?>