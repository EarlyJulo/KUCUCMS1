<?php
//core
$pdo;
function dbcon(){
    global $pdo;
    $host = "localhost";
    $dbname = "cman";
    $username = "root";
    $password = ""; // Update with your database password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function host(){
    $h = "http://" . $_SERVER['HTTP_HOST'] . "/bankdb/";
    return $h;
}

function hRoot(){
    $url = $_SERVER['DOCUMENT_ROOT'] . "/bankdb/";
    return $url;
}

//parse string
function gstr(){
    $qstr = $_SERVER['QUERY_STRING'];
    parse_str($qstr, $dstr);
    return $dstr;
}

?>
