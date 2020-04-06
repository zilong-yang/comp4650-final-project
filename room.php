<?php
session_start();

require_once "config.php";

error_reporting(E_ALL);
set_time_limit(0);

$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() failed");
socket_connect($server, SERVER_IP, PORT) or die("socket_connect() failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        Room
        <?php
        require_once "util.php";
        $roomID = getRoomID($_SESSION['userID']);
        //        echo $_SESSION["roomID"];
        echo $roomID;
        ?>
    </title>
    <link rel="stylesheet" href="room.css">
    <!--    <script src="room.js"></script>-->
</head>

<body>
<div id="window">
    <table id="table">
        <tr id="room-title">
            <th colspan="2">Room <?php echo $_SESSION['roomID'] ?></th>
        </tr>
        <tr id="header">
            <th class="players">Players</th>
            <th id="money">Your have:</th>
        </tr>
        <tr id="info">
            <td id="players-list" class="players">
                <?php
                //                $users = getUsers($_SESSION["roomID"]);
                //                foreach ($users as $user) {
                //                    echo concat("<div class='player-name'>", $user['name'], "</div>");
                //                }

                //                while (true) {
                $msg = "update players $roomID";
                socket_write($server, $msg, strlen($msg));
                $recv = socket_read($server, 8192);
                echo $recv;
                $msg = "quit";
                socket_write($server, $msg, strlen($msg));
                //                    socket_read($server, 8192);

                //                }
                ?>
            </td>
            <td id="log">

            </td>
        </tr>
        <tr id="control">
            <td>Your bid:</td>
            <td>
                <form>
                    <fieldset>
                        <label>
                            <input type="text">
                        </label>
                        <button type="submit">Bid</button>
                    </fieldset>
                </form>
            </td>
        </tr>
    </table>
</div>
</body>
</html>