<?php

include 'includes/init.php';
include 'includes/header.php';


?>

<!-- this is seccessfull registration form where user gets in his profile -->

<div class="userContainer">
    <div class="row">
        <div class="col-md-4 offset-md-4 home-wrapper">

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert <?php echo $_SESSION['type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['type']);
                    ?>
                </div>
            <?php endif;?>

            <h4>Welcome, <?php echo $_SESSION['username']; ?></h4>
            <a href="logout.php">Logout</a>
            <?php if (!$_SESSION['verified']): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    You need to verify your email address!
                    Sign into your email account and click
                    on the verification link we just emailed you
                    at
                    <strong><?php echo $_SESSION['email']; ?></strong>
                </div>
            <?php else: ?>
                <button class="btn btn-lg btn-primary btn-block">I'm verified!!!</button>
            <?php endif;?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';

