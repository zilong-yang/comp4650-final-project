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
        $users = USERS;
        $command = concat("SELECT roomID FROM $users WHERE userID=", $userID);
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
        $users = USERS;
        $command = "SELECT userID, `name` FROM $users WHERE roomID=$roomID";
        return $db->query($command);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function addUser($name, $roomID) {
    try {
        $db = getDB();
        $users = USERS;

        // get a random userID
        do {
            $userID = rand(1000000, 9999999);
            $command = concat("SELECT * FROM $users WHERE userID=", $userID);
        } while (($db->query($command))->rowCount() != 0);

        // insert into users
        $result = $db->exec("INSERT INTO $users (userID, `name`, roomID) VALUES ('$userID', '$name', '$roomID');");
        if ($result !== 1) {
            die("addUser(): Error adding user");
        }
//        echo "affected rows: " . $result;

        return $userID;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function addRoom() {
    try {
        $db = getDB();
        $rooms = ROOMS;

        do {
            $roomID = rand(100000, 999999);
            $command = concat("SELECT * FROM $rooms WHERE roomID=", $roomID);
        } while (($db->query($command))->rowCount() != 0);

        // insert into rooms
        $command = "INSERT INTO $rooms (roomID, password) VALUES ('$roomID', NULL)";
        $result = $db->exec($command);
        if ($result !== 1) {
            die("addRoom(): Error adding room");
        }

        return $roomID;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function removeUser($userID) {
    try {
        $db = getDB();
        $users = USERS;
        $result = $db->exec("DELETE FROM $users WHERE uesrID=$userID");
        return $result == 0 ? false : true;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}