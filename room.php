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
            <th>Players</th>
            <th>Your Money:</th>
        </tr>
        <tr id="info">
            <td>
                <?php
                $users = getUsers($roomID);
                foreach ($users as $user) {
                    echo concat($user['name'], "<br>");
                }
                ?>
            </td>
            <td>

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