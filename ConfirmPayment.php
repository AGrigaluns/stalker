<?php

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$errors = [];
$messages = [];

try {
    if (isset($_POST['payment'])) {

            $city = $_POST['city'];
            if (empty($username)) {
                throw new Exception("Username is required");
            }
            if (empty($email)) {
                throw new Exception("Email is required");
            }
            if (empty($password)) {
                throw new Exception("Password is required");
            } elseif (!empty($password) && !empty($confirmPass) && $password != $confirmPass) {
                throw new Exception("The two passwords do not match");
            }}}