<?php

class orders{

    function _construct(){
    }

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script src=\"../Jquery/jquery-3.4.1.min.js\"></script>";

        $code .= "<script>
       
        $(document).ready(function(){    
            
            updateRow();
            
            /* SEARCH TABLE SIDEBAR */
                
            $('#searchInput').on('keyup', function () {
                
                //get value of searchbar input
                var value = $(this).val().toLowerCase();
                
                if(value.length > 0){
                
                    $('[class*=\'panel-\']').addClass('active-accordion');
                    
                    $('[class*=\'panel-\']').each(function () {
                        var selector = $(this).find('div label.checkbox-label');
                        var hasResult = false;
                        selector.filter(function () {
                            var found = $(this).text().toLowerCase().indexOf(value) > -1;
                            $(this).parent().toggle(found);
                            if (found) {
                                hasResult = true;
                            }
                        });
                        if (!hasResult) {
                            $(this).removeClass('active-accordion');
                        }
                    });
                                
                    // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
                    $('.title-part').filter(function() {
                         
                          var checkbox = $(this).attr('id');
                          if (checkbox) {
                              if(checkbox.not(':checked')) {
                                  $('#' + checkbox).hide();                
                              } else {
                                  $('#' + checkbox).show();
                              }
                          }
                         
                    });
                    
                
                } else {
                    $('[class*=\'panel-\']').removeClass('active-accordion');
                    $('.checkboxes label.checkbox-label').each(function () {
                        $(this).parent().show();
                    })
                }
            });
            
            
            /* ACCORDION */

             $('.accordion').on('click', function(){
                 $(this).toggleClass('active-accordion');
                 var id = $(this).attr('id');
                $('.' + id).toggleClass('active-accordion');
            });
                    
             $('.checkboxes input:checkbox').change(function(){
                 var checked = $(this).prop('checked');                
                 $(this).parent().parent().find('.quantity').toggle(checked);
             });

             $('.checkboxes input:checkbox').change( function(){
                 
                 var idThis = $(this).attr('id');
                 var name = $(this).parent().text();
                 var qty = $(this).parent().siblings().children('.quantity input').val();
                      
                 var length = table.rows.length;
                
                 var productCode = $(this).data('sapNumber');
                 //the productCode is the sap_number on class.myOrders.php
                 
                 var checked = $(this).prop('checked');
                 if(checked){
                     table.insertRow( [idThis, productCode, name, '' , '' , qty] ,0, true);
                 } else {
                     for(let i = 0; i < length; i++){
                         let val = table.getValueFromCoords([0], [i]);
                         if(val == idThis){
                             table.deleteRow(i);
                         }
                     }
                 }                 
             });
             
             $('.quantity input').change(function() {
                 
                 var idThis = $(this).parent().siblings().children('.checkboxes input:checkbox').attr('id');
                 var qty = $(this).val();
                 var length = table.rows.length;                
                 
                 for(let i = 0; i < length; i++){
                         let val = table.getValueFromCoords([0], [i]);
                         if(val == idThis){
                             table.setValue( ('E' + (i+1)), qty, true);
                         }
                     }
             });           
  
        });
        
         var updateRow = function(){
                    var tableLength = table.rows.length + 1;
                    
                    for(let i = 0; i < tableLength; i++){                    
                        table.setReadOnly( 'A' + i , true);
                        table.setReadOnly( 'C' + i , true);
                        table.setReadOnly( 'D' + i , true);                                                
                    }
            };
            
         var changed = function(instance, cell, x, y, value) { 
                
                if (x == 6){
                    
                    var discount = value;
                    
                    if(discount > 100 || discount < 0 ){
                        alert('Discount value is not valid!');
                        table.setValueFromCoords( [6], [y], '', true );
                    }
                }
                
                if (x == 4){                   
                    var id =  table.getValueFromCoords([0], [y]);    
                    var quantityInput = $('#'+id).parent().siblings().children('.quantity input');                
                    quantityInput.val(value);                
                   
                 if( value <= 0 ) {                        
                       var checkbox = $('#'+id);                                                    
                    checkbox.prop('checked', false);                     
                  var quantity = $('#'+id).parent().siblings('.quantity'); 
                    quantity.hide();                       
               table.deleteRow( y );
                }
                }    
                
                
                if (x == 1){            
                    var product = allProducts[value];
                    
                    var isProductInTable = false;
                    var tableLength = table.rows.length + 1;
            
                    if(product != undefined){
                        for(let i = 0; i < tableLength; i++){                            
                            if(i != y ){
                                var productCode = table.getValueFromCoords( [1], [i]);
                                if(productCode == product.sap_number){
                                    isProductInTable = true;
                                    alert('The product has already been added to the order!');
                                    table.setValueFromCoords( [1], [y], '', true );
                                }
                            }
                        }
                    
                    
                        if(!isProductInTable){
                            table.setValueFromCoords([0],[y], product.id, true);
                            table.setValueFromCoords([2],[y], product.name, true);
                            table.setValueFromCoords([3],[y], '', true);
                            table.setValueFromCoords([4],[y], 1, true);
                            table.setValueFromCoords([5],[y], product.price, true);
                            table.setValueFromCoords([6],[y], product.discount1, true);
                            table.setValueFromCoords([7],[y], product.tarif, true);
                            
                            
                            var id =  table.getValueFromCoords([0], [y]);
                            var value =  table.getValueFromCoords([4], [y]);  
                            
                            
                            $('#' + id).prop('checked', true);
                            var quantity = $('#'+id).parent().siblings('.quantity');
                            var quantityInput = $('#'+id).parent().siblings().children('.quantity input'); 
                            quantity.show();
                            quantityInput.val(value);
                        }  
                    } 
                }
            }
            
</script>";
        $code .= "<style>
.quantity{
display: none;
margin: 5px 0;
}
.add-row{
    margin: 5px 0;;
    font-size: 1.2rem;
    color: #3f48cc;
    border: none;
    background: none;
    float: none;
}
</style>";

//        $code .= "<script src='https://bossanova.uk/jexcel/v4/jexcel.js'></script>";
//        $code .= "<script src='https://bossanova.uk/jsuites/v2/jsuites.js'></script>";
//        $code .= "<link rel='stylesheet' href='https://bossanova.uk/jexcel/v4/jexcel.css' type='text/css' />";
//        $code .= "<link rel='stylesheet' href='https://bossanova.uk/jsuites/v2/jsuites.css' type='text/css' />";

        return $code;
    }

    function show(){
        $code = "";

        $code .= "<script>";
        $jsonProducts = [];
        foreach ($this->groups as $products){
            foreach ($products as $product){
                $jsonProducts[$product['sap_number']] = $product;
            }
        }
        /**
         * Technique to embed the data comes from PHP to use in JS
         *
         */
        $code .= "var allProducts = ".json_encode($jsonProducts) .";";
        $code .= "</script>";


        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;
    }

    //sidebar can't be a private function
    public function sidebar() {
        $cnt = 0;

        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Order Settings</h2>";
        $code .= "<div class='search col-12'>";
        $code .= "<input class='col-11' type='text' id='searchInput' placeholder='". l(18408, 1, 'Search') . "'>";
        $code .= "<i class='fas fa-search search-icon col-1'></i>";
        $code . "</div>";

        foreach($this->groups as $name => $products) {
            $code .= "<div class='title-part accordion' id='panel-".$cnt ."'>";
            $code .= "<h5 class='col-12'>" . $name . "</h5>";
            $code .= "<hr class='col-12'>";
            $code .= "</div>";
            $code .= "<div class='panel-".$cnt." checkboxes'>";
            foreach ($products as $product) {
                $code .= "<div class='col-12 row'>
                            <label class='col-9 checkbox-label'>
                            <input type='checkbox' data-sap-number='". $product['sap_number'] ."' id='". $product['id'] ."'";
                if(isset($this -> products[$product['id']])){
                    if ($this -> products[$product['id']]['units'] > 0) {
                        $code .= "checked";
                    }
                }
                $code .= ">";
                $code .= $product['name'];
                $code .= "</label>";
                $code .= "<div class='col-3 quantity'";
                if(isset($this -> products[$product['id']])){
                    if ($this -> products[$product['id']]['units'] > 0) {
                        $code .= "style='display: block' ";
                    }
                }
                $code .= ">";
                $code .= "<input  class='col-12' type='number' value='";
                if(isset($this -> products[$product['id']])){
                    if ($this -> products[$product['id']]['units'] > 0) {
                        $code .= $this->products[$product['id']]['units'];
                    }
                } else{
                    $code .= 1;
                }
                $code .= "' step='1'>";

                $code .= "</div>";
                $code .= "</div>";
            }
            $code .= "</div>";

            $cnt++;
        }

        $code .= "</div>";
        $code .= "<div>";
        $code .= "<button class='update' type='submit' name='button18191' value=1>" . l(18408, 1, 'Save') . "</button>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "</div>";
        $code .= "<div>";
        return $code;
    }

    private function content() {
        $code = "";

        $code .= "<div class='col-9 content'>";
        $code .= "<table id='spreadsheet' class='scorecard'>";
        $code .= "<thead>";
        $code .= "<tr>";
        $code .= "<th data-celltype='hidden'>id</th>";
        $code .= "<th>Product Code</th>";
        $code .= "<th>Name</th>";
        $code .= "<th>Einheiten/Kiste</th>";
        $code .= "<th>Menge</th>";
        $code .= "<th>PNR</th>";
        $code .= "<th>Rabatt</th>";
        $code .= "<th>PNF</th>";
        $code .= "</tr>";
        $code .= "</thead>";
        $code .= "<tbody>";

        $foundone = false;
        foreach($this->groups as $name => $products) {
            foreach ($products as $product) {
                if (isset($this->products[$product['id']])) {
                    if ($this->products[$product['id']]['units'] > 0) {

                        $foundone = true;

                        $code .= "<tr>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['id'];
                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['sap_number'];
                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['sap-name'];
                        $code .= "</td>";

                        $code .= "<td>";

                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['units'];
                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['price'];
                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['discount1'];
                        $code .= "</td>";

                        $code .= "<td>";
                        $code .= $this->products[$product['id']]['tarif'];
                        $code .= "</td>";


                        $code .= "</tr>";
                    }
                }
            }
        }

        if(!$foundone){
            $code .= "<tr>";
            $code .= "</tr>";
            $code .= "<tr>";
            $code .= "</tr>";
            $code .= "<tr>";
            $code .= "</tr>";
            $code .= "<tr>";
            $code .= "</tr>";
            $code .= "<tr>";
            $code .= "</tr>";
        }

        $code .= "</tbody>";
        $code .= "</table>";
        $code .= "<div>";
        $code .= "<button class='add-row' type='button' onclick='table.insertRow()'>";
        $code .= "<i class='fas fa-plus'></i>";
        $code .= "</button>";

        $code .=" <button class='add add-filter-fields' type='button' onclick='table.deleteRow();'>
                  <i class='fas fa-minus'></i>
                  </button>";
        $code .=" </div>
    <script>
    
    
   
    
    var table = jexcel(document.getElementById('spreadsheet'),
    {
        columns:[],
        onchange: changed,    
        oninsertrow: updateRow,
        license:'fd12c-f6d85-227f1-85ed4',
        }
        
        );   
    
    </script>
    ";
        $code .= "</div>";
        return $code;
    }
}

?>