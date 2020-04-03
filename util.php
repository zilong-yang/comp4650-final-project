<?php
require_once "config.php";

function getDB() {
    try {
        $conn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
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

function getRoomID($userID) {
    try {
        $db = getDB();
        $command = concat("SELECT roomID FROM users WHERE userID=", $userID);
        $result = $db->query($command);
        if ($result->rowCount() == 0) {
            die("getRoomID: roomID Not Found");
        } elseif ($result->rowCount() > 1) {
            die("getRoomID: duplicated roomID Found");
        }

        return ($result->fetch())['roomID'];
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getUsers($roomID) {
    try {
        $db = getDB();
        $command = concat("SELECT userID, `name` FROM users WHERE roomID=", $roomID);
        return $db->query($command);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}