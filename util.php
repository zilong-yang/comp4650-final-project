<?php
require_once "config.php";

function getDB($dbname) {
    try {
        $conn = "mysql:host=" . DBHOST . ";dbname=" . $dbname;
        return new PDO($conn, DBUSER, DBPASS);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function concat(...$args) {
    $result = "";
    foreach ($args as $s) {
        $result .= $s;
    }
    return $result;
}