<?php
require_once "util.php";

session_start();
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

echo "data: ";
$roomID = $_SESSION["roomID"];
$result = getUsers($roomID);
if ($result === false) {
    echo "<div>update_players.php: no players found</div>";
} else {
    while ($row = $result->fetch()) {
        echo concat("<div class='player-name'>", $row['name'], "</div>");
    }
}
echo "\n\n";
flush();