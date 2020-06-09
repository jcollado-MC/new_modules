/*ACCORDION*/
var acc = document.getElementsByClassName("accordion");

var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("accordion-active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}


/* Table columns with links inside a accordion clickable */

$(document).ready(function() {

    $('.panel tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});




/* DROPDOWN */
$(document).ready(function() {

    $(".dropdown-content" ).hide();

    $("button.dropbtn").on("click", function() {
        var id = $(this).attr('id');
        $(".dropdown-content."+id).toggle();

        $(".dropdown-content").not("."+id).hide();
    });


    $(document).mouseup(function(e){
        var container = $(".dropdown-content");

        // If the target of the click isn't the container
        if(!container.is(e.target) && container.has(e.target).length === 0){
            container.hide();
        }
    });

});

/* MODALS */

$(document).ready(function() {

    $("[class$='-modal']").hide();


    $(".modal-button").on("click", function(){
       var id = $(this).attr('id');
        $("."+id).show();
    });


    $(".modal-content span.close").on("click", function() {

        $(this).parent().parent().hide();

    });

    $(".modal-content button.cancel").on("click", function() {

        $("[class$='-modal']").hide();

    });
});


//
// /*FILTER-BUTTONS (with classes)*/
//
//
// filterSelection("all")
// function filterSelection(c) {
//     var x, i;
//     x = document.getElementsByClassName("filter");
//     if (c == "all") c = "";
//     // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
//     for (i = 0; i < x.length; i++) {
//         removeClass(x[i], "show");
//         if (x[i].className.indexOf(c) > -1) addClass(x[i], "show");
//     }
// }
//
// // Show filtered elements
// function addClass(element, name) {
//     var i, arr1, arr2;
//     arr1 = element.className.split(" ");
//     arr2 = name.split(" ");
//     for (i = 0; i < arr2.length; i++) {
//         if (arr1.indexOf(arr2[i]) == -1) {
//             element.className += " " + arr2[i];
//         }
//     }
// }
//
// // Hide elements that are not selected
// function removeClass(element, name) {
//     var i, arr1, arr2;
//     arr1 = element.className.split(" ");
//     arr2 = name.split(" ");
//     for (i = 0; i < arr2.length; i++) {
//         while (arr1.indexOf(arr2[i]) > -1) {
//             arr1.splice(arr1.indexOf(arr2[i]), 1);
//         }
//     }
//     element.className = arr1.join(" ");
// }
//
// // Add active class to the current control button (highlight it)
// var btnContainer = document.getElementById("documentModelFilterButtonContainer");
// var btns = btnContainer.getElementsByClassName("btn");
// for (var i = 0; i < btns.length; i++) {
//     btns[i].addEventListener("click", function() {
//         var current = document.getElementsByClassName("active");
//         current[0].className = current[0].className.replace(" active", "");
//         this.className += " active";
//     });
// }
