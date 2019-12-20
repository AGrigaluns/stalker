<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
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


echo json_encode(['results' => $message, 'qtyincart' => $totalQty]);

$stmt->close();



