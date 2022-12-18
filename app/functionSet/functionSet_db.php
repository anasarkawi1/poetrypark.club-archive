<?php 

function getDbCred() {
    $databaseCred = parse_ini_file('databaseCred.ini');
    return $databaseCred;
}

function inputSanitize($input) {
    $con = dbConnect();
    $sanitizedInput = mysqli_real_escape_string($con, $input);
    return $sanitizedInput;
}

function retrieveData($data, $statement) {
    $db_con = dbConnect();
    $output = 'false';
    if($data != '') {
        // $dataEscaped = mysqli_real_escape_string($db_con, $data);
        $dataEscaped = $data;
    }
    
    $returnVal = $db_con->query($statement);
    
    if (!$returnVal) {
        echo mysqli_error($db_con) . "<br>";
        exit('No Data Retrived');
    }
    while ($row = $returnVal->fetch_assoc()) {
        $output = $row[$dataEscaped];
    }
    if (mysqli_error($db_con)) {
        $output = mysqli_error($db_con);
    }
    
    dbDisconnect($db_con);
    
    return $output;
}

function prepareStatement ($statement) {
    $con = dbConnect();
    // $stmnt = mysqli_prepare($con, $statement);
    $stmnt = $con->prepare($statement);
    return $stmnt;
}

function executeQuery($db_con, $statement) {
    $output = true;
    $returnVal = mysqli_query($db_con, $statement);
    
    if(mysqli_error($db_con)) {
        echo mysqli_error($db_con) . '<br>';
        $output = false;
        exit('No Data Recieved');
    }
    
    dbDisconnect($db_con);
    
    return $output;
    
}


function dbConnect() {
    $databaseCred = getDbCred();
    /*
    if(isset($_SESSION['loggedin'])) {
        header('Location: login.php');
    }
    */
    $DB_HOST = $databaseCred['db_host'];
    $DB_NAME = $databaseCred['db_name'];
    $DB_USER = $databaseCred['db_user'];
    $DB_PASS = $databaseCred['db_pass'];
    $DB_PORT = $databaseCred['db_port'];
    
    $connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    
    /* Check if the connection was successful */
    if(mysqli_connect_error()) {
        exit('Connection To The Database Failed: ' . mysqli_connect_error());
    }
    return $connection;
}

function dbDisconnect($conn) {
    $conn->close();
}
?>