

/* SEARCH */
$(document).ready(function(){
    $("#reports-search-bar").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $(".accordion").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 || $(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});




/* SEARCH TABLE SIDEBAR */


$(document).ready(function(){
    $("#tableSearchInputSSR").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $(".table-fields .checkboxes label").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $(".table-fields .title-part").filter(function() {
            $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});


/* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

$(document).ready(function(){
    $(".groups").on("click", function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop("checked");
        $("." + id).prop({
            checked: allChecked
        });
    });
});



$(document).ready(function(){
    /* ADD IMAGE-GALLERY-SIDEBAR FIELDS */
    $(".add-gallery-fields").on("click", function () {
        var id = $(this).attr('id');
        $(".first-field ." + id ).clone().appendTo("#" + id + "~ .field-container").append("<i class='fas fa-times delete col-1'></i>");
    });
    /* REMOVE IMAGE-GALLERY-SIDEBAR FIELDS*/
    $(".field-container").on("click", ".delete", function () {
        $(this).siblings().remove();
        $(this).remove();
    });
});



/* TOGGLE BETWEEN SPECIFIC AND PERIOD TIMESPAN */
$(document).ready(function(){
    $(".period-timespan").hide();
    $("#period-timespan").on("change", function(){
        var checked = $("#period-timespan").prop("checked");
        $(".specific-timespan").toggle(!checked);
        $(".period-timespan").toggle(checked);
    });
});




$(document).ready(function(){

    /* ADD CUSTOM FILTER FIELDS */
    $(".add-filter-fields").on("click", function () {
        $(".custom-filter-group#first").clone().appendTo("#new-filter").removeAttr("id");
    });

    /* REMOVE CUSTOM FILTER FIELDS*/
    $("#new-filter").on("click", ".delete", function () {
        $(this).parent().parent("div").remove();
        $(this).remove();
    });

});




