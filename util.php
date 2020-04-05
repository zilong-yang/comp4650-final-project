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
        $command = "SELECT userID, `name` FROM users WHERE roomID=$roomID";
        return $db->query($command);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function addUser($name, $roomID) {
    try {
        $db = getDB();

        // get a random userID
        do {
            $userID = rand(1000000, 9999999);
            $command = concat("SELECT * FROM ", USERS, " WHERE userID=", $userID);
        } while (($db->query($command))->rowCount() != 0);

        // insert into users
//    $command = concat("INSERT INTO ", USERS, " (userID, name, roomID) VALUES ('",
//        $userID, "', '", $name, "', '", $roomID, "');");
        $result = $db->exec("INSERT INTO users (userID, name, roomID) VALUES ('$userID', '$name', '$roomID');");
        echo "affected rows: " . $result;

        return $userID;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function addRoom($hostID, $password) {
    try {
        $db = getDB();

        do {
            $roomID = rand(100000, 999999);
            $command = concat("SELECT * FROM ", ROOMS, " WHERE roomID=", $roomID);
        } while (($db->query($command))->rowCount() != 0);

        // insert into rooms
        $command = concat("INSERT INTO ", ROOMS, " (roomID, userID, password) VALUES ('",
            $roomID, "', '", $hostID, "', ", $password, ");");
        $db->exec($command);

        return $roomID;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}