<?php

include 'includes/init.php';
include 'includes/header.php';


?>

<div class="signIn">
    <div class="col-50">
        <div class="container">
            <h4>Sign in</h4>
            <form>
                <label for="userName">Username</label>
                <input type="text" name="username" id="username" placeholder="username123">
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control-lg" id="InputPassword" placeholder="********">
            </form>
        </div>
    </div>
</div>

<button type="button" class="regButton">Registration</button>

<div class="regForm">
    <div class="col-50">
        <div class="container">
            <h4>Registration</h4>
            <form>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Janis Ozols">
                <label for="userName">Username</label>
                <input type="text" name="username" id="username" placeholder="username123">
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control-lg" id="InputPassword" placeholder="********">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="Janis@example.com">
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="Rozu iela 14A">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="Riga">
            </form>
        </div>
    </div>
</div>
