import 'jquery';

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

$(document).ready(function () {

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

});