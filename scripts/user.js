import 'jquery';

/**
 * this will manage the display of errors and messages
 * @todo make this function available for all scripts (move it to script.js) and reuse it when needed (e.g. in cart.js)
 * @param data a
 */

 function manageMessages(data) {
    let parsedData = JSON.parse(data);
    if (Array.isArray(parsedData.errors) && parsedData.errors.length) {
        parsedData.errors.forEach(function (warning) {
            $('#alerts').html(warning);
        });
        $('#alerts').addClass(['alert', 'alert-danger']);
    } else if (Array.isArray(parsedData.messages) && parsedData.messages.length) {
        parsedData.messages.forEach(function (warning) {
            $('#alerts').html(warning);
        });
        $('#alerts').addClass(['alert', 'alert-success']);
        setTimeout(function () {
            window.location.href = "index.php";
        }, 2000);
    } else {
        $('#alerts').html('nothing happened').addClass(['alert', 'alert-info']);
    }
}

$(document).ready(function() {

    /**
     * Registration Form redirect
     */
    $('#signInBtn').click(function (e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();
        $.ajax({
            url: 'controllers/ajax/user.php',
            data: {
                username: username,
                password: password,
                submissionType: 'login'
            },
            type: 'post',
            success: function (data) {
                manageMessages(data);
            }
        });
    });

    $('#signUpBtn').click(function (e) {
        e.preventDefault();
        let fullName = $('#fname').val();
        let username = $('#username').val();
        let password = $('#password').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let address = $('#adr').val();
        let city = $('#city').val();
        $.ajax({
            url: 'controllers/ajax/user.php',
            data: {
                fullName: fullName,
                username: username,
                password: password,
                email: email,
                phone: phone,
                address: address,
                city: city,
                submissionType: 'create'
            },
            type: 'post',
            success: function (data) {
                manageMessages(data);
            }
        });
    });

    $('#logoutBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'controllers/ajax/user.php',
            data: {
                username: '',
                password: '',
                submissionType: 'logout'
            },
            type: 'post',
            success: function (data) {
                manageMessages(data);
            }
        });
    });

    /**
     * registration buttons
     */
    $('.regButton').click(function (e) {
        e.preventDefault();
        $('.regForm').slideToggle('300');
    });

    $('.dropBtn').click(function (e) {
        e.preventDefault();
        $(this).siblings('.dropDown').slideToggle('300');
    });
});