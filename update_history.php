<?php
session_start();

$msg = $_POST['message'];
$roomID = $_SESSION['roomID'];
$file_name = $roomID . '.txt';

//$history = fopen($file_name, 'w');
//$result = fwrite($history, $msg, strlen($msg));
$result = file_put_contents($file_name, $msg, FILE_APPEND | LOCK_EX);

echo $result;