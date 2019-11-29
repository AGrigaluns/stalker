<?php
include 'includes/init.php';
include 'includes/header.php';
?>
    <div class="shoppingBasket">

        <form method="post" action="buy.php">

            <div class="product">
                <img src="" class="img-responsive">
                <h5 class="text-info"></h5>
                <h5 class="text-danger"></h5>
                <input type="text" name="id" value="">
                <input type="hidden" name="name" value="">
                <input type="hidden" name="price" value="">
                <input type="hidden" name="description" values="">
                <input type="hidden" name="picture" value="">
                <input type="submit" name="add" class="btn-success" value="add to cart">
            </div>
        </form>
    </div>
    <div class="table-responsive">
    <h3 class="title2">Shopping Cart Details</h3>
        <table class="table-bordered">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Pictures</th>
                <th>Price</th>
                <th>Remove Item</th>
            </tr>
            <tr>
                <td><?php echo $values["name"] ?></td>
                <td><?php echo $values["description"] ?>></td>
                <td><img src="<?php echo $values["picture"] ?>"> </td>
                <td><?php echo $values["price"] ?></td>
                <td><button type="button" name="removeItem" class="removeItem">Remove</button></td>
            </tr>
            <tr>
                <th>Total</th>
                <th></th>
                <th></th>
                <th>20 euro</th>
            </tr>
        </table>
        <button class="checkout" type="button" name="checkout">Proceed to checkout</button>
    </div>

<?php
include 'includes/footer.php';

?>