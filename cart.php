<?php
include 'includes/init.php';

?>
                    <div class="col-md-3">

                        <form method="post" action="#">

                            <div class="product">
                                <img src="" class="img-responsive">
                                <h5 class="text-info"></h5>
                                <h5 class="text-danger"></h5>
                                <input type="text" name="description" value="">
                                <input type="hidden" name="hidden_name" value="">
                                <input type="hidden" name="hidden_price" value="">
                                <input type="submit" name="add" class="btn-success" value="Add to Cart">
                            </div>
                        </form>
                    </div>

        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table-bordered">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Pictures</th>
                <th>Price</th>
                <th>Remove Item</th>
            </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="#"><span class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <tr>
                            <td>Total</td>
                            <th></th>
                            <td></td>
                        </tr>

            </table>
        </div>
    </div>

<?php
include 'includes/footer.php';

?>