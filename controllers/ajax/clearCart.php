<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
unset($_SESSION['cart']);
if (isset($_SESSION['cart'])) {
    echo 0;
} else {
    echo 1;
}
