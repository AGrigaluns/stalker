<?php

ini_set('display_errors', E_ALL);

$data = ['title' => 'anomalies'];
include 'includes/init.php';
try {
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
        throw new Exception('Please log in !');
    }
    if (isset($_SESSION['user']['is_admin']) && empty($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] === 1) {
        throw new Exception('You are not allowed to see that');
    }

    $senderId = 1;
} catch (Exception $ex){
    $errors[] = new stalkerError('danger', $ex->getMessage());
}
include 'includes/header.php';


if (empty($errors)) :
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
endif;
include 'includes/footer.php';

?>

