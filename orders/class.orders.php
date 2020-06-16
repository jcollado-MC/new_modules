<?php

class orders{

    function _construct(){}

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "
         <script src=\"../Jquery/jquery-3.4.1.min.js\"></script>
        ";

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
                    $(this).toggle( $(this).siblings().children('.checkbox-label').text().toLowerCase().indexOf(value) > -1 );
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
                 
                 $(this).parent().parent().find('.quantity').toggle(checked);

                
             });
             
             
             $('.checkboxes input:checkbox').change( function(){
                 
                 var idThis = $(this).attr('id');
                 var name = $(this).parent().text();
                 var qty = 1;
              
                 
                 var checked = $(this).prop('checked');
                 if(checked){
                     table.insertRow(  { id: '1', data:[ idThis, name, '' , '' , qty]} );
                 } else {
                     table.deleteRow();
                 }
                 
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


        $cnt = 0;

        $code = "";

        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Order Settings</h2>";

        $code .= "<div class='search col-12'>
        <input class='col-11' type='text' id='orderSearchInput' placeholder='Search'>
         <i class='fas fa-search search-icon col-1'></i>
          
    </div>";
        foreach($this->groups as $name => $products) {
            $code .= "<div class='title-part accordion' id='panel-".$cnt ." '>
                        <h5 class='col-12'>" . $name . "</h5>
                                <hr class='col-12'>
                            </div>";


                $code .= "<div class='panel-".$cnt." checkboxes'>";
                foreach ($products as $product) {
                    $code .= "   <div class='col-12 row'>
                        <label class='col-8 checkbox-label'>
                            <input type='checkbox' id='". $product['id'] . "'>
                            " . $product['name'] . "
                        </label>
                        <label class='col-4 quantity'>Quantity: <input  class='col-12' type='number' value='1' step='1'></label>
                    </div>";
                }
                $code .= "</div>";

            $cnt++;
        }

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
      <th>id</th>
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
  
   
</tbody>
</table>
    <script>
    var table = jexcel(document.getElementById('spreadsheet'),
    {
    columns:[
        {type:'text',width:'200px',readOnly:true},
        {type:'text',width:'200px',readOnly:true},
        {type:'text',width:'100px',readOnly:true},
        {type:'text',width:'150px'},
        {type:'text',width:'150px'},
        {type:'text',width:'150px'},
        {type:'text',width:'150px'},
        {type:'text',width:'150px'}
        ],
        license:'fd12c-f6d85-227f1-85ed4',
        });
    
    </script>
    <hr>
    <div class='scorecard'>
    <button type='submit' name='button18191' value=1>Speichern</button>
</div>";

        $code .= "</div>";

        return $code;
    }



}




?>