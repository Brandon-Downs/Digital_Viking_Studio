//On DOM Load
jQuery(document).ready(function($) {

    $('#main-nav .menu').slicknav({
        label: '',
        allowParentLinks: true,
        init: function(){
            $('.slicknav_nav').width($(window).width());
            $('.slicknav_nav').height($(window).height());
        }
    });

    $('#dvsSlider .slides').slick({
        adaptiveHeight: false,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: true,
        fade: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 300,
        prevArrow: '<i class="fas fa-angle-left"></i>',
        nextArrow: '<i class="fas fa-angle-right"></i>',
        // responsive: [
        //     {
        //         breakpoint: 768,
        //         settings: {
        //             arrows: false,
        //             centerMode: true,
        //             centerPadding: '40px',
        //             slidesToShow: 1
        //             }
        //         },
        //     {
        //         breakpoint: 480,
        //         settings: {
        //         arrows: false,
        //             centerMode: true,
        //             centerPadding: '40px',
        //             slidesToShow: 1
        //         }
        //     }
        // ]
    })

    $(window).on('resize scroll', function(){
        $('.slicknav_nav').width($(window).width());
        $('.slicknav_nav').height($(window).height());
    });
});