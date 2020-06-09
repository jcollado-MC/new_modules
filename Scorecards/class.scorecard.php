<?php


class scorecard{

    function _construct(){}

    function show(){

        $code = "<div class='content col-12'>";
        $code ="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->save();
        $code .= $this->delete();
        $code .= $this->filter();
        $code .= $this->actions();
        $code .= $this->breadcrumb();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</div>";

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

        $code = "<div class='tabcontent col-12 pos'>";



        $code .= "<div class='title-part'>
                        <h5 class='col-10'>POS</h5>
                                <div class='col-2 row'>
                                    <label class='switch'>
                                        <input type='checkbox' id='pos-group' class='groups'>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                                <hr class='col-12'>
                            </div>";

        $code .= "<label>
                            <input type='checkbox' class='pos-group'>
                            E.Leclerc
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Auchan
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Super U
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Monoprix
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Carrefour
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Intermarché
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Géant
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Monoprix
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Cora
                        </label>
                        <label>
                            <input type='checkbox' class='pos-group'>
                            Carrefour
                        </label>
                </div>";
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

        $code .= "<div class='row col-12'>
                <ul class='scorecard-breadcrumb'>
                    <li> Agnès BAUP </li>
                    <li><i class='fas fa-angle-right'></i></li>
                    <li><span> AUCHAN CUISINE </span></li>
                </ul>

            </div>";

        return $code;
    }

    private function content(){}
}