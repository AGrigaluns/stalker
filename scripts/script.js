import 'bootstrap';

/**
 * Home page accordion
 * @type {HTMLCollectionOf<Element>}
 */

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

/**
 * sticky navigation
 */

window.onscroll = function() {myFunction()};

let navigator = document.getElementById("navBar");
let sticky = navigator.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navigator.classList.add("sticky")
    } else {
        navigator.classList.remove("sticky");
    }
}



$(document).ready(function() {

/**
 * manages the display of images in modal
 */

    if (typeof imgSeq !== 'undefined'){
        $('.imgInput').click(function (e) {
            imgSeq = $(this).data('seq');
            loadImg($(this));
        });
        $('#next-btn').click(function() {
            imgSeq++;
            let img = $('#img'+imgSeq);
            loadImg(img);
        });
        $('#prev-btn').click(function() {
            imgSeq--;
            let img = $('#img'+imgSeq);
            loadImg(img);
        });
    }

    /**
     * Registration Form redirect
     */

    $('#signInBtn').click(function(e) {
        e.preventDefault();
        let username = $('#username').value();
        let password = $('#password').value();
        if (username === "user123" && password === "username123") {
            alert ("Login successfully");
            window.location.replace("user.php");
        }
        return false;
    });
        /**
        let hasError = false;
        $(".has-error, .has-success").removeClass("has-error").removeClass("has-success");
        if ($("#username").val() == "") {
            $("#username").closest(".signIn").addClass("has-error");
            hasError = true;
        } else {
            $("#username").closest(".signIn").addClass("has-success");
        }
        if ($("#InputPassword").val() == "") {
            $("#InputPassword").closest(".signIn").addClass("has-error");
            hasError = true;
        } else {
            $("#InputPassword").closest(".signIn").addClass("has-success");
        }
        return !hasError;
    });
         */

    $('#signUpBtn').click(function (e) {
        e.preventDefault();
        window.location.replace("user.php");
    })

});

/**
 * navigation menu bar
 */

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

/**
 * registration buttons
 */

($('.regButton'));
$('.regButton').click(function (e) {
    e.preventDefault();
    $('.regForm').slideToggle('300');
});

$('.dropBtn').click(function (e) {
    e.preventDefault();
    $(this).siblings('.dropDown').slideToggle('300');
});

/* modal increment by one for img */
/**

$('.col').click(function() {
    $('.modal-body').empty();
    let title = $(this).parent('a').attr("title");
    $('.modal-title').html(title);
    $($(this).parents('div').html()).appendTo('.modal-body');
    $('#imgInModal').modal({show:true});
});**/

/**
 * modal for images
 * @param img
 */

function loadImg(img) {
    let srcLg = img.data('src');
    $('#imgInModal').attr('src', srcLg);
    $('#exampleModalCenter').modal('show');
}

/* modal increment end */


/*
    Get data from the form upon submission (username and message)
    Make ajax call to sendMessage.php
    Read answer from the call and inform user (success vs error)
 */
import './cart';
import './chat';
import './cookies';