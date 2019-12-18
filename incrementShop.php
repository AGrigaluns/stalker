<?php

include 'includes/init.php';


/**
$incrementId = pg_escape_string($_POST['increment_id']);

$stmt = $mysqli->prepare("SELECT id FROM products WHERE id = '$incrementId'");

$count = $results[0]['positive'];

echo json_encode(array(
'id' => $incrementId,
'count' => $count
));
*/

$parts = explode('_', $_POST['productId']); //we want to explode using underscore not comma
$productId = $parts[1]; //the product id is the second part of the string
$error = '1';
$qty = 0;
$price = 0;
$_SESSION["cart"]['total'];
if ($productId) {
    if (isset($_SESSION) && isset($_SESSION['cart'])) {
        if (isset($_SESSION['cart'][$productId])) {

            $stmt = $mysqli->prepare("SELECT price FROM products WHERE id = ?");

            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $stmt->bind_result($pricePerItem);
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
                        $_SESSION["cart"][$productId]['qty']++;
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

/*$increment = $_POST['incrementId'];

$availableProduct = "";
    $stmt->fetch();
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]['qty']++;
    } else {
        $_SESSION["cart"][$id] = ['qty' => 1];
    }


$totalQty = 0;

foreach ($_SESSION["cart"] as $item) {
    $totalQty += $item['qty'];
}


echo json_encode(['increment' => $totalQty]);

$stmt->close();*/
