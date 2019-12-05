<?php
include 'includes/init.php';

/**
 * Explode the $_POST['productId'] to get the part that contains the id of product (eg substring, explode)
 * Unset the array entry that has the product ID corresponding to what we've got
 * Return 1 in case of success, 0 in case of failure
 */

$parts = explode('_', $_POST['productId']); //we want to explode using underscore not comma
$productId = $parts[1]; //the product id is the second part of the string
$error = '1';
if ($productId) {
    if (isset($_SESSION) && isset($_SESSION['cart'])) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $error = 'The product with id : '. $productId . ' is not in the cart';
        }
    } else {
        $error = 'no cart was found';
    }
}
echo $error;







