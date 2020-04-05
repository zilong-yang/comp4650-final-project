<?php
session_start();

require_once "config.php";
require_once "util.php";

$username = $_POST['username'];

try {
    $db = getDB();

    // get a random roomID
    do {
        $roomID = rand(100000, 999999);
        $command = concat("SELECT * FROM ", ROOMS, " WHERE roomID=", $roomID);
    } while (($db->query($command))->rowCount() != 0);

    $userID = addUser($username, $roomID);

    // insert into rooms
    $command = concat("INSERT INTO ", ROOMS, " (roomID, userID, password) VALUES ('",
        $roomID, "', '", $userID, "', NULL);");
    $db->exec($command);

    $_SESSION["userID"] = $userID;
    $_SESSION["roomID"] = $roomID;
    header("Location: room.php");
} catch (PDOException $e) {
    echo "<h2>Error</h2>";
    die($e->getMessage());
}