<?php
session_start();

require_once "config.php";
require_once "util.php";

$username = $_POST['username'];
$user = USERS;
$rooms = ROOMS;

try {
    $db = getDB();

    // get a random roomID
    do {
        $roomID = rand(100000, 999999);
        $command = concat("SELECT * FROM $rooms WHERE roomID=$roomID");
    } while (($db->query($command))->rowCount() != 0);

    $userID = addUser($username, $roomID);

    // insert into rooms
    $command = concat("INSERT INTO $rooms (roomID, password) VALUES ($roomID, NULL)");
    $db->exec($command);

    $_SESSION["userID"] = $userID;
    $_SESSION["roomID"] = $roomID;
    header("Location: room.php");
} catch (PDOException $e) {
    echo "<h2>Error</h2>";
    die($e->getMessage());
}