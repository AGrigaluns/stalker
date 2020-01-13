<?php

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$parts = explode('_', $_POST['productId']); //we want to explode using underscore not comma
$productId = $parts[1]; //the product id is the second part of the string
$error = '1';
$qty = 0;
$price = 0;
if ($productId) {
    if (isset($_SESSION) && isset($_SESSION['cart'])) {
        if (isset($_SESSION['cart'][$productId])) {

            $stmt = $mysqli->prepare("SELECT price, in_stock FROM products WHERE id = ?");

            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $stmt->bind_result($pricePerItem, $stock);
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                switch ($_POST['operation']) {
                    case 'decrement' :
                        $_SESSION["cart"][$productId]['qty']--;
                        if ($_SESSION["cart"][$productId]['qty'] == 0) {
                            unset($_SESSION['cart'][$productId]);
                        }
                        break;
                    case 'increment' :
                        if ($_SESSION["cart"][$productId]['qty'] + 1 > $stock) {
                            $_SESSION["cart"][$productId]['qty'] = $stock;
                            $error = "We do not have enough stock. Quantity have been reset to the maximum you can get.";
                        } else {
                            $_SESSION["cart"][$productId]['qty']++;
                        }
                        break;
                    default :
                        $error = "Tell me which operation I should do !";
                }
                $qty = $_SESSION["cart"][$productId]['qty'];
                $price = $qty * $pricePerItem;
            }
            $stmt->close();
        } else {
            $error = 'The product with id : '. $productId . ' is not in the cart';
        }
    } else {
        $error = 'no cart was found';
    }
}

echo json_encode(['error' => $error, 'qty' => $qty, 'price' => $price, 'totalId' => '#linetotal_'.$productId]);

