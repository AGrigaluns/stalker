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
$stmt = $mysqli->prepare("SELECT id, product_name, product_description, picture, price FROM products WHERE id_type = ?");
print_r($mysqli->error);
$stmt->bind_param("i", $idType);

$stmt->execute();
$stmt->bind_result($id,$productName, $productDesc, $productPic, $productPrice);

while ($stmt->fetch()) : ?>
    <div class="books">
        <h2><?= $productName ?></h2>
        <img id="pic" src="img/<?= $productPic ?>">
        <p><?= $productDesc ?></p>
        <p><?= $productPrice ?></p>
        <button class="buy" id="wasteland-<?= $id ?>">Buy</button>
        <button class="addCard" id="card-<?= $id ?>">Add to card</button>
    </div>
    <?php
    endwhile;

    $stmt->close();
 ?>

<?php
endif;
include 'includes/footer.php';

?>
