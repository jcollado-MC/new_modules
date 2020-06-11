

$(document).ready(function() {

    /* DROPDOWN */
    $(document).on('click', 'button.dropbtn', function () {
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



    /* MODALS */
    // hide on initial
    $("[class$='-modal']").hide();

    //show modal with class of button id
    $(".modal-button").on("click", function () {
        var id = $(this).attr('id');
        $("." + id).show();
    });

    //close modal when click on close icon
    $(".modal-content span.close").on("click", function () {
        $(this).parent().parent().hide();
    });
    //close modal when click on cancel button
    $(".modal-content button.cancel").on("click", function () {
        $("[class$='-modal']").hide();
    });




    /* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });

    // select "select all checkbox" if all checkboxes are manually selected and vice versa
    $('input:checkbox').on('click', function () {
        var groupName = $(this).attr('class');
        var group = $('.' + groupName);
        var allChecked = true;
        for(let member of group){
            var checked = $(member).prop('checked');
            if(!checked){
                allChecked = checked;
            }
        }

        $('#' + groupName).prop({
            checked: allChecked
        })

    });



    /* OVERLAY && UPDATE BUTTON*/

    $('.update-overlay').hide();
    $('form').change(function () {
        //when form fields change, show update-overlay
        $('.update-overlay').show();
    });
    $('.update-overlay button.update').on('click', function () {
        //hide overlay if updated
        $('.update-overlay').hide();
    });



    /* TABS */

    // if ($('button.tablinks').hasClass('active')){
    //     var id = $('button.tablinks').attr('id');
    //     $('.tabcontent.' + id).show();
    // }


    $('button.tablinks').on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active')
        var id = $(this).attr('id');
        $('.tabcontent').hide();
        $('.tabcontent.' + id).show();
    });

    $('button.search').on('click', function(){
        $('.search-bar').toggle();
    });


    /* ACCORDION */

    if ($('.accordion').hasClass('active')){
        var id = $('.accordion.active').attr('id');
        console.log(id);
        $('.' + id).show();
    }





});
