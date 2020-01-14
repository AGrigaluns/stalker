<?php

ini_set('display_errors', E_ALL);

$data = ['title' => 'anomalies'];
include 'includes/init.php';
include 'includes/header.php';
$senderId = 1;
/**
 * @todo check that a user is logged in and is an admin. the table users will contain a column "is_admin" that is boolean
 */

if($_SESSION['user_name']['user_id'] == false OR $_SESSION['user_name']['user_id'] == true) {
    echo 'Cannot access! Only Admin';
} else {
    if($_SESSION['user_name']['user_id'] == true) {
        echo 'Welcome Admin';
    }
}



/**
 * retrieve all other user with mysql to be able to display a select dropdown
 *
 */
$stmt = $mysqli->prepare("SELECT id, user_name FROM user_dat");
/** here the results need bound to variables */
$stmt->execute();
$stmt->bind_result($recieverId, $user_name);
?>
<div id="formAdmin">
    <form class="formContainer" id="chatForm">
        <h3>Chat</h3>
        <input type="hidden" value="<?= $senderId ?>" name="user_id" id="user_id">
        <!-- displays a selected dropdown to select the user we want to chat with -->
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


<?php
include 'includes/footer.php';

?>

