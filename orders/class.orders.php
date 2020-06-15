<?php

class orders{

    function _construct(){}

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script>
        $(document).ready(function() {
          
            /* SEARCH TABLE SIDEBAR */
        
            $('#orderSearchInput').on('keyup', function () {
                //get value of searchbar input
                var value = $(this).val().toLowerCase();
                //filter checkbox-labels for search value
                $('.checkboxes label').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
                $('.title-part').filter(function () {
                    $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
                });
        
            });
            
            /* ACCORDION */

             $('.accordion').on('click', function(){
                 $(this).toggleClass('active-accordion');
                 var id = $(this).attr('id');
                $('.' + id).toggleClass('active-accordion');
            });
             
             
             
             $('.checkboxes input:checkbox').change(function(){
                 var checked = $(this).prop('checked');
                 
                 $(this).parent().parent().find('.quantity').toggle(checked)
                
             });
            
            
        });



</script>";
        $code .= "<style>

input#orderSearchInput{
    background: none;
    border: none;
    border-bottom: 1px solid black;
    padding: 5px 10px;
}


.tabs h5{
    margin-top: 20px;
}

.quantity{
display: none;
}

</style>";





        $code .= "<script src='https://jexcel.net/v5/jexcel.js'></script>";
        $code .= "<script src='https://jexcel.net/v5/jsuites.js'></script>";
        $code .= "<link rel='stylesheet' href='https://jexcel.net/v5/jexcel.css' type='text/css' />";
        $code .= "<link rel='stylesheet' href='https://jexcel.net/v5/jsuites.css' type='text/css' />";

        return $code;
    }

    function show(){
        $code = "";


        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";


        return $code;
    }


    private function sidebar() {
        $code = "";

        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Order Settings</h2>";

        $code .= "<div class='search col-12'>
        <input class='col-11' type='text' id='orderSearchInput' placeholder='Search'>
         <i class='fas fa-search search-icon col-1'></i>
          
    </div>";

        $code .= "<div class='title-part accordion' id='panel-1'>
                        <h5 class='col-12'>E.Leclerc</h5>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-1 checkboxes'>

                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Alex
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Anya
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Stefan
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Tina
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Max
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8'>
                        <input type='checkbox'>
                        Tom
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                    
    
                </div>";

        $code .= "<div class='title-part accordion' id='panel-2'>
                        <h5 class='col-12'>E.Leclerc</h5>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-2 checkboxes'>

                                    <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Alex
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Anya
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Stefan
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Tina
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Max
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-12'>
                        <input type='checkbox'>
                        Tom
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
    
                </div>";


        $code .= "<div class='title-part accordion' id='panel-3'>
                        <h5 class='col-12'>E.Leclerc</h5>
                                <hr class='col-12'>
                            </div>";
        $code .= "<div class='panel-3 checkboxes'>

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
        $code .= "</div>";

        return $code;
    }

    private function content() {
        $code = "";

        $code .= "<div class='col-9 content'>";
        $code .= "
        <div id='spreadsheet'></div>

        <input type='button' value='Add new row' onclick='$('#spreadsheet').jexcel('insertRow')' />
        
        <script>
        var options = {
            minDimensions:[10,10],
            tableOverflow:true,
        }
        
        $('#spreadsheet').jexcel(options); 
        </script>
                ";

        $code .= "</div>";

        return $code;
    }



}




?>