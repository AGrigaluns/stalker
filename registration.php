<?php
include 'includes/init.php';
include 'includes/header.php';


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
}
if ($password != $confirmPass) {
    array_push($errors, "The two passwords do not match");
}

$user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email'";
$result = mysqli_query($mysqli, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
    }
}




?>

<div class="signIn">
    <div class="col-50">
        <h4>Sign in / Registration</h4>
        <div class="container">
            <h4>Sign in</h4>
            <form class="signIn">
                <label for="userName">Username</label>
                <input type="text" name="username" id="username" placeholder="username123" required>
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control-lg" id="InputPassword" placeholder="********" required>
            </form>
        </div>
        <button type="button" id="signBtn" class="btn btn-primary">Sign in</button>
    </div>
</div>

<button type="submit" class="regButton">Registration</button>

<div class="regForm">
    <div class="col-50">
        <div class="container">
            <h4>Registration</h4>
            <form class="registrationForm" action="registration.php" method="post">
                <label for="fname"><i class="fa fa-user"></i>Full Name</label>
                <input type="text" id="fname" name="fullName" placeholder="Janis Ozols" required>
                <label for="userName">Username</label>
                <input type="text" name="username" id="username" placeholder="username123" required>
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control-lg" name="password" id="password" placeholder="********" required>
                <label for="confirmPass">Confirm password</label>
                <input type="password" class="form-control-lg" name="confirmPass" id="confirmPass" placeholder="********" required>
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="Janis@example.com" required>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="+37100000000" required>
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="Rozu iela 14A" required>
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="Riga" required>
            </form>
        </div>
        <button type="submit" id="signBtn" class="btn btn-primary">Sign up</button>
    </div>
</div>

<?php include 'includes/footer.php';