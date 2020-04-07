<?php
//session_start();

require_once "util.php";

$roomID = $_SESSION["roomID"];
$result = getUsers($roomID);
while ($row = $result->fetch()) {
    echo concat("<div class='player-name'>", $row['name'], "</div>");
}
