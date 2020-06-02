
$myHeader .= "<script src='https://jexcel.net/v5/jexcel.js'></script>";
$myHeader .= "<script src='https://jexcel.net/v5/jsuites.js'></script>";
$myHeader .= "<link rel='stylesheet' href='https://jexcel.net/v5/jexcel.css' type='text/css' />";
$myHeader .= "<link rel='stylesheet' href='https://jexcel.net/v5/jsuites.css' type='text/css' />";

//SUBTASK 18195: "HEADER ELEMENT" --------------------------------------------
$cat = db_direct("SELECT * FROM crm_order_lk WHERE id=".$ftq['cat_id']);
$status = db_direct("SELECT * FROM crm_order_st WHERE id=".$ftq['status']);

$myPageBody  = "<h1 style='background-color: ".$status['color'].";'>";
$myPageBody .= "N° $ftq[0] ";
$myPageBody .= $cat['name']." ";
$myPageBody .= "$ftq[1]";
$myPageBody .= "</h1>";

//SUBTASK 18191: "CONTROL" --------------------------------------------
$order = new \ORDERS();
$order->open($ftq['id']);
$myPageBody .= "<div class='ssr col-12 content'>";
$myPageBody .= $order->sidebar();

$myPageBody .= ssr2::header();
if($_REQUEST['button18191']){

}
$myPageBody .= "<form method='post'>\n";
    // PRODUCTS
  $sql= "SELECT crm_order_dt.id, 
                              crm_products_bs.sap_number, 
                crm_products_bs.name, 
                crm_order_dt.quantity, 
                crm_order_dt.dto1, 
                crm_products_bs.unidades_por_caja AS uc, 
                crm_order_dt.price_neto, 
                crm_order_dt.price_tarif, 
                crm_order_dt.product_id AS product_id

           FROM crm_order_dt
      LEFT JOIN crm_products_bs ON crm_order_dt.product_id = crm_products_bs.id
      LEFT JOIN crm_products_lk ON crm_products_bs.cat_id = crm_products_lk.id 
              WHERE    crm_order_dt.order_id = $ftq[0]
              AND crm_order_dt.status<90
       ORDER BY crm_products_lk.name, crm_products_bs.name";
  $result = db_query($sql);
  $myPageBody .= "<table id='spreadsheet' class='scorecard'>\n";
  $myPageBody .= "  <thead>\n";
  $myPageBody .= "    <tr>\n";
  // $myPageBody .= "      <th style='width: 30px; !important'>".l(16815,21,"Margin")."</th>\n";
    $myPageBody .= "      <th>".l(16815,12,"Nombre")."</th>\n";
  $myPageBody .= "      <th>".l(16815,17,"Uds/Caja")."</th>\n";
  // $myPageBody .= "      <th>".l(16815,22,"Stock")."</th>\n";
  $myPageBody .= "      <th>".l(16815,11,"Código")."</th>\n";
  $myPageBody .= "      <th>".l(16815,13,"Cantidad")."</th>\n";
  $myPageBody .= "      <th>".l(16815,20,"PNR")."</th>\n";
  $myPageBody .= "      <th>".l(16815,14,"Descuento")."</th>\n";
  $myPageBody .= "      <th>".l(16815,23,"PNF")."</th>\n";
  $myPageBody .= "    </tr>\n";
  $myPageBody .= "  </thead>\n";
  $myPageBody .= "<tbody>\n";
  while($row = db_fetch_row($result)){
    $total = $row['quantity'];
echo "<head>".$myHeader."</head>";
    if($row['dto1']>0)$dto = number_format($row['dto1'], 2, ',', '')."%"; else $dto = '';
    if($row['price_tarif']>0)$pnr = number_format($row['price_tarif'], 2, '.', '').""; else $pnr = '';
    if($row['price_neto']>0)$price = number_format($row['price_neto'], 2, '.', '').""; else $price = '';
    $myPageBody .= "    <tr>\n";
    //$myPageBody .= "      <td>".self::getMargin($shop['id'], $shop['client_id'], $row['product_id'])."</td>\n";
    $myPageBody .= "      <td>".$row['name']."</td>\n";
    //$myPageBody .= "      <td>".products::stock($row[0])."</td>\n";
    $myPageBody .= "      <td>".$row['sap_number']."</td>\n";
    $myPageBody .= "      <td>".$row['uc']."</td>\n";
    $myPageBody .= "      <td>".$row['quantity']."</td>\n";
echo "<head>".$myHeader."</head>";
echo "<head>".$myHeader."</head>";
    $myPageBody .= "      <td>".$row['pnr']."</td>\n";
    $myPageBody .= "      <td>".$row['dto']."</td>\n";
    $myPageBody .= "      <td>".$row['price']."</td>\n";
    $myPageBody .= "    </tr>\n";    
  }
  for($n=1;$n<15;$n++){
    $myPageBody .= "    <tr></tr>\n";    
  }
  $myPageBody .= "</tbody>\n";
  $myPageBody .= "</table>\n";

$myPageBody .= "<script>
var table = jexcel(document.getElementById('spreadsheet'), {
    columns: [
        {type: 'text', width: '200px', readOnly:true}, 
        {type: 'text', width: '100px', readOnly:true}, 
        {type: 'text', width: '150px'}, 
        {type: 'text', width: '150px'}, 
        {type: 'text', width: '150px'}, 
        {type: 'text', width: '150px'}, 
        {type: 'text', width: '150px'}
  ], 
    license: 'fd12c-f6d85-227f1-85ed4',
});

</script>";

$myPageBody .= "<hr>";
$myPageBody .= "<div  class='scorecard'>";
$myPageBody .= "<button type='submit' name='button18191' value=1>";
$myPageBody .= label('BUTTON', '18191', 'Guardar');
$myPageBody .= "</button>\n";
$myPageBody .= "</div>";

$myPageBody .= "</form>\n";
$myPageBody .= "</div>";
                        
echo "<html>";
echo "<head>".$myHeader."</head>";
echo "<body>".$myPageBody."</body>";
echo "<html>";
                        
                        
                        

