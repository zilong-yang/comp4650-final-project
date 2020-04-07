<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        Room
        <?php
        require_once "util.php";
        echo $_SESSION["roomID"];
        ?>
    </title>
    <link rel="stylesheet" href="room.css">
    <script src="room.js"></script>
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
                include "current_players.php";
                ?>
            </td>
            <td id="log">
            </td>
        </tr>
        <tr id="control">
            <td>Your bid:</td>
            <td>
                <form id="bid-form" method="POST" action="#">
                    <fieldset>
                        <label>
                            <input type="text" id="bid-input">
                        </label>
                        <button type="submit" id="bid-button">Bid</button>
                    </fieldset>
                </form>
            </td>
        </tr>
    </table>
</div>
</body>
</html>