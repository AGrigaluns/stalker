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
        <img class="pic" src="img/<?= $productPic ?>">
        <p><?= $productDesc ?></p>
        <p><?= $productPrice ?></p>
        <button class="buy" id="<?= $id ?>">Buy</button>
        <p class="stock">PRODUCT AVAILABILITY:</p>
        <?php
        $idCode = null;
        $qty = 20;
        $totalcost = 0;
        $qtyout = 0;
        if ($result = $mysqli->query("SELECT id, in_stock, product_name, price FROM products WHERE id = '$idCode order by unit_price asc'")) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($qty > 0) {
                    $bothout = 0;
                    $rem = max($row['qty']-$qty,0);
                    if($rem == 0) {
                        $batchout = $row['qty'];
                        } else {
                            $batchout = $qty;
                            }
                            $totalcost += ($batchout * $row['unit_price']);
                            $qty -= $batchout;
                            $qtyout += $batchout;
                            $sql = "Update products set in_stock = (qty - $batchout) where price = ".$row["auto_inc"];
                            echo $sql."</br>";
                            $mysqli->query($sql);
                    }
                }
            }
        ?>
        <p class="inStock">In Stock</p>

    <?php
    endwhile;

    $stmt->close();
 ?>

<?php
endif;
include 'includes/footer.php';

?>
