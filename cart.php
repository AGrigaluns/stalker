<?php
include 'includes/init.php';
include 'includes/header.php';
/**
 * 1- get cart from the session
 * 2- create a variable total that will permit to calculate it
 * 3- for each item retrieve the product from db
 *      3- display with price and qty
 *      4- calculate total for the line, display it and add it to total
 * 5- display total with and without VAT and VAT
 * 6- BONUS : propose shipping and payment methods with radio buttons
 */

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
if (empty($cart)) :
    echo "Your cart is empty";
else :
    $products = array_keys($cart);
    $total = 0.00;
    ?>
    <div class="table-responsive">
        <h3 class="title2">Shopping Cart Details</h3>
        <table class="table-bordered">
            <thead>
            <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Remove Item</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stmt = $mysqli->prepare("SELECT product_name, product_description, picture, price FROM products WHERE id = ?");
            foreach ($cart as $productId => $item) :
                $stmt->bind_param('s', $productId);
                $stmt->execute();
                $stmt->bind_result($productName, $productDescription, $picture, $price);
                $stmt->fetch();
                $lineTotal = (float)$price * (int)$item['qty'];
                $total += $lineTotal; ?>
                <tr>
                    <td><img src="img/<?= $picture ?>" alt="<?= $productName ?>"/></td>
                    <td><?= $productName ?></td>
                    <td>
                        <div class="input-group plus-minus-input">
                            <div class="input-group-button">
                                <button type="button" class="button hollow circle minus-btn increment-btn" data-quantity="minus"
                                        data-field="quantity">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input class="input-group-field qty" type="text" name="quantity" value="<?= $item['qty'] ?>"
                                       id="qty_<?= $productId ?>" disabled>
                                <button type="button" class="button hollow circle plus-btn increment-btn" data-quantity="plus"
                                        data-field="quantity">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td><?= $price ?></td>
                    <td id="linetotal_<?= $productId ?>" class="lineTotal"><?= $lineTotal ?></td>
                    <td>
                        <button type="button" name="removeItem" class="removeItem" id="item_<?= $productId ?>">x
                        </button>
                    </td>
                </tr>
                <!-- endforeach -->
            <?php endforeach; ?>
            <?php
            $vat = round($total * 0.21, 2);
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Shipping</th>
                <th></th>
            </tr>
            <tr>
                <th>Total (tax excl.)</th>
                <th id="totalExclTax"><?= $total - $vat ?></th>
            </tr>
            <tr>
                <th>VAT</th>
                <th><?= $vat ?></th>
            </tr>
            <tr>
                <th>Total</th>
                <th><?= $total ?></th>
            </tr>
            </tfoot>
        </table>
        <button class="clearCart" type="button" name="emptycart" value="Remove all">Empty cart</button>
        <button class="checkout" type="button" name="checkout">Proceed to checkout</button>
    </div>

<?php
endif;
include 'includes/footer.php';

?>