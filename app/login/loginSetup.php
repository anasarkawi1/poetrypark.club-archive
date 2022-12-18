<?php
include '../functionSet/functionSet_db.php';

$con = dbConnect();

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: /index.php');
    exit();
}

$statementUser = 'SELECT * FROM userData WHERE ID = ?';
$statementPrepared = mysqli_prepare($con, $statementUser);
$statementPrepared->bind_param('i', $_SESSION['id']);
$statementPrepared->execute();
$result = $statementPrepared->get_result();
$statementPrepared->close();

$con->close();

while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
    foreach ($rows as $key => $r) {
        $userData[$key] = $r;
    }
}

$screenName = $userData[2];
$profilePicture = $userData[3];
$bio = $userData[4];

$_SESSION['profilePicture'] = $profilePicture;
$_SESSION['bio'] = $bio;
$_SESSION['screenName'] = $screenName;
$_SESSION['loggedin'] = true;

setcookie('id', $_SESSION['id'], 0, '/');

header('Location: /index.php');

?>