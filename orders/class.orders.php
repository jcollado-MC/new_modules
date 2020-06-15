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
                $('.checkboxes label.checkbox-label').filter(function () {
                    $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
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
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Alex
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Anya
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Stefan
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Tina
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Max
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
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
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Alex
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Anya
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Stefan
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Tina
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Max
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
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

                
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Alex
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Anya
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Stefan
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Tina
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Max
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                 
                </div>    
                    
                <div class='col-12 row'>
                    <label class='col-8 checkbox-label'>
                        <input type='checkbox'>
                        Tom
                    </label>
                    <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                </div>  
    
                </div>";


        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }

    private function content() {
        $code = "";

        $code .= "<div class='col-9 content'>";
        $code .= "
        <table id='spreadsheet' class='scorecard'>
  <thead>
    <tr>
      <th>Name</th>
      <th>Einheiten/Kiste</th>
      <th>Code</th>
      <th>Menge</th>
      <th>PNR</th>
      <th>Rabatt</th>
      <th>PNF</th>
    </tr>
  </thead>
<tbody>
    <tr>
      <td> Hamburguesa de Quinoa y Brócoli</td>
      <td>17634</td>
      <td>6</td>
      <td>12</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Hamburguesa de verduras y legumbres Lenteja roja y Chia</td>
      <td>17356</td>
      <td>6</td>
      <td>18</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Hamburguesa vegetal de Champiñones</td>
      <td>17051</td>
      <td>6</td>
      <td>6</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Tahín integral tostado 200g</td>
      <td>17323</td>
      <td>3</td>
      <td>6</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> VEGG Sustituto vegetal del huevo</td>
      <td>17336</td>
      <td>4</td>
      <td>8</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>SÉMOLA KESVIT Bolsa 500g</td>
      <td>10022</td>
      <td>10</td>
      <td>20</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>SOPA JULIANA 150g</td>
      <td>10311</td>
      <td>14</td>
      <td>28</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Hummus Tradicional</td>
      <td>17612</td>
      <td>6</td>
      <td>18</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Frankfurt de Tofu</td>
      <td>17239</td>
      <td>6</td>
      <td>18</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> Arroz Integral Redondo 1kg</td>
      <td>17006</td>
      <td>8</td>
      <td>24</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
</tbody>
</table>
<script>var table=jexcel(document.getElementById('spreadsheet'),{columns:[{type:'text',width:'200px',readOnly:true},{type:'text',width:'100px',readOnly:true},{type:'text',width:'150px'},{type:'text',width:'150px'},{type:'text',width:'150px'},{type:'text',width:'150px'},{type:'text',width:'150px'}],license:'fd12c-f6d85-227f1-85ed4',});</script><hr><div class='scorecard'><button type='submit' name='button18191' value=1>Speichern</button>
</div>";

        $code .= "</div>";

        return $code;
    }



}




?>