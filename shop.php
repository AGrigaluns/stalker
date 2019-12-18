<?php

ini_set('display_errors', E_ALL);

$data = ['title' => 'shop'];
include 'includes/init.php';
include 'includes/header.php';


$type = htmlentities($_GET['type']);

$data = ['type' => $type];

$idType = null;
$typeName = null;
$stmt = $mysqli->prepare("SELECT id, name FROM shop WHERE name = ?");
$stmt->bind_param("s", $type);

$stmt->execute();

$stmt->bind_result($idType, $typeName);

$stmt->fetch();

$stmt->close();

if ($idType === null):
    ?>
    Does not exist...

<?php else : ?>
<?php
$productName = null;
$productDesc = null;
$productPic = null;
$productPrice = null;
$stmt = $mysqli->prepare("SELECT id, product_name, product_description, picture, price, in_stock FROM products WHERE id_type = ?");
print_r($mysqli->error);
$stmt->bind_param("i", $idType);

$stmt->execute();
$stmt->bind_result($id, $productName, $productDesc, $productPic, $productPrice, $qty);

while ($stmt->fetch()) : ?>
<div class="books">
    <h2><?= $productName ?></h2>
    <img class="pic" src="img/<?= $productPic ?>">
    <p><?= $productDesc ?></p>
    <p><?= $productPrice ?></p>
    <div class="addToCart">
    <?php if ($qty > 0) : ?>
        <button class="buy" id="<?= $id ?>">Buy</button>
        <span class="stock">PRODUCT AVAILABILITY:</span><?= $qty ?>
        <div class="inStock">In Stock</div>
    <?php else : ?>
        <div class="outStock">Out of Stock</div>
    <?php endif; ?>
    </div>
    <?php
    endwhile;

    $stmt->close();
    ?>

    <?php
    endif;
    include 'includes/footer.php';

    ?>
