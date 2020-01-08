import 'jquery';

$(document).ready(function() {
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
                    //$('#amountInCart').html('');
                    location.reload();
                    //update amount in cart
                    //refresh page
                }
            }
        })
    });
});