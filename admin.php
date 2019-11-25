<?php

ini_set('display_errors', E_ALL);

$data = ['title' => 'anomalies'];
include 'includes/databaseconnect.php';
include 'includes/header.php';
$senderId = 1;

/**
 * retrieve all other user with mysql to be able to display a select dropdown
 *
 */

$stmt = $mysqli->prepare("SELECT id, user_name FROM user_dat");
/** here the results need to be bound to variables */
$stmt->execute();
$stmt->bind_result($recieverId, $user_name);
?>
<div id="formAdmin">
    <form class="formContainer" id="chatForm">
        <h3>Chat</h3>
        <input type="hidden" value="<?= $senderId ?>" name="user_id" id="user_id">
        <!-- display a select dropdown to select the user we want to chat with. It will be done with a while loop. -->
        <select name="reciever_id" id="reciever_id">
            <option value="0">Select user</option>
            <?php
            while ($stmt->fetch()) : ?>
                <option value="<?= $recieverId ?>"><?= $user_name ?></option>
            <?php
            endwhile;
            $stmt->close();
            ?>

        </select>
        <label for="message">Message</label>
        <div id="messages">
            <!-- this part must refresh when the administrator changes the select-->
        </div>
        <textarea name="message" id="messageUser" placeholder="Type message..." required></textarea>
        <button type="submit" class="btn" value="sendMessage">Send</button>
        <button type="button" class="btnCancel" onclick="closeForm()" id="formClose">Close</button>
    </form>
</div>

<script type="text/javascript" src="scripts/script.js"></script>

</body>
</html>

