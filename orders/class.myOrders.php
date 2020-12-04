<?php

require_once("class.ordereditor.php");

include("../helpers.php");

class myOrders
{
    static function header()
    {
        echo parent::Header();
    }


    function __construct()
    {
        global $CFR_USER, $myPageBody;
        self::Header();
        ini_set("memory_limit", "1024M");
        ini_set("max_execution_time", "1200");

        $link = db_connection();
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

        //sidebar, items
        $result = db_query($sql, $link);
        while ($row = db_fetch_row($result)){
            $group = $row['family'];
            $product['id'] = $row['id'];
            $product['sap_number'] = $row['sap_number'];
            $product['name'] = $row['product_name'];
            $product['price'] = $row['price'];
            $product['group'] = $row['family'];
            $this->groups[$group][] = $product;
        }

        $order_id = 147;
        //content, table items
        $sql = "SELECT crm_order_bs.id AS order_id,
                crm_products_bs.sap_number AS sap_number,
                crm_order_dt.quantity,
                crm_products_bs.name,
                crm_products_lk.name AS family

                FROM crm_order_bs

                JOIN crm_order_dt ON crm_order_bs.id = crm_order_dt.order_id
                JOIN crm_products_bs ON crm_products_bs.id = crm_order_dt.product_id
                JOIN crm_products_lk ON crm_products_bs.cat_id = crm_products_lk.id
                
                WHERE crm_order_bs.id = " . $order_id;
        $result = db_query($sql, $link);

        $order = [];
        while($row = db_fetch_row($result)){

            $order['id'] = $row['order_id'];
            $order['sap_number'] = $row['sap_number'];
            $order['quantity'] = $row['quantity'];
            $order['name'] = $row['name'];
            $this->orders[] = $order;
        }
    }
}

?>