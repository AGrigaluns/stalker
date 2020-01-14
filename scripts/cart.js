import 'jquery';

function confirmPay (data) {
    let confirmPay = JSON.parse(data);
}


$(document).ready(function() {
    $('.buy').click(function () {
        let productID = $(this).attr('id');
        $.post({
            url: 'controllers/ajax/buy.php',
            data: {product: productID},
            type: "post",
            success: function (response) {
                let parsedResponse = JSON.parse(response);
                $('#alerts').html(parsedResponse.results);
                $('#amountInCart').html(parsedResponse.qtyincart);
            }
        });
    });

    $('.clearCart').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: 'controllers/ajax/clearCart.php',
            async: true,
            cache: false,
            success: function (data) {
                if (data == 1) {
                    /**
                     * i think i need to display '#alerts' in cart.php with php
                     */
                    $('#alerts').addClass(['alert', 'alert-success']);
                    setTimeout(function () {
                        window.location.href = "cart.php";
                    }, 2000);
                } else {
                    $('#alerts').html('nothing happened').addClass(['alert', 'alert-info']);

                    //$('#amountInCart').html('');
                    location.reload();
                    //update amount in cart
                    //refresh page
                }
            }
        })
    });

    $('.removeItem').click(function (e) {
        e.preventDefault();
        let productId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: 'controllers/ajax/removeItem.php',
            async: true,
            cache: false,
            data: {'productId': productId},
            success: function (data) {
                if (data == '1') {
                    location.reload();
                } else {
                    $('#alerts').html(data);
                }
            }
        })
    });

    $('.increment-btn').click(function (e) {
        e.preventDefault();
        let operation;
        if ($(this).hasClass('minus-btn')) {
            operation = 'decrement';
        } else if ($(this).hasClass('plus-btn')) {
            operation = 'increment';
        }
        let qtyElement = $(this).siblings('.qty').first();
        let productId = qtyElement.attr('id');
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: 'controllers/ajax/incrementShop.php',
            async: true,
            cache: false,
            data: {'productId': productId, 'operation': operation},
            json: true,
            success: function (rawdata) {
                let data = JSON.parse(rawdata);
                if (data.error == 1) {
                    qtyElement.val(data.qty);
                    $(data.totalId).html(data.price);
                    let totalInclTax = 0;
                    $('.lineTotal').each(function () {
                        let rawHtml = $(this).html();
                        totalInclTax += parseFloat(rawHtml);
                    });
                    totalInclTax = Math.round(totalInclTax * 100) / 100;
                    let vat = Math.round(totalInclTax * 0.21 * 100) / 100;
                    let totalExclTax = totalInclTax - vat;
                    $('#totalExclTax').html(totalExclTax.toFixed(2));
                    $('#vatBox').html(vat.toFixed(2));
                    $('#totalInclTax').html(totalInclTax.toFixed(2));
                } else {
                    $('#alerts').html(data.error);
                }
            }
        })
    });

    $('.checkOutBtn').click(function (e) {
        e.preventDefault();
        $('#alerts').alert('Thank You For Your Purchase');
        window.location.href = "cart.php";
    });

});