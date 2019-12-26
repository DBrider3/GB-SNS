<?php
    function sql(){
    $host = 'localhost';
    $user = 'root';
    $pw = '!1Qaz@wsx';
    $dbName = 'gbsns';
    $mysqli = new mysqli($host, $user, $pw, $dbName);

    /*
    127.0.0.1:3307
    if($mysqli->connection_error){
        echo "MySQL 접속 실패";
    }else{
        echo "MySQL 접속 성공";
    }
    */
    return $mysqli;
    }
?>