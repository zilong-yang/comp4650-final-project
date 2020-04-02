<?php
require_once "util.php";

$username = $_POST['username'];
echo $username."<br>";

try {
    $dbname = "project";
    define("TABLE", "rooms");

    $rooms = getDB($dbname);

    do {
        $randID = rand(100000, 999999);
        $command = concat("SELECT * FROM ", TABLE, " WHERE roomID=", $randID);
    } while (($rooms->query($command))->rowCount() != 0);

    $command = concat("INSERT INTO ", TABLE, " (roomID, host, password) VALUES ('",
        $randID, "', '", $username, "', NULL);");
    $rooms->exec($command);

    $command = concat("SELECT * FROM ", TABLE);
    $result = $rooms->query($command);

    // print available rooms
    while ($row=$result->fetch()) {
//        echo "loop<br>";
        echo $row['roomID']."&emsp;".$row['host']."<br>";
    }

    echo "done";
} catch (PDOException $e) {
    echo "<h2>Error</h2>";
    die($e->getMessage());
}