<?php

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
/**
 * I could not test this code with my database but it should almost work
 */

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == $_POST['confirmPass']) {
        $password = md5($_POST['password']);
    }
}

try {
    if (isset($_POST['submissionType'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($_POST['submissionType'] == 'create'){
            $fullName = $_POST['fullName'];
            $confirmPass = $_POST['confirmPass'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
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
                $user_check_query = "SELECT username,email FROM users WHERE username = ?  OR email = ?";

                $stmt = $mysqli->prepare($user_check_query);
                $stmt->bind_param('ss', $username, $email);
                $stmt->bind_result($usernameDb, $emailDb);

                if ($stmt->execute()) {
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
                } else {
                    throw new Exception('could not query db');
                }
            }
            if (count($errors) === 0) {
                $query = "INSERT INTO users SET full_name = ?, username = ?, password = ?, email = ?, phone = ?, adress = ?, city = ?";
                $stmt = $mysqli->prepare($query);
                if ($stmt === false) {
                    throw new Exception('Could not prepare the query : '. $query);
                }
                $stmt->bind_param('sssssss', $fullName,$username, $password, $email, $phone, $address, $city);

                if ($stmt->execute()) {
                    $user_id = $stmt->insert_id;
                    $stmt->close();
                } else {
                    throw new Exception("Insertion could not be made error was : ".$stmt->error);
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
        } elseif ($_POST['submissionType'] == 'login') {
            if (empty($username)) {
                $errors['username'] = 'Username or email required';
            }
            if (empty($password)) {
                $errors['password'] = 'Password required';
            }
            if (count($errors) === 0) {
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
        } else {
            throw new Exception('The submission type is not recognized');
        }
    } else {
        throw new Exception('go to hell');
    }
} catch (Exception $ex) {
    $errors = $ex->getMessage();
}

echo json_encode($errors);
