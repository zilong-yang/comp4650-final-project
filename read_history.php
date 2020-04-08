<?php
require_once "util.php";

session_start();
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

$file_name = $_SESSION['roomID'] . ".txt";
$history = fopen($file_name, "r") or die("Unable to open file.\n");

echo "data: ";
while (($line = fgets($history)) !== false) {
    echo $line;
}
echo "\n\n";
flush();