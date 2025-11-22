<?php
    $server   = "localhost";
    $user     = "root";
    $password = "";
    $dbname   = "tishoo";

    $conn = new mysqli($server, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("DB 연결 실패: " . $conn->connect_error);
    }
?>
