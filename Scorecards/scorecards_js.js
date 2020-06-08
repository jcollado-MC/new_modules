

$(document).ready(function() {

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



    /* SEARCH TABLE SIDEBAR */

    $('#tableSearchInputSSR').on('keyup', function () {
        //get value of searchbar input
        var value = $(this).val().toLowerCase();
        //filter checkbox-labels for search value
        $('.table-fields .checkboxes label').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
        $('.table-fields .title-part').filter(function () {
            $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });


    /* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });

    /* TODO: IF ALL CHECKBOXES ARE SELECTED, CHECK "SELECT ALL" CHECKBOX */


    /* ADD IMAGE-GALLERY-SIDEBAR FIELDS */

    $('.add-gallery-fields').on('click', function () {
        //get group-id of Sidebar-Fields
        var id = $(this).attr('id');
        //first-field with group-id as class will be cloned,
        // cleaned and appended to container,
        // also delete button will be added
        $('.first-field .' + id).clone()
            .find('input')
            .val('')
            .end()
            .appendTo('#' + id + '~ .field-container')
            .append('<i class=\'fas fa-times delete col-1\'></i>');
    });
    /* REMOVE IMAGE-GALLERY-SIDEBAR FIELDS*/
    $('.field-container').on('click', '.delete', function () {
        // remove sidebar-field and the delete button
        $(this).siblings().remove();
        $(this).remove();
    });



    /* TOGGLE BETWEEN SPECIFIC AND PERIOD TIMESPAN */

    // initial status
    if ($('input:checkbox#period-timespan').prop('checked')) {
        //if checkbox for period timespan is checked,
        // show period timespan and hide specific timespan
        $('.period-timespan').show()
        $('.specific-timespan').hide();
    } else {
        //if checkbox for period timespan is not checked,
        // show specific timespan and hide period-timespan-fields
        $('.period-timespan').hide();
        $('.specific-timespan').show();
    }

    //on change
    $('#period-timespan').on('change', function () {
        //if checkbox for period timespan is checked,
        // show period timespan and hide specific timespan,
        // otherways hide
        var checked = $('#period-timespan').prop('checked');
        $('.specific-timespan').toggle(!checked);
        $('.period-timespan').toggle(checked);
    });






    /* ADD CUSTOM FILTER FIELDS */

    // variable for counting custom filter-fields
    var filterid = 1;

    $('.add-filter-fields').on('click', function () {
        // on add, count variable up
        filterid++;

        //clone first-filter-dropdown,
        // then clean the input-fields,
        // clean the selects,
        // add filter-count to classlist,
        // and appednt it to container for new filter
        // then remove the "first-filer" id
        $('.dropdown#first-filter').clone()
            .find('.dropdown-content input:text')
            .val('')
            .end()
            .find('.dropdown-content select')
            .prop('selectedIndex', 0)
            .end()
            .find('.dropdown-content')
            .addClass('filter-' + filterid)
            .removeClass('filter')
            .end()
            .appendTo('.new-filter')
            .find('button.dropbtn')
            .attr('id', 'filter-' + filterid)
            .end()
            .removeAttr('id');
    });


    /* REMOVE CUSTOM FILTER FIELDS*/

    $('.new-filter').on('click', '.delete', function () {
        //The highest parent div - the dropdown button has to be removed,
        //trigger update-overlay after deleting a filter
        $(this).parent().parent().parent().parent('div.dropdown').remove();
        $('.dropdown-content').trigger('change');
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


});



