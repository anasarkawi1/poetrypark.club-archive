<?php
include '../functionSet/functionSet_db.php';

$con = dbConnect();

session_start();

if(isset($_SESSION['loggedin'])) {
    header('Location: /index.php');
}

// Get user input
$username = $_POST['usernameInput'];
$password = $_POST['passwordInput'];
$name = $_POST['nameInput'];
$email = $_POST['emailInput'];
$birthday = $_POST['birthdayInput'];
$termsInput = $_POST['termsInput'];

// escape user input for database entry
$usernameEscaped = inputSanitize($username);
$passwordEscaped = inputSanitize($password);
$nameEscaped = inputSanitize($name);
$emailEscaped = inputSanitize($email);
$birthdayEscaped = inputSanitize($birthday);
$termsInputEscaped = inputSanitize($termsInput);

// Check if data is valid
// Implement

// Hash the escaped password
$passwordReady = password_hash($passwordEscaped, PASSWORD_DEFAULT);

//check if user exists
$statmentCheck = 'SELECT id FROM userCred WHERE USERNAME = ? LIMIT 1';
$statmentCheck = mysqli_prepare($con, $statmentCheck);
$statmentCheck->bind_param('s', $usernameEscaped);
$statmentCheck->execute();
$result = $statmentCheck->get_result();
$statmentCheck->close();

while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            foreach ($row as $key => $r)
            {
                $id = $r;
            }
        }
if(isset($id)) {
    if ($id != '') {
        header('Location: /login/login.php');
        exit();
    }   
}

// Insert data into database
$statement = 'INSERT INTO userCred (ID, USERNAME, PASSWORD_HASH) VALUES (NULL, ?, ?)';
$statement = mysqli_prepare($con, $statement);
$statement->bind_param('ss', $usernameEscaped, $passwordReady);
$statement->execute();
$result = $statement->get_result();
$statement->close();

// Get id
$statmentCheck = 'SELECT id FROM userCred WHERE USERNAME = ? LIMIT 1';
$statmentCheck = mysqli_prepare($con, $statmentCheck);
$statmentCheck->bind_param('s', $usernameEscaped);
$statmentCheck->execute();
$result = $statmentCheck->get_result();
$statmentCheck->close();

while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            foreach ($row as $key => $r)
            {
                $id = $r;
            }
        }

$setupUrlParameter = 'id=' . $id . '&username=' . urlencode($usernameEscaped) . '&name=' . urlencode($nameEscaped);

header('Location: signupSetup.php?' . $setupUrlParameter);
exit();

?>