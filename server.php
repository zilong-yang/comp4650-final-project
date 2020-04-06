<?php
require_once "config.php";
require_once "util.php";

session_start();
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
ignore_user_abort(true);

$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Server: Failed to creat socket");
echo "socket_create() success\n";
$result = socket_bind($server, SERVER_IP, PORT) or die("Server: Failed to bind to socket");
echo "socket_bind() success\n";
$listen = socket_listen($server, 5) or die("Server: Failed to listen");
echo "socket_listen success\n";

do {
    if (($client = socket_accept($server)) < 0) {
        echo "socket accept() failure: " . socket_strerror(socket_last_error($client)) . "\n";
        break;
    }

    do {
        $recv = socket_read($client, 8192) or die("socket_read() failed");
        echo "Received: '$recv'\n";

        // decode message
        $parts = explode(" ", $recv);
        if ($parts[0] === "create") {
            $name = $parts[1];
            $roomID = addRoom();
            $userID = addUser($name, $roomID);

            $msg = "$userID $roomID";
            socket_write($client, $msg, strlen($msg));
            echo "Send: '$msg'\n";
        } elseif ($parts[0] === "update") {
            if ($parts[1] === "players") {
                $users = getUsers($parts[2]);
                $msg = '';
                while ($row=$users->fetch()) {
                    $msg .= concat("<div class='player-name'>", $row['name'], "</div>");
                }
                socket_write($client, $msg, strlen($msg));
                echo "Send: player list in HTML format\n";
            } else {
                die("Unknown message: $recv\n");
            }
        } elseif ($parts[0] === "quit") {
            break;
        } else {
            die("Unknown message: $recv\n");
        }
    } while (true);


    socket_close($client);
} while (true);

socket_close($server);