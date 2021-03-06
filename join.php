<?php
session_start();

require_once "config.php";
require_once "util.php";

$username = $_POST['username'];
$roomID = $_POST['code'];
$user = USERS;
$rooms = ROOMS;

// check if roomID exists
if (getUsers($roomID)->rowCount() == 0) {
    die("roomID does not exist");
}

$userID = addUser($username, $roomID);

$_SESSION['username'] = $username;
$_SESSION['userID'] = $userID;
$_SESSION["roomID"] = $roomID;
header("Location: room.php");