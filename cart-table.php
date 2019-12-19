<?php

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
    <div class="table-responsive2">
        <h3 class="title2">Shopping Cart Details</h3>
        <table class="table2" id="cart-table">
            <thead class="headTable">
            <tr>
                <th scope="col">Product</th>
                <th scope="col" class="th-qty"></th>
                <th scope="col" class="price-cell"></th>
                <th scope="col" class="price-cell">Total</th>
            </tr>
            </thead>
            <tbody class="bodyTable">
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
                        <img src="img/<?= $picture ?>" alt="<?= $productName ?>"/>
                        <?= $productName ?>
                    </td>
                    <td>
                    </td>
                    <td class="price-cell"></td>
                    <td id="linetotal_<?= $productId ?>" class="lineTotal price-cell"><?= $lineTotal ?></td>
                </tr>
                <!-- endforeach -->
            <?php endforeach; ?>
            <?php
            $vat = round($total * 0.21, 2);
            ?>
            </tbody>
            <tfoot class="footTable">
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
    </div>
<?php endif; ?>