import 'bootstrap';

window.onscroll = function() {myFunction()};

let navigator = document.getElementById("navBar");
let sticky = navigator.offsetTop;

let acc = document.getElementsByClassName("accordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navigator.classList.add("sticky")
    } else {
        navigator.classList.remove("sticky");
    }
}

let chatLog = document.getElementsByClassName("chat").innerHTML;

function openForm() {
    document.getElementById("chatForm2").style.display = "block";
}

function closeForm() {
    document.getElementById("chatForm2").style.display = "none";
}

function setCookie(cname, cvalue, cdays) {
    let d = new Date();
    d.setTime(d.getTime() + (cdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + cdays + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
let cookieValue = getCookie("alvis");

if (typeof cookieValue !== 'undefined' && cookieValue !== '') {
    $('#myForm').slideToggle('300');
    $('#user-data').slideToggle('300');
    let data = JSON.parse(cookieValue);

    $("#name1").html(data.name);
    $("#email1").html(data.mail);
    $("#phone1").html(data.phone);
    $("#messbox").html(data.message);
    $("#date").html(data.date);
}

$("#myForm").on('submit', function (ev) {
    ev.preventDefault();
    let d = new Date();
    $("#date").html(d.toDateString());

    let name = $("#firstname").val();
    let secname = $("#surname").val();
    let mail = $("#email").val();
    let phone = $("#phone").val();
    let message = $("#message").val();

    $("#name1").html(name + " " + secname);
    $("#email1").html(mail);
    $("#phone1").html(phone);
    $("#messbox").html(message);
    $('#myForm').slideToggle('300');
    $('#user-data').slideToggle('300');

    let formValues = {
        'name': name + " " + secname,
        'mail': mail,
        'phone': phone,
        'message': message,
        'date': d.toDateString()
    };

    setCookie('alvis', JSON.stringify(formValues), 30);

});


$(document).ready(function() {
    $(".btn").click(function (e) {
        e.preventDefault();
        let clickBtnValue = $(this).val();
        let username = $("#sender").val();
        let message = $("#messageUser").val();
        let user_id = $("#user_id").val();
        let reciever_id = $("#reciever_id").val();
        $.ajax({
            url: 'sendMessage.php',
            data: {
                username: username,
                message: message,
                user_id: user_id,
                reciever_id: reciever_id
            },
            type: 'post',
            success: function (output) {
                let parsedOutput = JSON.parse(output);
                if (parsedOutput.errors == false) {
                    $('#sender').attr('readonly', true);
                    $('#user_id').val(parsedOutput.sender_id);
                    $('#messages').append(parsedOutput.message + '<br>');
                } else {
                    //display warning to the user alert() or popin or ...
                }
            }
        });
    });
    $(function () {
        setInterval(function () {
            //get reciever and sender id and pass them to chat.php
            let sender = $("#user_id").val();
            let reciever = $("#reciever_id").val();
            $.ajax({
                url: 'chat.php',
                data: {do: 'new_messages', sender: reciever, reciever: sender},
                type: "post",
                success: function (response) {
                    updateMessages(response);
                }
            });
        }, 5000);
    });
    $('#reciever_id').change(function (ev) {
        $('#messages').html('');
        let sender = $("#user_id").val();
        let reciever = $("#reciever_id").val();
        $.post({
            url: 'chat.php',
            data: {do: "messages_grab", sender: reciever, reciever: sender},
            type: "post",
            success: function (response) {
                updateMessages(response);
            }
        });
    });
    $('.buy').click(function () {
        let productID = $(this).attr('id');
        $.post({
            url: 'buy.php',
            data: {product: productID},
            type: "post",
            success: function (response) {
                /**
                 * display warning message and update amount of products in cart
                 */
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
            url: 'clearCart.php',
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

    $('.removeItem').click(function (e) {
        e.preventDefault();
        let productId = $(this).attr('id');
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: 'removeItem.php',
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

    $('.fa-plus').click(function (e) {
        e.preventDefault();
        let increment = $(this).attr('id');
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: 'incrementShop.php',
            async: true,
            cache: false,
            dataType: "json",
            data: {'incrementId': increment},
            success: function (data) {
                if (data == 1) {
                    if (data == '1') {
                        location.reload();
                    } else {
                        $('#alerts').html(data);
                    }
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
            url: 'incrementShop.php',
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
});

    function updateMessages(response) {
        let parsedOutput = JSON.parse(response);
        if (parsedOutput.results !== 0) {
            parsedOutput.results.forEach(function (message) {
                let dbSender = message.sender;
                let sender = $("#user_id").val();
                let msgClass = 'theirs';
                if (sender == dbSender) {
                    msgClass = 'mine';
                }
                $('#messages').append('<div class="' + msgClass + '">' + message.text + '</div>');
            });
        }
    }

$('#burger').on('click',function() {
    $(".menu-bar").slideToggle('300');
});

$(window).resize(function() {
    if (($(window).width() >= "980") && (!$(".menu-bar").is(":visible"))) {
        console.log($(window).width());
        $(".menu-bar").show();
    } else if (($(window).width() < "980") && ($(".menu-bar").is(":visible"))) {
        $(".menu-bar").hide();
    }
});

($('.regButton'));
$('.regButton').click(function (e) {
    e.preventDefault();
    $('.regForm').slideToggle('300');
});

$('.imgInput').click(function (e) {
    e.preventDefault();
    $('#exampleModalCenter').modal('show')
});






/*
    Get data from the form upon submission (username and message)
    Make ajax call to sendMessage.php
    Read answer from the call and inform user (success vs error)
 */

