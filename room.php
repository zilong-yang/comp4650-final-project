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
//        $roomID = getRoomID($_SESSION['userID']);
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
//                $users = getUsers($_SESSION["roomID"]);
//                foreach ($users as $user) {
//                    echo concat("<div class='player-name'>", $user['name'], "</div>");
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