<?php
require "../helpers.php";
$link = db_connection();
$sql = "SELECT crm_products_bs.id,
		crm_products_bs.sap_number,
		crm_products_bs.cat_id,
		crm_prices_dt.price,
		crm_products_bs.name
		
             
FROM crm_prices_dt
JOIN crm_products_bs ON crm_products_bs.id = product_id
JOIN crm_products_lk ON crm_products_bs.cat_id = crm_products_lk.id

WHERE crm_prices_dt.status<90
AND crm_products_bs.status<90
             
 ORDER BY crm_products_bs.product_pos, crm_products_bs.name";
$result = db_query($sql, $link);
while ($row = mysql_fetch_assoc($result)){
    print_r($row);
}
