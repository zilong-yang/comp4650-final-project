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
        $roomID = getRoomID($_SESSION['userID']);
        echo $roomID;
        ?>
    </title>
    <link rel="stylesheet" href="room.css">
</head>

<body>
<div id="window">
    <table id="table">
        <tr id="room-title">
            <th colspan="2">Room <?php echo $roomID ?></th>
        </tr>
        <tr id="header">
            <th class="players">Players</th>
            <th id="money">Your have:</th>
        </tr>
        <tr id="info">
            <td id="players-list" class="players">
                <?php
                $users = getUsers($roomID);
                foreach ($users as $user) {
                    echo concat("<div class='player-name'>", $user['name'], "</div>");
                }
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