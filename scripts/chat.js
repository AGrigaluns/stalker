import 'jquery';

let chatLog = document.getElementsByClassName("chat").innerHTML;

function openForm() {
    document.getElementById("chatForm2").style.display = "block";
}

function closeForm() {
    document.getElementById("chatForm2").style.display = "none";
}

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

$(document).ready(function () {

    $("#chatButtonFooter").click(function (e) {
        e.preventDefault();
        $("#chatForm2").show();
    });

    $("#formClose").click(function (e) {
        e.preventDefault();
        $("#chatForm2").hide();
    });

    $("#chatBtn").click(function (e) {
        e.preventDefault();
        let username = $("#sender").val();
        let message = $("#messageUser").val();
        let user_id = $("#user_id").val();
        let reciever_id = $("#reciever_id").val();
        $.ajax({
            url: 'controllers/ajax/sendMessage.php',
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
                url: 'controllers/ajax/chat.php',
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
            url: 'controllers/ajax/chat.php',
            data: {do: "messages_grab", sender: reciever, reciever: sender},
            type: "post",
            success: function (response) {
                updateMessages(response);
            }
        });
    });

});