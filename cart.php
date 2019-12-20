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
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array(); ?>
<?php if (empty($cart)) :
    echo "Your cart is empty";
else :
    $products = array_keys($cart);
    $total = 0.00;
    ?>
    <div class="table-responsive">
        <h3 class="title2">Shopping Cart Details</h3>
        <table class="table" id="cart-table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col" class="th-qty">Qty</th>
                <th scope="col" class="price-cell">Price</th>
                <th scope="col" class="price-cell">Total</th>
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
                    <td>
                        <span name="removeItem" class="removeItem fa fa-trash-alt" id="item_<?= $productId ?>">
                        </span>
                        <img src="img/shop/<?= $picture ?>" alt="<?= $productName ?>"/>
                        <?= $productName ?>
                    </td>
                    <td>
                        <div class="input-group plus-minus-input">
                            <div class="input-group-button">
                                <span class="fa fa-minus-circle minus-btn increment-btn"
                                        data-quantity="minus"
                                        data-field="quantity">
                                </span>
                                <input class="input-group-field qty" type="text" name="quantity"
                                       value="<?= $item['qty'] ?>"
                                       id="qty_<?= $productId ?>" disabled>
                                <span class="fa fa-plus-circle increment-btn plus-btn"
                                        data-quantity="plus"
                                        data-field="quantity">
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="price-cell"><?= $price ?></td>
                    <td id="linetotal_<?= $productId ?>" class="lineTotal price-cell"><?= $lineTotal ?></td>
                </tr>
                <!-- endforeach -->
            <?php endforeach; ?>
            <?php
            $vat = round($total * 0.21, 2);
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <th>Shipping</th>
                <th class="price-cell">0</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Total (tax excl.)</th>
                <th id="totalExclTax" class="price-cell"><?= number_format($total - $vat, 2) ?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>VAT</th>
                <th id="vatBox" class="price-cell"><?= number_format($vat, 2) ?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Total</th>
                <th id="totalInclTax" class="price-cell"><?= number_format($total, 2) ?></th>
            </tr>
            </tfoot>
        </table>
        <button class="clearCart" type="button" name="emptycart" value="Remove all">Empty cart</button>
        <button class="checkout" type="button" name="checkout"><a href="checkout.php">Proceed to checkout</a></button>
    </div>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>