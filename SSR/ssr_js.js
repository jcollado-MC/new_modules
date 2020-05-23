

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