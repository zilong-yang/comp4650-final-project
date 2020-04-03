<?php
require_once "config.php";
require_once "util.php";

$conn = "mysql:host=" . DBHOST . ";dbname=project";
$pdo = new PDO($conn, DBUSER, DBPASS);

$randID = rand(100000, 999999);
$command = concat("SELECT * FROM rooms WHERE roomID=", $randID);
$result = $pdo->query($command);
echo $result->rowCount();