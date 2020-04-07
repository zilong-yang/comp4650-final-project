<?php
session_start();

require_once "config.php";
require_once "util.php";

$username = $_POST['username'];
$user = USERS;
$rooms = ROOMS;

$roomID = addRoom();
$userID = addUser($username, $roomID);

$_SESSION["userID"] = $userID;
$_SESSION["roomID"] = $roomID;
header("Location: room.php");