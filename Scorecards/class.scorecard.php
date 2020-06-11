<?php


class scorecard{

    function _construct(){}

    private static $header;
    static function Header(){
        if(self::$header==TRUE) return;
        self::$header=TRUE;

        $code = "";

        $code .= "<script>


$(document).ready(function() {

    /* DROPDOWN */
    $(document).on('click', 'button.dropbtn', function () {
        // get button id
        var id = $(this).attr('id');
        // show dropdown-content when it's class is button id
        $('.dropdown-content.' + id).toggle();
        // hide all other dropdowns then
        $('.dropdown-content').not('.' + id).hide();
    });

    $(document).mouseup(function (e) {
        // set container value
        var container = $('.dropdown-content');

        // If the target of the click isn't the container, hide it
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });



    /* MODALS */
    // hide on initial
    $('[class$=\"-modal\"]').hide();

    //show modal with class of button id
    $('.modal-button').on('click', function () {
        var id = $(this).attr('id');
        $('.' + id).show();
    });

    //close modal when click on close icon
    $('.modal-content span.close').on('click', function () {
        $(this).parent().parent().hide();
    });
    //close modal when click on cancel button
    $('.modal-content button.cancel').on('click', function () {
        $('[class$=\"-modal\"]').hide();
    });




    /* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });

    /* TODO: IF ALL CHECKBOXES ARE SELECTED, CHECK \"SELECT ALL\" CHECKBOX */



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

    if ($('button.tablinks').hasClass('active')){
        var id = $('button.tablinks').attr('id');
        $('.tabcontent.' + id).show();
    }


    $('button.tablinks').on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('id');
        $('.tabcontent').hide();
        $('.tabcontent.' + id).show();
    });

    $('button.search').on('click', function(){
        $('.search-bar').toggle();
    });
    
    
    /* ACCORDION */

     $('.accordion').on('click', function(){
         $(this).toggleClass('active-accordion');
         var id = $(this).attr('id');
        $('.' + id).toggleClass('active-accordion');
    });
     
     
});

</script>";
        $code .= "<style>
/*BREADCRUMB*/


.scorecard-breadcrumb{
    background-color: #f1f1f1;
    margin: 0 0 5px 0;
}

/* Style the list */
.scorecard-breadcrumb ul{
    padding: 10px;
    margin: 0;
    list-style: none;
}

.scorecard-breadcrumb ul li {
    display: inline;
    font-size: 0.8rem;
    padding: 5px;
}

.scorecard-breadcrumb ul li span{
    font-weight: bold;
}

.scorecard-breadcrumb ul li+li:before {
    padding: 8px;
}

.scorecard-breadcrumb ul li a {
    color: #3f48cc;
    text-decoration: none;
}

.scorecard-breadcrumb ul li a:hover {
    color: #01447e;
    text-decoration: underline;
}

input.search-bar{
    display: none;
    background: none;
    border: none;
    border-bottom: 1px solid #3f48cc;
}




</style>";

        return $code;
    }

    function show(){

        $code = "";


        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->save();
        $code .= $this->delete();
        $code .= $this->filter();
        $code .= $this->actions();
        $code .= $this->breadcrumb();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";


        return $code;
    }

    private function sidebar(){


        $code = "<div class='col-3'>

            <!-- Tab links -->
            <div class='scorecard-sidebar tab col-12'>
                <button class='tablinks active' type='button' id='pos'><h2>POS</h2></button>
                <button class='tablinks' type='button' id='salesrep'><h2>Sales Rep</h2></button>
                <button class='tablinks' type='button' id='tags'><h2>Tags</h2></button>
                <button class='tablinks' type='button' id='products'><h2>Products</h2></button>
            </div>

            <div class='col-12'>";

        $code .= $this -> sidebarStores();
        $code .= $this -> sidebarSalesman();
        $code .= $this -> sidebarProducts();
        $code .= $this -> sidebarTags();

        $code .= "</div>";


        return $code;

    }

    private function sidebarStores(){

        $cnt = 0;

        $code = "<div class='tabcontent col-12 pos'>";



        $code .= "<div class='title-part accordion' id='panel-1'>
                        <h5 class='col-10'>E.Leclerc</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='pos-group-1' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-1'>

                    <label>
                            <input type='checkbox' class='pos-group-1'>
                            Alex
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Anya
                        </label>
                        <label >
                            <input type='checkbox' class='pos-group-1'>
                            Stephan
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Natalia
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Andre
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Jose
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-1'>
                            Tim
                        </label>
    
                </div>";

        $code .= "<div class='title-part accordion' id='panel-2'>
                        <h5 class='col-10'>Auchan</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='pos-group-2' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-2'>

                    <label>
                            <input type='checkbox' class='pos-group-2'>
                            Alex
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Anya
                        </label>
                        <label >
                            <input type='checkbox' class='pos-group-2'>
                            Stephan
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Natalia
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Andre
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Jose
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-2'>
                            Tim
                        </label>
    
                </div>";


        $code .= "<div class='title-part accordion' id='panel-3'>
                        <h5 class='col-10'>Carrefour</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='pos-group-3' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-3'>

                    <label>
                            <input type='checkbox' class='pos-group-3'>
                            Alex
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Anya
                        </label>
                        <label >
                            <input type='checkbox' class='pos-group-3'>
                            Stephan
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Natalia
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Andre
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Jose
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group-3'>
                            Tim
                        </label>
    
                </div>";


        $code .= "</div>";
        return $code;
    }

    private function sidebarSalesman(){

        $code = "<div class='tabcontent  col-12 salesrep'>";




        $code .= "<div class='title-part'>
                        <h5 class='col-10'>Sales Rep</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='salesrep-group' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";

        $code .= "<label>
                            <input type='checkbox' class='salesrep-group'>
                            Alex
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Anya
                        </label>
                        <label >
                            <input type='checkbox' class='salesrep-group'>
                            Stephan
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Natalia
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Andre
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Jose
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Tim
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Louis
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Anna
                        </label>
                        <label>
                            <input type='checkbox' class='salesrep-group'>
                            Charlotte
                        </label>
                </div>";
        return $code;

    }

    private function sidebarTags(){
        $code = "<div class='tabcontent col-12 tags'>";




        $code .= "<div class='title-part'>
                        <h5 class='col-10'>Tags</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='tags-group' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";

        $code .= "
                        <label>
                            <input type='checkbox' class='tags-group'>
                            Tag 1
                        </label>
                        <label>
                            <input type='checkbox' class='tags-group'>
                            Tag 2
                        </label>
                        <label >
                            <input type='checkbox' class='tags-group'>
                            Tag 3
                        </label>
                        <label>
                            <input type='checkbox' class='tags-group'>
                            Tag 4
                        </label>
                </div>";
        return $code;
    }

    private function sidebarProducts(){
        $code = "<div class='tabcontent col-12 products'>";




        $code .= "<div class='title-part'>
                        <h5 class='col-10'>Products</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='products-group' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";

        $code .= "
                        <label>
                            <input type='checkbox' class='products-group'>
                            Product 1
                        </label>
                        <label>
                            <input type='checkbox' class='products-group'>
                            Product 2
                        </label>
                        <label >
                            <input type='checkbox' class='products-group'>
                            Product 3
                        </label>
                        <label>
                            <input type='checkbox' class='products-group'>
                            Product 4
                        </label>
                </div>";
        return $code;
    }

    private function save(){
        $code = "<button id='save' class='modal-button' type='button'>Save</button>";
        $code .= "<div class='save save-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Save this report</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<label>Choose a name:</label>";
        $code .= "<input class='col-12' type='text' placeholder='Unknown'>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save'>Save</button>";
        $code .= "<button id='delete' class='cancel' type='button'>Cancel</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        return $code;
    }

    private function delete(){
        //        TODO: only show button if saved
        $code = "<button id='delete' class='modal-button' type='button'>Delete</button>";
        $code .= "<div class='delete delete-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Do you really want to delete this report?</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<p>It will be gone forever</p>";
        $code .= "<button id='delete'  class='cancel' type='button'>Cancel</button>";
        $code .= "<button id='save'>Delete</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .="</div>"; //CLOSE SIDEBAR
        return $code;
    }

    private function filter(){
        $code = "<div class='content col-9'>
                <div class='row col-9 filters'>";
        $code  .= "<div class='dropdown'>
                    <button id='timespan' class='dropbtn' type='button'>
                        <h5>Time <i class='fas fa-caret-down'></i></h5> 
                    </button>
                    <div class='dropdown-content timespan'>
                        <div class='col-12 row'>
                            <div class='col-12'>
                                <label>From</label>
                                <input type='date'>
                            </div>
                            <div class='col-12'>
                                <label>To</label>
                                <input type='date'>
                            </div>
                            <button class='update col-12'> <i class='fas fa-sync-alt'> </i> Update</button>
                        </div>

                    </div>
                </div>";

        // BREAKDOWN
        $code .= "<div class='dropdown'>";
        $code .= "<button id='breakdown' class='dropbtn' type='button'><h5>Breakdown <i class='fas fa-caret-down'></i></h5> </button>";
        $code .= "<div class='dropdown-content breakdown'>";

        $code .="<label>
                <input type='checkbox'>
                Global
            </label>
            <label>
                <input type='checkbox'>
                Salesman
            </label>
            <label>
                <input type='checkbox'>
                Customers
            </label>
            <label>
                <input type='checkbox'>
                Cluster
            </label>
            <label>
                <input type='checkbox'>
                Point of Sales
            </label>
            <label>
                <input type='checkbox'>
                Products
            </label>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        return $code;
    }

    private function actions(){
        $code = "";

        $code .= "<div class='col-3 actions'>";
        $code .= "<button class='redo' type='button'>
                <i class='fas fa-redo-alt'></i>
              </button>";
        $code .= "<input type='text' class='search-bar'  id='search-bar' placeholder='Search'>
                <button class='search' type='button'>
                <i class='fas fa-search'></i>
              </button>";
        $code .= "</div>";
        return $code;
    }

    private function breadcrumb(){

        $code ="";

        $code .= "<div class='row col-12 scorecard-breadcrumb'>
                <ul class='col-11'>
                    <li> Agnès BAUP </li>
                    <li><i class='fas fa-angle-right'></i></li>
                    <li><span> AUCHAN CUISINE </span></li>
                </ul>
                <i class='fas fa-times delete col-1'></i>
            </div>";

        return $code;
    }

    private function content(){
        $code = "";
        $code .= "<div class='scorecard-content'>";
        $code .= "<table class=\"col-12\">
                    <thead>
                        <tr>
                            <th class=''>Vertriebler</th>
                            <th>Visites</th>
                            <th>Objectif</th>
                            <th>Percentage</th>
                            <th>Visites YTD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=0&ddt=CLIENTS'>Agnès BAUP</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=0' target=_blank>173</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=0' target=_blank>402</a></td>
                            <td style='text-align: right'>43%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=0' target=_blank>173</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=1&ddt=CLIENTS'>Alexandra PAVIE</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=1' target=_blank>227</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=1' target=_blank>528</a></td>
                            <td style='text-align: right'>43%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=1' target=_blank>227</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=2&ddt=CLIENTS'>Anne-Gaëlle HEDONT</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=2' target=_blank>217</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=2' target=_blank>462</a></td>
                            <td style='text-align: right'>47%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=2' target=_blank>217</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=3&ddt=CLIENTS'>Catherine MOREAU</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=3' target=_blank>210</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=3' target=_blank>472</a></td>
                            <td style='text-align: right'>44%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=3' target=_blank>210</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=4&ddt=CLIENTS'>Cécile KLOCK</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=4' target=_blank>221</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=4' target=_blank>461</a></td>
                            <td style='text-align: right'>48%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=4' target=_blank>221</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=5&ddt=CLIENTS'>Christel FONTAINE</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=5' target=_blank>146</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=5' target=_blank>456</a></td>
                            <td style='text-align: right'>32%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=5' target=_blank>146</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=6&ddt=CLIENTS'>Christophe DE SIMONE</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=6' target=_blank>278</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=6' target=_blank>468</a></td>
                            <td style='text-align: right'>59%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=6' target=_blank>278</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=7&ddt=CLIENTS'>Laurent AVRAIN</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=7' target=_blank>169</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=7' target=_blank>440</a></td>
                            <td style='text-align: right'>38%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=7' target=_blank>169</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=8&ddt=CLIENTS'>Philippe GUILLERM</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=8' target=_blank>234</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=8' target=_blank>462</a></td>
                            <td style='text-align: right'>51%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=8' target=_blank>234</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=9&ddt=CLIENTS'>Samir OUSALHA</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=9' target=_blank>170</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=9' target=_blank>471</a></td>
                            <td style='text-align: right'>36%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=9' target=_blank>170</a></td>
                        </tr>
                        <tr>
                            <td class=''><a href='scorecards_view.php?id=6&session=782929&ddf=10&ddt=CLIENTS'>Thierry STEYAERT</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=0&colID=9&entry=10' target=_blank>261</a></td>
                            <td style='text-align: right'><a href='scorecards_details.php?id=6&col=1&colID=11&entry=10' target=_blank>386</a></td>
                            <td style='text-align: right'>68%</td><td style='text-align: right'><a href='scorecards_details.php?id=6&col=3&colID=39&entry=10' target=_blank>261</a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align='left' colspan=1>Gesamt</th>
                            <th style='text-align: right'>2.306</th>
                            <th style='text-align: right'>5.008</th>
                            <th style='text-align: right'>46%</th>
                            <th style='text-align: right'>2.306</th>
                        </tr>
                    </tfoot>
                </table>";
        $code .= "</div>";

        return $code;
    }
}