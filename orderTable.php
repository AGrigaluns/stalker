<?php
include 'includes/init.php';
include 'includes/header.php';
?>
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
    <tr>
        <td></td>
        <td></td>
        <th>Shipping</th>
        <th class="price-cell">0</th>
    </tr>
    <tfoot class="footTable">
    <tr>
        <td></td>
        <td></td>
        <th>Shipping</th>
        <th class="price-cell">0</th>
    </tr>


<?php include 'includes/footer.php';