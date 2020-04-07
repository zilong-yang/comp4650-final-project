<?php
require_once "util.php";

//session_start();
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

$file_name = $_SESSION['roomID'] . ".txt";
$history = fopen($file_name, "r") or die("Unable to open file.\n");

echo "data: ";
echo fread($history, filesize($history));
echo "\n\n";
flush();