<?php
require_once "util.php";

//session_start();
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

echo "data: ";
include "current_players.php";
echo "\n\n";
flush();