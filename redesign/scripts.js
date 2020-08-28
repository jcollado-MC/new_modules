$(document).ready( function() {

    var search_icon = '<i class=\'fas fa-search\'></i>';
    $('.searchajax_text').append(search_icon);
    $('.searchajax input').attr('placeholder', 'search');

    var burger_menu = '<div id=\'mobile-nav\'> <i class=\'fas fa-bars\'></i> </div>';
    $(burger_menu).insertBefore('#menu');

    $('#logo').clone().appendTo('#mobile-nav');
    $('#user').clone().appendTo('#mobile-nav');

    $('body').on('click', '#mobile-nav', function () {
       $('#menu').toggleClass('active-menu')
    });

    $('#pagebody h1').appendTo('#header');
    $('.searchajax').appendTo('#header');


    $('[name=\"ssr_reload\"]').insertAfter('form[id^=\"ssr\"] .ui-tabs');

    var aside_button = '<button class=\'aside-button\'><i class=\'fas fa-chevron-right\'></i></button>';
    $(aside_button).insertAfter('aside');

    $('#sidebar .cfr_link').addClass('col-12');
    $('#pagebody .cfr_link').addClass('col-3');
    $('.box_area').addClass('col-12');
    $('.cfr_link .link_icon, .cfr_link .icon').addClass('col-2');

    $('.cfr_link .link_text').addClass('col-10');


    $('.aside-button, aside').hover(
        function(){
            $('.aside-button').addClass('active-sidebar-button');
            $('aside').addClass('active-sidebar');
        },
        function (){
            $('.aside-button').removeClass('active-sidebar-button');
            $('aside').removeClass('active-sidebar');
        }
    );


    $(".sidebar div, aside li").click(function() {
        window.location = $(this).find("a").attr("href");
        return false;
    });



    /* ACCORDION */

    $('.tabs').on('click', '.accordion', function(){
        $(this).toggleClass('active-accordion');
        var id = $(this).attr('id');
        $('.' + id).toggleClass('active-accordion');
    });


    /* MODALS */

    $('.timetable').on('click', '.modal-button' , function(){
        var id = $(this).attr('id');
        $('.'+id).show();
    });

    $('.modal-content span.close').on('click', function() {
        $(this).parent().parent().hide();
    });

    $('.modal-content button.cancel').on('click', function() {
        $('[class$="-modal"]').hide();
    });


    /* DROPDOWN */
    $(document).on("click", 'button.dropbtn', function () {
        // get button id
        var id = $(this).attr('id');
        // show dropdown-content when it's class is button id
        $(".dropdown-content." + id).toggle();
        // hide all other dropdowns then
        $(".dropdown-content").not("." + id).hide();
    });

    $(document).mouseup(function (e) {
        // set container value
        var container = $(".dropdown-content");

        // If the target of the click isn't the container, hide it
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });


});


/* FLOATING LABELS */


var $inputs = $('.float-placeholder-input'),
    update = function(){
        var $input = $(this),
            $wrapper = $input.closest('.float-placeholder');

        if( $input.val() !== '' || $input.is(':active') || $input.is(':focus') || $input.prop('tagName') === 'SELECT'){
            $input.addClass('is-floating');
        } else {
            $input.removeClass('is-floating');
        }

        if($input.is(':focus')){
            $wrapper.addClass('is-focused');
        } else {
            $wrapper.removeClass('is-focused');
        }
    };

$inputs.each( update );
$inputs.on('click focus input blur', update);