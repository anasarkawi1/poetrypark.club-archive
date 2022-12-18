<?php 
include '../functionSet/functionSet_db.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: /index.php');
    exit();
}

$userInput = $_POST['usernameInput'];
$passwordInput = $_POST['passwordInput'];

$userInputProcessed = $userInput; // Implment Sanitization;
$passwordInputProcessed = $passwordInput; // Implment Sanitization;

function retrievePassword($username) {
    $userPasswordStatement = "SELECT PASSWORD_HASH FROM userCred WHERE USERNAME = '" . $username . "'";

    $statementReady = $userPasswordStatement; // Implment sanitization and statment prepration

    $retrievedPassword = retrieveData('PASSWORD_HASH', $statementReady);
    
    return $retrievedPassword;
}

function retrieveID($username) {
    $userPasswordStatement = 'SELECT ID FROM userCred WHERE USERNAME = "' . $username . '"';

    $retrievedID = retrieveData('ID', $userPasswordStatement);
    
    return $retrievedID;
}

function verifyPassword($reference, $password) {
    if (password_verify($password, $reference)) {
        return true;
    } else {
        return false;
    }
}

$pass = retrievePassword($userInputProcessed);

if (verifyPassword($pass, $passwordInputProcessed)) {
    loginSuccess($userInputProcessed);
} else {
    loginFailed();
}

function loginSuccess($user) {
        $id = retrieveID($user);
        
        
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $user;
        
        header('Location: loginSetup.php');
}

function loginFailed () {
    header('Location: ../../login/login.php');
}
?>