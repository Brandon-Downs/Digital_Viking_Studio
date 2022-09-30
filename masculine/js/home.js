/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 2/1/12
 * Time: 12:27 PM
 * To change this template use File | Settings | File Templates.
 */
//global variables
var $ = jQuery.noConflict();

$(document).ready(function () {
    $('.clients .logos img').hide()

    $(window).load(contentLoaded);
});

// all the content has been loaded
function contentLoaded() {


    $('.flexslider').flexslider(
        {
            controlNav: false,
            start:showCaption,
            after:showCaption
        }
    );
    $('.clients .logos img').show()
    $('.clients .logos').flexslider({
        animation: "slide",
        itemWidth: 190,
        itemMargin: 1,
        directionNav: false,
        controlsContainer: '.logos .flex-container'
    });

    function showCaption() {
        // hide all
        $('.flex-caption .title').css('opacity', 0)
        $('.flex-caption .descr').css('opacity', 0)
        // show current
        $('.flex-active-slide .flex-caption ').css('bottom', '30px')
        $('.flex-active-slide .flex-caption ').animate({
            bottom:70
        }, {
            duration:1000
        });
        $('.flex-active-slide .flex-caption .title').delay(400).animate({
            opacity:1
        }, {
            duration:800
        });

        $('.flex-active-slide .flex-caption .descr').delay(500).animate({
            opacity:1
        }, {
            duration:800
        });
    }
}
