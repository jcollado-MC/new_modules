<?php
// Script created with CFB Framework Builder
// Client:  MARKET CONTROL
// Project: MASTER I
// Class Revision: 1
// Date of creation: 2020-11-09
// All Copyrights reserved
// This is a class file and can not be executed directly
// CLASS FILE
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
}

class OrderEditor{

    var $orderID = '';
    var $orderStatus;
    var $existingOrders = [];
    var $groups = [];
    private static $header;

//[SUBTASKS]
//SUBTASK 18415: "VARS" --------------------------------------------

    public function __construct($orderID)
    {
        $this->orderID = $orderID;
        $this->existingOrders = $this->getExistingOrders();
    }

    //SUBTASK 18407: "HEADER" --------------------------------------------
    static function Header(){
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script src=\"../Jquery/jquery-3.4.1.min.js\"></script>";

        $code .= "<script>
                    
            $(document).ready(function(){    
                
                updateRow();
                var orderList = new Array();
                $('.update').on('click', function() {
                    $('tr').siblings().each(function(){
                          var sap_number = $(this).find('[data-x=1]').text();
                          var quantity = $(this).find('[data-x=4]').text();
                          var name = $(this).find('[data-x=2]').text();
                          var order = { 'sap_number' : sap_number, 'quantity' :quantity, 'name' : name };          
                          orderList.push(order);   
                    });
                   
                    var postData = JSON.stringify(orderList);
                    $('#order_input').val(JSON.stringify(orderList));
                    $.ajax({
                      type:'POST',
                      url:'orders.php',
                      contentType: 'application/json',
                      dataType: 'json',
                      data: {'order': postData},
                    });
                });
                
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
                     event.stopPropagation();
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
                     
                     var checked = $(this).prop('checked');
                     if(checked){
                          var element = $('tr:contains(' + productCode + ')').children().eq(2).text(); 
                          if(element == productCode){
                             //this element exists on the table, increase the quantity
                             var qnty = $('tr:contains(' + productCode + ')').children().eq(5).text();
                             $('tr:contains(' + productCode + ')').children().eq(5).text(parseInt(qnty) + 1); 
                          }else{
                             //this element does not exist on the table, insert 
                             console.log('INSERT');
                             table.insertRow( [idThis, productCode, name, '' , qty , ''] ,0, true);
                          }                  
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
                 
                 $('.delete-row').on('click' , function(){
                     
                     var rowCount = $('tbody tr').length;
                     var lastRow_sap = $('tbody tr').last().children(':eq(2)').text();
                     if(rowCount != 1 && lastRow_sap.length != ''){
                         
                           var selector = '[data-sap-number=' + lastRow_sap + ']';
                           $(selector).prop('checked', false);
                           $(selector).parent().siblings().toggle();
                      
                     }else if(rowCount == 1){
                         
                        table.insertRow( ['', '', '', '' , '' , ''] ,0, true);                  
                        $('tbody tr').last().text('');
                        $('.checkboxes input:checkbox').prop('checked', false);
                        var selector = '[data-sap-number=' + lastRow_sap + ']';
                        $(selector).parent().siblings().css('display', 'none');
                        
                     }                
                     table.deleteRow();
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
        display: inline;
        margin: 5px 0px;
        font-size: 1.2rem;
        border: none;
        background: none;
        float: none;
        box-shadow: none;
    }
    .delete-row{
        display: inline;
        margin: 5px 0px;
        font-size: 1.2rem;
        border: none;
        background: none;
        float: none;
        box-shadow: none;
    }
    </style>";

        $code .= "<script src='https://bossanova.uk/jexcel/v4/jexcel.js'></script>";
        $code .= "<script src='https://bossanova.uk/jsuites/v2/jsuites.js'></script>";
        $code .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>";
        $code .= "<link rel='stylesheet' href='https://bossanova.uk/jexcel/v4/jexcel.css' type='text/css' />";
        $code .= "<link rel='stylesheet' href='https://bossanova.uk/jsuites/v2/jsuites.css' type='text/css' />";

        return $code;
    }
    //SUBTASK 18413: "SHOW" --------------------------------------------
    public function show(){
        $this->getSidebarProducts();

        $code  = "<script>";
        $jsonProducts = [];
        foreach ($this->groups as $products){
            foreach ($products as $product){
                $jsonProducts[$product['sap_number']] = $product;
            }
        }
        $code .= "var allProducts = ".json_encode($jsonProducts) .";";
        $code .= "</script>";
        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post' action='' id=''>";
        $code .= $this->sidebar();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;
    }
    //SUBTASK 18408: "SIDEBAR" --------------------------------------------
    public function sidebar() {

        $cnt = 0;

        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>" .l('18408' ,'1', 'Order Settings') ."</h2>";
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
        $code .= "<input type='hidden' name='order' value='' id='order_input'>";
        $code .= "<button class='update' name='button18191' value=1>" . l(18408, 2, 'Save') . "</button>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "</div>";
        $code .= "<div>";
        return $code;
    }
    //SUBTASK 18409: "CONTENT" --------------------------------------------
    private function content()
    {

        $code = "";
        $code .= "<div><b id='success'></b></div>";
        $code .= "<div class='col-9 content'>";
        $code .= "<table id='spreadsheet' class='scorecard'>";
        $code .= "<thead>";
        $code .= "<tr>";
        $code .= "<th data-celltype='hidden'>id</th>";
        $code .= "<th>" . l('18409', '3', 'Product Code') . "</th>";
        $code .= "<th>" . l('18409', '4', 'Name') . "</th>";
        $code .= "<th>" . l('18409', '5', 'Stock') . "</th>";
        $code .= "<th>" . l('18409', '6', 'Quantity') . "</th>";
        $code .= "<th>" . l('18409', '7', 'PNR') . "</th>";
        $code .= "<th>" . l('18409', '8', 'Discount') . "</th>";
        $code .= "<th>" . l('18409', '9', 'PNF') . "</th>";
        $code .= "</tr>";
        $code .= "</thead>";
        $code .= "<tbody>";

        $foundone = false;

        if(isset($this->existingOrders)){
            foreach($this->existingOrders as $order) {
                if (isset($order['id'])) {
                    //if ($order['units'] > 0) {

                    $foundone = true;

                    $code .= "<tr>";

                    $code .= "<td>";
                    $code .= $order['id'];
                    $code .= "</td>";

                    $code .= "<td>";
                    $code .= $order['sap_number'];
                    $code .= "</td>";

                    $code .= "<td>";
                    $code .= $order['name'];
                    $code .= "</td>";

                    $code .= "<td>";
                    //$code .= $order['stock'];  -> in prducts_bs in db
                    $code .= "</td>";

                    $code .= "<td>";
                    $code .= $order['quantity'];
                    $code .= "</td>";

                    $code .= "<td>";
                    //$code .= $order['price'];
                    $code .= "</td>";

                    $code .= "<td>";
                    //$code .= $this->products[$product['id']]['discount1'];
                    $code .= "</td>";

                    $code .= "<td>";
                    //$code .= $this->products[$product['id']]['tarif'];
                    $code .= "</td>";


                    $code .= "</tr>";
                    //}
                }

            }

        }

        if(!$foundone){
            $code .= "<tr>";
            $code .= "</tr>";
        }

        $code .= "</tbody>";
        $code .= "</table>";
        $code .= "<div>";
        $code .= "<button class='add-row' style='box-shadow: none;' type='button' onclick='table.insertRow()'>";
        $code .= "<i class='fas fa-plus' style='color: #a41e34;'></i>";
        $code .= "</button>";

        $code .="<button class='delete-row' style='margin: 5px 0px 0px 5px; box-shadow: none;' type='button'>";
        $code .= "<i class='fas fa-minus' style='color: #a41e34;'></i>";
        $code .= "</button>";
        $code .= "</div>";

        $code .= "<script>";
        $code .= "var table = jexcel(document.getElementById('spreadsheet'),";
        $code .= "{";
        $code .= "columns:[],";
        $code .= "    onchange: changed,";
        $code .= "    oninsertrow: updateRow,";
        $code .= "license:'fd12c-f6d85-227f1-85ed4',";
        $code .= "});";
        $code .= "</script>";

        $code .= "</div>";
        return $code;
    }
    //GET THE EXISTING ORDER LIST FROM THE DB
    private function getExistingOrders(){
        $existingOrders = [];

        //RETRIEVE THE EXISTING ORDERS FROM THE DB
        $sql = "SELECT 
            crm_order_bs.id AS order_id,
            crm_products_bs.sap_number AS sap_number,
            crm_order_dt.quantity,
            crm_products_bs.name,
            crm_order_bs.status,
            crm_products_lk.name AS family
    
            FROM crm_order_bs
    
            JOIN crm_order_dt ON crm_order_bs.id = crm_order_dt.order_id
            JOIN crm_products_bs ON crm_products_bs.id = crm_order_dt.product_id
            JOIN crm_products_lk ON crm_products_bs.cat_id = crm_products_lk.id
            
            WHERE crm_order_bs.id = " . mysql_real_escape_string($this->orderID);
        $result = db_query($sql);
        while($row = db_fetch_row($result)) {

            $this->orderStatus = $row['status'];
            $order['id'] = $row['order_id'];
            $order['sap_number'] = $row['sap_number'];
            $order['quantity'] = $row['quantity'];
            $order['name'] = $row['name'];
            array_push($existingOrders, $order);
        }
        return $existingOrders;
    }
    //GET ALL PRODUCTS FROM THE DB
    private function getSidebarProducts(){

        //RETRIEVE ALL THE ITEMS FROM THE DB TO DISPLAY ON THE SIDEBAR
        $sql = "SELECT crm_products_bs.id AS id,
                crm_products_bs.sap_number AS sap_number,
                crm_products_lk.name AS family,
                crm_prices_dt.price AS price,
                crm_products_bs.name AS product_name
        
        
                FROM crm_prices_dt
                JOIN crm_products_bs ON crm_products_bs.id = product_id
                JOIN crm_products_lk ON crm_products_bs.cat_id = crm_products_lk.id
                
                WHERE crm_prices_dt.status<90
                AND crm_products_bs.status<90
                
                ORDER BY crm_products_bs.product_pos, crm_products_bs.name";
        $result = db_query($sql);
        while ($row = db_fetch_row($result)){
            $group = $row['family'];
            $product['id'] = $row['id'];
            $product['sap_number'] = $row['sap_number'];
            $product['name'] = $row['product_name'];
            $product['price'] = $row['price'];
            $product['group'] = $row['family'];
            $this->groups[$group][] = $product;
        }
    }
    //SAVE NEW ORDERS
    function saveOrders($newOrders){

        if($this->orderStatus == 5){
            $this->compareLists($newOrders, $this->existingOrders);
        }
    }
    //DETECT THE CHANGES ON THE ORDER LIST
    private function compareLists($newList, $oldList){

        $newSize = sizeof($newList);
        $oldSize = sizeof($oldList);

        if($newSize == $oldSize){
            for($i = 0; $i < ($newSize); $i++){
                if($newList[$i]['quantity'] != $oldList[$i]['quantity']){
                    $sql = "
                        SELECT  crm_order_dt.product_id,
                                crm_products_bs.sap_number AS sap_number
                
                        FROM crm_order_bs
                
                        JOIN crm_order_dt ON crm_order_bs.id = crm_order_dt.order_id
                        JOIN crm_products_bs ON crm_products_bs.id = crm_order_dt.product_id
                 
                        WHERE crm_order_bs.id = ". $this->orderID . " AND sap_number = " . mysql_real_escape_string($newList[$i]['sap_number']);
                    $result = db_query($sql);
                    while($row = db_fetch_row($result)) {
                        $product_id = $row['product_id'];
                    }


                    $sql = "
                          UPDATE crm_order_dt
      
                          SET quantity = " . mysql_real_escape_string($newList[$i]['quantity']) . "
      
                          WHERE crm_order_dt.order_id = " . mysql_real_escape_string($this->orderID) . "
                          AND crm_order_dt.product_id = " . mysql_real_escape_string($product_id);
                    db_query($sql);
                }
            }
        }
        elseif ($newSize > $oldSize){
            //NEW ITEM ADDED
            $added = [];

            for($i = 0; $i < ($newSize - $oldSize) ; $i++){
                array_push($added, $newList[$i]);
            }

            foreach ($added as $added_item){

                $sql = "
                       SELECT id 
                       FROM crm_products_bs 
                       WHERE sap_number  = " . mysql_real_escape_string($added_item['sap_number']);
                $result = db_query($sql);
                while($row = db_fetch_row($result)) {
                    $product_id = $row['id'];
                }

                $sql = "
                          INSERT INTO `crm_order_dt`( `order_id`, `product_id`, `quantity`)
                          VALUES('" . mysql_real_escape_string($this->orderID) . "',
                                 '" . mysql_real_escape_string($product_id) . "',
                                 '" . mysql_real_escape_string($added_item['quantity']) ."')";
                db_query($sql);
            }

        }else{
            //ITEM DELETED
            $deleted = [];

            for($i = 0 ; $i < $oldSize; $i++){
                if(!isset($newList[$i])){
                    array_push($deleted, $oldList[$i]);
                }

            }
            foreach ($deleted as $deleted_item){
                $product_id = 0;
                $sql = "
                        SELECT  crm_order_dt.product_id,
                                crm_products_bs.sap_number AS sap_number
                
                        FROM crm_order_bs
                
                        JOIN crm_order_dt ON crm_order_bs.id = crm_order_dt.order_id
                        JOIN crm_products_bs ON crm_products_bs.id = crm_order_dt.product_id
                 
                        WHERE crm_order_bs.id = ". $this->orderID . " AND sap_number = " . mysql_real_escape_string($deleted_item['sap_number']);
                $result = db_query($sql);
                while($row = db_fetch_row($result)) {
                    $product_id = $row['product_id'];
                }

                $sql = "
                          DELETE
                          FROM crm_order_dt
                          WHERE crm_order_dt.product_id = " . mysql_real_escape_string($product_id);
                db_query($sql);
            }
        }
    }
//[/SUBTASKS]
}
?>
