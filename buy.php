<?php
include 'includes/init.php';
$productId = $_POST['product'];
/**
 * check if product exists and is available in stock
 */

$availableProduct = "";

$stmt = $mysqli->prepare("SELECT id FROM products WHERE id = ?");
print_r($mysqli->error);
$stmt->bind_param("i", $productId);
$stmt->execute();
$stmt->bind_result($id);
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->fetch();
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]['qty']++;
        $message = 'Quantity was updated';
    } else {
        $_SESSION["cart"][$id] = ['qty' => 1];
        $message = 'Product added';
    }
}
/** foreach product check qty and add it to a variable */

$totalQty = 0;

foreach ($_SESSION["cart"] as $item) {
    $totalQty += $item['qty'];
}

/**
 * foreach ($_SESSION["cart"] as $qty) {
 *
 * $productName = $qty["product_name"];
 * $productDescription = $qty["product_description"];
 * $productPicture = $qty["product_picture"];
 * $product_qty = $qty["product_qty"];
 * $productPrice = $qty["product_price"];
 * }
 */

echo json_encode(['results' => $message, 'qtyincart' => $totalQty]);

$stmt->close();



