<?php
include 'includes/init.php';

/**
 * Explode the $_POST['productId'] to get the part that contains the id of product (eg substring, explode)
 * Unset the array entry that has the product ID corresponding to what we've got
 * Return 1 in case of success, 0 in case of failure
 */

$_POST['productId'];
explode(',', $_POST['productId']);
unset($_POST['productId']);
if ($_POST['productId'] === 1) {
    return ('Success');
} else {
   if ($_POST['productId'] === 0) {
       return ("failure");
   }
}







