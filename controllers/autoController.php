<?php

include 'includes/init.php';
/**
 * I could not test this code with my database but it should almost work
 */

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == $_POST['confirmPass']) {
        $password = md5($_POST['password']);
    }
}

if (isset($_POST['create'])) {
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
}

if (empty($username)) {
    array_push($errors, "Username is required");
}
if (empty($email)) {
    array_push($errors, "Email is required");
}
if (empty($password)) {
    array_push($errors, "Password is required");
} elseif (!empty($password) && !empty($confirmPass) && $password != $confirmPass) {
    array_push($errors, "The two passwords do not match");
}

if (empty($errors)) {
    /**
     * you need to have a users table better than register that does not speak a lot to other developers :)
     */
    $user_check_query = "SELECT username,email FROM users WHERE username = ?  OR email = ?";

    $stmt = $mysqli->prepare($user_check_query);
    $stmt->bind_param($username, $email);
    $stmt->bind_result($usernameDb, $emailDb);

    $stmt->execute();

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if ($usernameDb === $username) {
            array_push($errors, "Username already exists");
        }

        if ($emailDb === $email) {
            array_push($errors, "email already exists");
        }
    }
}

if (count($errors) === 0) {
    /**
     * insert should be in users table not in register
     */
    $query = "INSERT INTO users SET username = ?, password = ?";
    $stmt = $mysqli->prepare($query);
    $result = $stmt->execute();

    if ($result) {
        $user_id = $stmt->insert_id;
        $stmt->close();
    }

    $_SESSION['id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['verified'] = false;
    $_SESSION['message'] = 'You are logged in!';
    $_SESSION['type'] = 'alert-success';
} else {
    $_SESSION['error_msg'] = "Database error: Could not register user";
}

if (isset($_POST['signBtn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        /**
         * if your users are stored in users (for a while you seem to call it register) you need to query from users
         * SELECT * FROM register WHERE username=? OR password=? LIMIT 1
         * but really better use users :)
         *
         * I changed the var name to $query as $mysqli contains the connection to database
         */
        $query = "SELECT * FROM users WHERE username=? OR password=? LIMIT 1";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';

            } else {
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
