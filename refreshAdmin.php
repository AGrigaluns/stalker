<?php

$message = htmlentities($_POST['message']);

include 'includes/databaseconnect.php';

$senderId = null;

try {
    $recieverId = $_POST['reciever_id'];
    /**
     * This query gets all messages that are new for defined sender and reciever
     */
    $stmt = $mysqli->prepare("SELECT id, message FROM message where sender_id = ? or receiver_id = ?");
    $stmt->bind_param('ii', $recieverId, $recieverId);
    $stmt->execute();
    /**
     * We store results to be able to use num_rows
     */
    $stmt->store_result();
    if ($stmt->num_rows >= 1) {
        $messages = array();
        /** This binds result. We have two column per line id and message. Id is bound to messageId and message to message */
        $stmt->bind_result($messageId, $message);
        /**
         * While the statement (stmt) contains results, we fetch a new one and the new values replace old ones for message
         * and messageId
         */
        while ($stmt->fetch()) {
            /**
             * We add new message to the array that will be sent to JS
             */
            $messages[] = $message;
        }
        //send a positive result to JS using JSON format
        echo json_encode(['results' => $messages]);
    } else {
        //send a negative result (no new message)
        echo json_encode(['results' => 0]);
    }
    $stmt->close();
} catch (Exception $exception) {
    echo json_encode(['errors' => [$exception->getMessage()]]);
}







