$(document).ready( function() {

    /* ACCORDION */
     $('.tabs').on('click', '.accordion', function(){
         $(this).toggleClass('active-accordion');
         var id = $(this).attr('id');
        $('.' + id).toggleClass('active-accordion');
        $('.' + id).css('display', '');
    });


    /* MODALS */

    $('.content').on('click', '.modal-button' , function(){
       var id = $(this).attr('id');
        $('.' + id).show();
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