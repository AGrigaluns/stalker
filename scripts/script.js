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

/**
 * Navigation menu bar
 */

$(window).resize(function() {
    if (($(window).width() >= "980") && (!$(".menu-bar").is(":visible"))) {
        console.log($(window).width());
        $(".menu-bar").show();
    } else if (($(window).width() < "980") && ($(".menu-bar").is(":visible"))) {
        $(".menu-bar").hide();
    }
});


$(document).ready(function() {

    /**
     * Burger navigation
     */

    $('#burger').on('click',function() {
        $(".menu-bar").slideToggle('300');
    });

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
     * modal for images
     * @param img
     */

    function loadImg(img) {
        let srcLg = img.data('src');
        $('#imgInModal').attr('src', srcLg);
        $('#exampleModalCenter').modal('show');
    }

    /**
     * Registration Form redirect
     */

    $('#signInBtn').click(function(e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();
        $.ajax({
          url: 'controllers/autoController.php',
          data: {
              username: username,
              password: password,
          },
            type: 'post',
          success: function (output) {
              let redirectOutput = JSON.parse(output);
              if (redirectOutput.errors === false) {
                  alert('User name or email is incorrect!');
              } else {
                  window.location.href = 'index.php';
              }
          }
        });
    });

    $('#signUpBtn').click(function(e) {
        e.preventDefault();
        let fullName = $('#fname').val();
        let username = $('#username').val();
        let password = $('#password').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let address = $('#adr').val();
        let city = $('#city').val();
        $.ajax({
            url: 'controllers/autoController.php',
            data: {
                fullName: fullName,
                username: username,
                password: password,
                email: email,
                phone: phone,
                address: address,
                city: city,
            },
            type: 'post',
            success: function (output) {
                let redirectOutput = JSON.parse(output);
                if (redirectOutput === false) {

                } else {
                    window.location.href = 'user.php';
                }
            }
        });
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



import './cart';
import './chat';
import './cookies';