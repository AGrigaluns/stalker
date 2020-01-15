<?php

include $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';
$errors = [];
$messages = [];

try {
    if (isset($_POST['submissionType'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        switch ($_POST['submissionType']) {
            case 'create' :
                $fullName = $_POST['fullName'];
                $confirmPass = $_POST['confirmPass'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
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
                }
                $user_check_query = "SELECT username,email FROM users WHERE username = ?  OR email = ?";

                $stmt = $mysqli->prepare($user_check_query);
                $stmt->bind_param('ss', $username, $email);
                $stmt->bind_result($usernameDb, $emailDb);

                if ($stmt->execute()) {
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        $stmt->fetch();
                        if ($usernameDb === $username) {
                            throw new Exception("Username already exists");
                        }

                        if ($emailDb === $email) {
                            throw new Exception("email already exists");
                        }
                    }
                } else {
                    throw new Exception('could not query db');
                }
                $query = "INSERT INTO users SET full_name = ?, username = ?, password = ?, email = ?, phone = ?, adress = ?, city = ?";
                $stmt = $mysqli->prepare($query);
                if ($stmt === false) {
                    throw new Exception('Could not prepare the query : ' . $query);
                }
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param('sssssss', $fullName, $username, $password, $email, $phone, $address, $city);

                if ($stmt->execute()) {
                    $user_id = $stmt->insert_id;
                    $messages[] = 'Your user was register';
                    $stmt->close();
                } else {
                    throw new Exception("Insertion could not be made error was : " . $stmt->error);
                }

                $_SESSION['user']['id'] = $user_id;
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['verified'] = false;
                $messages[] = 'You are logged in!';
                break;
            case 'login' :
                if (empty($username)) {
                    throw new Exception('Username or email required');
                }
                if (empty($password)) {
                    throw new Exception('Password required');
                }
                $query = "SELECT * FROM users WHERE username=?  LIMIT 1";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('s', $username);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user['password'])) {
                        $stmt->close();

                        $_SESSION['user']['id'] = $user['id'];
                        $_SESSION['user']['username'] = $user['username'];
                        $_SESSION['user']['email'] = $user['email'];
                        $_SESSION['user']['verified'] = $user['verified'];
                        $_SESSION['user']['is_admin'] = $user['is_admin'];
                        $messages[] = 'You are logged in!';

                    } else {
                        throw new Exception("Wrong username / password");
                    }
                } else {
                    throw new Exception("Database error. Login failed!");
                }
                break;
            case 'logout' :
                unset($_SESSION['user']);
                $messages[] = 'You are logged out!';
                break;
            default :
                throw new Exception('The submission type is not recognized');
        }
    } else {
        throw new Exception('go to hell');
    }
} catch (Exception $ex) {
    $errors = $ex->getMessage();
}

echo json_encode(['errors' => $errors, 'messages' => $messages]);
