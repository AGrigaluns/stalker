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
console.log('loqded');

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
    console.log($("#date"));
    $("#date").html(d.toDateString());

    let name = $("#firstname").val();
    let secname = $("#surname").val();
    let mail = $("#email").val();
    let phone = $("#phone").val();
    let message = $("#message").val();

    console.log($('#user-data'));

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
    $(".btn").click(function(e){
        console.log(e);
        e.preventDefault();
        let clickBtnValue = $(this).val();
        let username = $("#sender").val();
        let message = $("#messageUser").val();
        let user_id = $("#user_id").val();
        let reciever_id = $("#reciever_id").val();
        $.ajax({ url: 'sendMessage.php',
            data: {
                username : username,
                message: message,
                user_id: user_id,
                reciever_id: reciever_id
            },
            type: 'post',
            success: function(output) {
                let parsedOutput = JSON.parse(output);
                if (parsedOutput.errors == false){
                    $('#sender').attr('readonly', true);
                    $('#user_id').val(parsedOutput.sender_id);
                    $('#messages').append(parsedOutput.message+'<br>');
                } else {
                    //display warning to the user alert() or popin or ...
                }
            }
        });
    });
    $(function() {
        setInterval(function() {
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
        $.post({ url: 'chat.php',
            data: {do: "messages_grab", sender: reciever, reciever: sender},
            type: "post",
            success: function (response) {
                updateMessages(response);
            }
        });
    });
    $('.buy').click(function () {
        let productID = $(this).attr('id');
        $.post({ url: 'buy.php',
            data: {product: productID},
            type: "post",
            success: function (response) {
                console.log(response);
            }
        });
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
            $('#messages').append('<div class="'+ msgClass +'">' + message.text + '</div>');
        });
    }
}







/*
    Get data from the form upon submission (username and message)
    Make ajax call to sendMessage.php
    Read answer from the call and inform user (success vs error)
 */

