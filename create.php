<?php
session_start();

require_once "config.php";
require_once "util.php";

// create client socket
error_reporting(E_ALL);
set_time_limit(0);

$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($server === false)
    die(socket_strerror(socket_last_error()));
if (socket_connect($server, SERVER_IP, PORT) === false)
    die(socket_strerror(socket_last_error()));

$username = $_POST['username'];

// write to server
$msg = "create $username";
socket_write($server, $msg, strlen($msg));

// read from server
$recv = socket_read($server, 8192);
if ($recv === false)
    echo "socket_read() failed: " . socket_strerror(socket_last_error());
$parts = explode(" ", $recv);
$userID = $parts[0];
$roomID = $parts[1];

// disconnect from server
$msg = "quit";
socket_write($server, $msg, strlen($msg));

//try {
//    $db = getDB();
//
//    // get a random roomID
//    do {
//        $roomID = rand(100000, 999999);
//        $command = concat("SELECT * FROM ", ROOMS, " WHERE roomID=", $roomID);
//    } while (($db->query($command))->rowCount() != 0);
//
//    $userID = addUser($username, $roomID);
//
//    // insert into rooms
//    $command = concat("INSERT INTO ", ROOMS, " (roomID, password) VALUES ('$roomID', NULL);");
//    $db->exec($command);

$_SESSION["userID"] = $userID;
$_SESSION["roomID"] = $roomID;
header("Location: room.php");
//} catch (PDOException $e) {
//    echo "<h2>Error</h2>";
//    die($e->getMessage());
//}