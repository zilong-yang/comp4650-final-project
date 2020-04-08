<?php
session_start();
$file_name = $_SESSION['roomID'] . ".txt";
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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="room.js"></script>
</head>

<body>
<p id="test"></p>
<div id="window">
    <table id="table">
        <tr id="room-title">
            <th colspan="2">Room <span id="room-id"><?php echo $_SESSION['roomID'] ?></span></th>
        </tr>
        <tr id="header">
            <th class="players">Players</th>
            <th id="money">Your have:</th>
        </tr>
        <tr id="info">
            <td id="players-list" class="players">
            </td>
            <td id="log">
            </td>
        </tr>
        <tr id="control">
            <td>Your bid:</td>
            <td>
                <label>
                    <input type="text" id="bid-input">
                </label>
                <button id="bid-button">Bid</button>
<!--                <button id="clear-button">Clear Log</button>-->
            </td>
        </tr>
    </table>
</div>
</body>
</html>