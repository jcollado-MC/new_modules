

/* SEARCH */
$(document).ready(function(){
    $('#reports-search-bar').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $('.accordion').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 || $(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});




/* SEARCH TABLE SIDEBAR */


$(document).ready(function(){
    $('#tableSearchInputSSR').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('.table-fields .checkboxes label').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $('.table-fields .title-part').filter(function() {
            $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});


/* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

$(document).ready(function(){
    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });
});



$(document).ready(function(){
    /* ADD IMAGE-GALLERY-SIDEBAR FIELDS */
    $('.add-gallery-fields').on('click', function () {
        var id = $(this).attr('id');
        $('.first-field .' + id ).clone().find('input:text').val('').end().appendTo('#' + id + '~ .field-container').append('<i class=\'fas fa-times delete col-1\'></i>');
    });
    /* REMOVE IMAGE-GALLERY-SIDEBAR FIELDS*/
    $('.field-container').on('click', '.delete', function () {
        $(this).siblings().remove();
        $(this).remove();
    });
});



/* TOGGLE BETWEEN SPECIFIC AND PERIOD TIMESPAN */
$(document).ready(function(){

    if($('input:checkbox#period-timespan').prop('checked')){
        $('.period-timespan').show()
        $('.specific-timespan').hide();
    }else {
        $('.period-timespan').hide();
        $('.specific-timespan').show();
    }
    $('#period-timespan').on('change', function(){
        var checked = $('#period-timespan').prop('checked');
        $('.specific-timespan').toggle(!checked);
        $('.period-timespan').toggle(checked);
    });
});




$(document).ready(function(){
    /* ADD CUSTOM FILTER FIELDS */
    $('.add-filter-fields').on('click', function () {
        $('.custom-filter-group#first').clone().find('input:text').val('').end().appendTo('#new-filter').removeAttr('id');
    });

    /* REMOVE CUSTOM FILTER FIELDS*/
    $('#new-filter').on('click', '.delete', function () {
        $(this).parent().parent('div').remove();
        $(this).remove();
        $('.dropdown-content').trigger('change');
    });
});

/* OVERLAY && UPDATE BUTTON*/
$(document).ready(function(){


    if($('input:checkbox#period-timespan').prop('checked')){
        $('p.period-time-tag span').html($('.period-timespan select').val());
        $('.period-time-tag').show();
        $('.specific-time-tag').hide();
    } else if(($('.timespan input#start-date').val().length || $('.timespan input#end-date').val().length) > 0){
        $('.period-time-tag').hide();

        var startdate = $('.timespan input#start-date').val().split('-');
        startdate = startdate[2] + '.' + startdate[1] + '.' + startdate[0].slice(-2);

        var enddate = $('.timespan input#end-date').val().split('-');
        enddate = enddate[2] + '.' + enddate[1] + '.' + enddate[0].slice(-2);

        $('p.specific-time-tag .start').html(startdate);
        $('p.specific-time-tag .end').html(' - ' + enddate);

        $('.specific-time-tag').show();
    }else{
        $('.period-time-tag').hide();
        $('.specific-time-tag').hide();
    }


    $('.update-overlay').hide();
    $('form').change(function () {
        $('.update-overlay').show();
    });
    $('.update-overlay button.update').on('click', function() {
        $('.update-overlay').hide();


        $('.specific-time-tag').hide();
        $('.period-time-tag').hide();


        if ($('input:checkbox#period-timespan').prop('checked')) {
            $('.specific-time-tag').hide();
            $('p.period-time-tag span').html($('.period-timespan select').val());
            $('.period-time-tag').show();
        } else if (($('.timespan input#start-date').val().length || $('.timespan input#end-date').val().length) > 0) {
            $('.period-time-tag').hide();

            var startdate = $('.timespan input#start-date').val().split('-');
            startdate = startdate[2] + '.' + startdate[1] + '.' + startdate[0].slice(-2);

            var enddate = $('.timespan input#end-date').val().split('-');
            enddate = enddate[2] + '.' + enddate[1] + '.' + enddate[0].slice(-2);

            $('p.specific-time-tag .start').html(startdate);
            $('p.specific-time-tag .end').html(' - ' + enddate);

            $('.specific-time-tag').show();
        }

        // var filters = $('.custom-filter-group');
        //
        // var filtertexts = [];
        //
        // filters.each(function () {
        //     var inputvalues = [];
        //     var selector = $(this).find('select').val();
        //     var inputs = $(this).find('input');
        //     inputs.each(function () {
        //         inputvalues.push($(this).val());
        //     });
        //
        //     filtertexts.push(inputvalues[0] + " " + selector + " " + inputvalues[1]);
        // });
        //
        // console.log(filtertexts);

        // for (let i = 0; filters.length - 1 > i; i++) {
        //     $('#first-filter-tag').clone().appendTo('.filter-tags').removeAttr('id');
        // }

        // var filtertags = $('.filter-tag');

        // if (filtertexts[0].length <= 0) {
        //     $('.filter-tag').hide();
        // } else {
        //     filtertags.each(function(){
        //         for (let i = 0; filtertexts.length > i; i++) {
        //             $(this).find('span').end().html(filtertexts[i]);
        //         }
        //     });
        // }

    });


});



$(document).ready(function(){

    $('.filter-tags i.delete').on('click', function(){
        console.log($(this).attr('id'));
        var id = $(this).attr('id');

        if(id == 'period-timespan'){
            $('input:checkbox#' + id).prop('checked', false).trigger('change');
        }else if(id == 'specific-timespan'){
            $('.' + id + ' input').val('').trigger('change');
        }

        $(this).parent().hide();
    });

});



