<?php
    function sql(){
    $host = '127.0.0.1:3307';
    $user = 'root';
    $pw = 'ehgns123#';
    $dbName = 'gbsns';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
    /*
    if($mysqli->connection_error){
        echo "MySQL 접속 실패";
    }else{
        echo "MySQL 접속 성공";
    }
    */
    return $mysqli;
    }
?>