<?php
include '../functionSet/functionSet_db.php';

$con = dbConnect();

session_start();

if(isset($_SESSION['loggedin'])) {
    header('Location: /index.php');
}


$id = $_GET['id'];
$username = urldecode($_GET['username']);
$screenName = urldecode($_GET['name']);

$idEscaped = mysqli_real_escape_string($con, $id);
$usernameEscaped = mysqli_real_escape_string($con, $username);
$screenNameEscaped = mysqli_real_escape_string($con, $screenName);

$profilePhotoDirectory = $idEscaped . '/profilePhoto/';
echo $profilePhotoDirectory;
chdir('../../userData');
mkdir($profilePhotoDirectory, 0777, true);

$statement = 'INSERT INTO userData (ID, USERNAME, NAME, PROFILE_PHOTO) VALUES (?, ?, ?, ?)';
$statement = mysqli_prepare($con, $statement);
$statement->bind_param('isss', $idEscaped, $usernameEscaped, $screenNameEscaped, $profilePhotoDirectory);
$statement->execute();
$result = $statement->get_result();
$statement->close();

header('Location: /login/login.php?condition=signedup');

?>