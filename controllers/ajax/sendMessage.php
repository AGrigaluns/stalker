<?php
/**
 * First we check what comes from the request POST variable.
 *
 * Then we look if the variable can be stored in database (not empty, not with SQL injections...)
 *
 * Escape html, SQL and PHP...
 *
 * Query the database
 * - Retrieve sender and reciever IDS
 * - "INSERT INTO message (id_sender, id_reciever, message) VALUES (?,?,?)"
 */

/** @var string $message the message is stripped of html entities */
$message = htmlentities($_POST['message']);

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$senderId = null;

try {
    /**
     * We have a new message
     */
    if (!empty($message)) {
        //if we have $_POST['user_id'], we check if it exists in the DB
        /**
         * We can first check if a cookie exists with the user id.
         * - Query db for this user id if exists
         * - update $senderId if we have a result
         */
        $userId = $_POST['user_id'];
        /**
         * @todo if the user is logged in, we take the username in session in the datatable user_dat, we need to add a column user_id that can be empty or contains the user_id
         */
        $username = $_POST['username'];
        $recieverId = $_POST['reciever_id'];
        if (!is_null($userId)) {
            $stmtUser = $mysqli->prepare("SELECT id FROM user_dat WHERE id = ?");
            $stmtUser->bind_param("i", $userId);
            $stmtUser->execute();
            $stmtUser->store_result();
        }
        if (($stmtUser->num_rows < 1) && (!is_null($username))) {
            //The user does not exist in DB, we first try to get it using username
            /** @var string $username */
            $stmt = $mysqli->prepare("SELECT id FROM user_dat WHERE user_name = ?");
            $stmt->bind_param("s", $username);

            /* execute query */
            $stmt->execute();

            /* bind result variables */
            $stmt->bind_result($senderId);

            /* fetch value */
            $stmt->fetch();

            /* close statement */
            $stmt->close();
        } elseif ($stmtUser->num_rows >= 1) {
            $senderId = $userId;
        }
        if ($senderId === null){
            /**
             * If we reach this point, it means that user was not found using whether id or name so we create it
             */
            $age = 30;
            $stmt = $mysqli->prepare("INSERT INTO user_dat (user_name, age) VALUES (?, ?)");
            $stmt->bind_param("si", $username, $age);

            /* execute query */
            if ($stmt->execute()) {
                $senderId = $mysqli->insert_id;
                /**
                 * Here we need to set new cookie (longer than the session) with the id of the user that was created
                 */
            }
            $stmt->close();
        }
        if (isset($stmtUser)) {
            $stmtUser->close();
        }
        /**
         * We check that reciever exists for $recieverId
         */
        $stmtReciever = $mysqli->prepare("SELECT id FROM user_dat WHERE id = ?");
        $stmtReciever->bind_param("i", $recieverId);
        $stmtReciever->execute();
        $stmtReciever->store_result();
        if ($stmtReciever->num_rows < 1) {
            /**
             * If not, we throw an exception
             */
            throw new Exception('The user does not exists');
        }
        $stmtReciever->close();

        /** @var string $query create a string of the query and store it in the variable $query */
        $query = "INSERT INTO `chat`.`message` (`sender_id`, `receiver_id`, `message`, `new_messages`) VALUES (?, ?, ?, true)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("iis", $senderId, $recieverId, $message);

        /** @var bool $result */
        $result = $stmt->execute();
        $stmt->close();
        /**
         * a query is performed to database and a result is returned if it is false, the query failed
         */
        if ($result === false) {
            throw new Exception('A problem happened while sending you message');
        }
        /**
         * Prepare answer for the javascript call (preferably JSON)
         */
        echo json_encode(['message' => $message, 'sender_id' => $senderId, 'errors' => false]);
    }
} catch (Exception $exception) {
    echo json_encode(['errors' => [$exception->getMessage()]]);
}









