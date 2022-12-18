<?php
include_once '../app/functionSet/functionSet_db.php';

function getUserData($id) {
    $con = dbConnect();
    $statementUser = 'SELECT * FROM userData WHERE ID = ?';
    $statementPrepared = mysqli_prepare($con, $statementUser);
    $statementPrepared->bind_param('i', $id);
    $statementPrepared->execute();
    $result = $statementPrepared->get_result();
    $statementPrepared->close();

    $con->close();

    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach ($rows as $key => $r) {
            $userData[$key] = $r;
        }
    }
    
    return $userData;
}

function postsNumber($id) {
    $con = dbConnect();
    
    $statementUser = 'SELECT COUNT(*) FROM postData WHERE POSTER_ID = ?';
    $statementPrepared = mysqli_prepare($con, $statementUser);
    $statementPrepared->bind_param('i', $id);
    $statementPrepared->execute();
    $result = $statementPrepared->get_result();
    $statementPrepared->close();

    $con->close();

    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach ($rows as $key => $r) {
            $userData[$key] = $r;
        }
    }
    
    return $userData;
}

?>