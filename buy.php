<?php
include 'includes/init.php';
$productId = $_POST['product'];

/**
 * check if product exists and is available in stock
 */

$availableProduct = "";
$_SESSION['cart']['products'][] = $availableProduct;

$stmt = $mysqli->prepare("SELECT id, product_name, product_description, picture, price FROM products WHERE id = ?");
print_r($mysqli->error);
$stmt->bind_param("i", $idType);

$stmt->execute();
$stmt->bind_result($id,$productName, $productDesc, $productPic, $productPrice);

$stmt->fetch();

$stmt->close();

if (isset($_POST["add"])){
    if (isset($_SESSION["cart"])){
        $item_array_id = array_column($_SESSION["cart"],"product_id");
        if (!in_array($_GET["id"],$item_array_id)){
            $item_array = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_picture' => $_POST["picture"],
            );
            $_SESSION["cart"][] = $item_array;
            echo json_encode(['results' => 'Product added']);
        } else{
            echo json_encode(['results' => 'Product already added']);
        }
    } else{
        $item_array = array(
            'product_id' => $_GET["id"],
            'product_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'item_picture' => $_POST["picture"],
        );
        $_SESSION["cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])){
    if ($_GET["action"] == "delete"){
        foreach ($_SESSION["cart"] as $keys => $value){
            if ($value["product_id"] == $_GET["id"]){
                unset($_SESSION["cart"][$keys]);
            }
        }
    }
}



