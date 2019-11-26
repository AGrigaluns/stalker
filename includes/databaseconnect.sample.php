<?php


/** @var mysqli $mysqli we connect with database */
$mysqli = new mysqli("localhost", "root", "Liepaja1234", "chat");

/** We check if there was no error during connexion */
if (!empty($mysqli->connect_errno)) {
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        die(); //stops the script
    }
}