<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$senderId = $_POST['sender'];

$recieverId = $_POST['reciever'];

/**
 * This query gets all messages that are new for defined sender and reciever
 */
if ($_POST['do'] == 'new_messages') {
    $stmt = $mysqli->prepare("SELECT id, message, sender_id FROM message where sender_id = ? and receiver_id = ? and new_messages = true ");
    $stmt->bind_param('ii', $senderId, $recieverId);
} else {
    $stmt = $mysqli->prepare("SELECT id, message, sender_id 
                                        FROM message 
                                        where (sender_id = ? and receiver_id = ?) 
                                        or (receiver_id = ? and sender_id = ?)");
    $stmt->bind_param('iiii', $senderId, $recieverId, $senderId, $recieverId);
}
$stmt->execute();
/**
 * We store results to be able to use num_rows
 */
$stmt->store_result();
if ($stmt->num_rows >= 1) {
    $messages = array();
    /** This binds result. We have two column per line id and message. Id is bound to messageId and message to message */
    $stmt->bind_result($messageId, $message, $senderId);
    /**
     * While the statement (stmt) contains results, we fetch a new one and the new values replace old ones for message
     * and messageId
     */
    while ($stmt->fetch()) {
        /**
         * We add new message to the array that will be sent to JS
         */
        $messages[] = ['sender' => $senderId, 'text' => $message];
        /**
         * next 5 lines are used to update database for the current message
         */
        $query = "UPDATE message SET new_messages=false WHERE id=? AND sender_id=?";
        $stmtUpdate = $mysqli->prepare($query);
        $stmtUpdate->bind_param("ii", $messageId, $senderId);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    }
    //send a positive result to JS using JSON format
    echo json_encode(['results' => $messages]);
} else {
    //send a negative result (no new message)
    echo json_encode(['results' => 0]);
}
$stmt->close();


