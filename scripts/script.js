import 'bootstrap';




$(document).ready(function () {

    /**
     * Home page accordion
     * @type {HTMLCollectionOf<Element>}
     */
    $('.accordion').click(function () {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });

    const sticky = $("#navBar").offset().top;

    /**
     * sticky navigation
     */
    $(window).scroll(function () {
        if (window.pageYOffset >= sticky) {
            $("#navBar").addClass("sticky")
        } else {
            $("#navBar").removeClass("sticky");
        }
    });

    /**
     * Navigation menu bar
     */
    $(window).resize(function () {
        if (($(window).width() >= "980") && (!$(".menu-bar").is(":visible"))) {
            console.log($(window).width());
            $(".menu-bar").show();
        } else if (($(window).width() < "980") && ($(".menu-bar").is(":visible"))) {
            $(".menu-bar").hide();
        }
    });

    /**
     * Burger navigation
     */
    $('#burger').on('click', function () {
        $(".menu-bar").slideToggle('300');
    });

    /**
     * manages the display of images in modal
     */
    if (typeof imgSeq !== 'undefined') {
        $('.imgInput').click(function (e) {
            imgSeq = $(this).data('seq');
            loadImg($(this));
        });
        $('#next-btn').click(function () {
            imgSeq++;
            let img = $('#img' + imgSeq);
            loadImg(img);
        });
        $('#prev-btn').click(function () {
            imgSeq--;
            let img = $('#img' + imgSeq);
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

});


import './cart';
import './chat';
import './cookies';
import './user';