<?php
include 'includes/init.php';

/**
 * Explode the $_POST['productId'] to get the part that contains the id of product (eg substring, explode)
 * Unset the array entry that has the product ID corresponding to what we've got
 * Return 1 in case of success, 0 in case of failure
 */

$productId = $_POST['productId'];
$productId = explode(",", $productId);
if(isset($_GET['productId']) & !empty($_GET['productId'])){
    $productId = $_GET['productId'];
    unset($productId['productId']);
    $productId = implode(",", $productId);
    $_SESSION['cart'] = $productId;
}






