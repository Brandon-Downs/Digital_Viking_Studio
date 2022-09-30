/**
 * Created by JetBrains WebStorm.
 * User: sQrt121
 * Date: 12/2/11
 * Time: 4:21 PM
 * To change this template use File | Settings | File Templates.
 */

//global variables
var $ = jQuery.noConflict();


jQuery(document).ready(function () {
    // DOM LOADED

    if ($('.pslider').length)
        Items.create();


    // create event handlers


});


/*-----------------------------------------------------------------------------------*/
// Items
/*-----------------------------------------------------------------------------------*/
var Items = new function () {
    var me = this;
    var nCurrent = 0;


    this.create = function () {

        $('.pslider .assets li:eq(0)').addClass('current first');
        $('.pslider .assets li:eq(1)').addClass('next');
        $('.pslider .assets li:last-child').addClass('last');


        $('.pslider .assets .previous').live("click", function (e) {

            nCurrent--;
            me.selectItem();

        });

        $('.pslider .assets .next').live("click", function (e) {

            nCurrent++;
            me.selectItem();

        });

        // enable click only for current item
        $('.pslider .assets .thumb').click(function (e) {
            if (!$(this).parent().parent().hasClass('current')) {
                e.preventDefault();
            }
        });


        // add mousewheel scroll
        try {
            if ($('.pslider').is(':hover')) disable_scroll();
        }
        catch (err) {
            //Handle errors here
        }
        $('.pslider').hover(
            disable_scroll,
            enable_scroll
        );
        $('.pslider').bind('mousewheel', function (event, delta) {
            delta *= -1;

            if (nCurrent > 0 && delta < 0) {
                nCurrent -= 1;
                me.selectItem();
            }
            if (nCurrent < $('.pslider .assets li').length - 1 && delta > 0) {
                nCurrent += 1;
                me.selectItem();
            }

            return false;
        });

        // add touch
        $(".pslider").touchwipe({
            wipeLeft:function () {
                if (nCurrent < $('.pslider .assets li').length - 1) {
                    nCurrent += 1;
                    me.selectItem();
                }
            },
            wipeRight:function () {
                if (nCurrent > 0) {
                    nCurrent -= 1;
                    me.selectItem();
                }
            },
            wipeUp:function () {
                //alert("up");
            },
            wipeDown:function () {
                //alert("down");
            },
            preventDefaultEvents:true
        });

    }
    this.selectItem = function () {


        $('.pslider .assets li').removeClass('current previous next');
        if (nCurrent > 0)$('.pslider .assets li:eq(' + (nCurrent - 1) + ')').removeClass('current').addClass('previous');
        $('.pslider .assets li:eq(' + nCurrent + ')').removeClass('previous next').addClass('current');
        $('.pslider .assets li:eq(' + (nCurrent + 1) + ')').removeClass('current').addClass('next');

        // info
        //$('.pslider .info .itemcontainer').css('marginTop', '20')
        $('.pslider .info ul.itemcontainer').css('marginTop', function (index) {
            return -nCurrent * $('.pslider .info li').outerHeight();
        });
    }

};


/*-----------------------------------------------------------------------------------*/
// Utilities
/*-----------------------------------------------------------------------------------*/


function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}


function wheel(e) {
    preventDefault(e);
}

function disable_scroll() {
    if (window.addEventListener) {
        window.addEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = wheel;

}

function enable_scroll() {
    if (window.removeEventListener) {
        window.removeEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = null;
}