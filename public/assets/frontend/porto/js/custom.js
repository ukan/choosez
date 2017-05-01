jQuery(function ($) {
    var url = window.location.href;
    $('.nav li a[href="'+url+'"]').parent().addClass('active');
    // header
    $(function () {
        var shrinkHeader = 100;
        $(window).scroll(function () {
            var scroll = getCurrentScroll();
            if (scroll >= shrinkHeader) {
                $('.header-body').addClass('fixed');
            }
            else {
                $('.header-body').removeClass('fixed');
            }
        });
        function getCurrentScroll() {
            return window.pageYOffset || document.documentElement.scrollTop;
        }
    });

    // page nav
    $("#labsNav").click(function () {
        $('html, body').animate({
            scrollTop: $("#labsSection").offset().top
        }, 2000);
    });

    $("#supportNav").click(function () {
        $('html, body').animate({
            scrollTop: $("#supportSection").offset().top
        }, 2000);
    });

    $('.quote-carousel').owlCarousel({
          loop: true,
          margin: 0,
          items: 1,
          nav: false
      });

    // video
    $(".player").mb_YTPlayer();
    // video play
    function smtPlay() {
        var trigger = $("body").find('[data-toggle="modal"]');
        trigger.click(function () {
            var theModal = $(this).data("target"),
                videoSRC = $(this).attr("data-theVideo"),
                videoSRCauto = videoSRC + "?autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function () {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    }

    smtPlay();



});