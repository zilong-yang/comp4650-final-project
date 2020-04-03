<?php
session_start();

require_once "util.php";

//function createRoom() {
$username = $_POST['username'];
define("ROOMS", "rooms");
define("USERS", "users");

try {
    $db = getDB();

    // get a random userID
    do {
        $userID = rand(1000000, 9999999);
        $command = concat("SELECT * FROM ", USERS, " WHERE userID=", $userID);
    } while (($db->query($command))->rowCount() != 0);

    // get a random roomID
    do {
        $roomID = rand(100000, 999999);
        $command = concat("SELECT * FROM ", ROOMS, " WHERE roomID=", $roomID);
    } while (($db->query($command))->rowCount() != 0);

    // insert into users
    $command = concat("INSERT INTO ", USERS, " (userID, name, roomID) VALUES ('",
        $userID, "', '", $username, "', '", $roomID, "');");
    $db->exec($command);

    // insert into rooms
    $command = concat("INSERT INTO ", ROOMS, " (roomID, userID, password) VALUES ('",
        $roomID, "', '", $userID, "', NULL);");
    $db->exec($command);

//        return $roomID;
    $_SESSION["userID"] = $userID;
    header("Location: room.php");
} catch (PDOException $e) {
    echo "<h2>Error</h2>";
    die($e->getMessage());
}
//}