

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

        $(".table-fields label").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});


/* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

$(document).ready(function(){
    $("#group1").on(click, function () {
        $(".group1 label :checkbox").prop.toggle("checked");
    });
});