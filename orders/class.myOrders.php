<?php

require_once("class.ordereditor.php");

include("../helpers.php");

class myOrders extends OrderEditor
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

//        $this -> products[1] = ['id' => 1,'product_id' => '', 'units' => '5', 'sap_number' => '111', 'sap-name' => 'Gouda', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $this -> products[3] = ['id' => 3, 'product_id' => '', 'units' => '80', 'sap_number' => '113', 'sap-name' => 'Mozzarella', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $this -> products[6] = ['id' => 6, 'product_id' => '', 'units' => '1337', 'sap_number' => '116', 'sap-name' => 'Beef Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        //tarif:description


        // LOAD FIELDS
//        $products[1] = ['id' => 1, 'sap_number' => '111', 'family' => 'Cheeses', 'name' => 'Gouda', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[2] = ['id' => 2, 'sap_number' => '112', 'family' => 'Cheeses', 'name' => 'Gorgonzola', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[3] = ['id' => 3, 'sap_number' => '113', 'family' => 'Cheeses', 'name' => 'Mozzarella', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[4] = ['id' => 4, 'sap_number' => '114', 'family' => 'Cheeses', 'name' => 'Parmesan', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[5] = ['id' => 5, 'sap_number' => '115', 'family' => 'Burgers', 'name' => 'Veggie Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[6] = ['id' => 6, 'sap_number' => '116', 'family' => 'Burgers', 'name' => 'Beef Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[7] = ['id' => 7, 'sap_number' => '117', 'family' => 'Burgers', 'name' => 'Cheese Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[8] = ['id' => 8, 'sap_number' => '118', 'family' => 'Burgers', 'name' => 'Chicken Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[9] = ['id' => 9, 'sap_number' => '119', 'family' => 'Burgers', 'name' => 'Pulled Pork Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[10] = ['id' => 10, 'sap_number' => '120', 'family' => 'Drinks', 'name' => 'Cola', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[11] = ['id' => 11, 'sap_number' => '121', 'family' => 'Drinks', 'name' => 'Fanta', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[12] = ['id' => 12, 'sap_number' => '122', 'family' => 'Drinks', 'name' => 'Sprite', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        $products[13] = ['id' => 13, 'sap_number' => '123', 'family' => 'Drinks', 'name' => 'Water', 'discount1' => '', 'price' => '', 'tarif' => ''];
//        foreach ($products as $row) {
//            if ($row['family'] <> '') $group = $row['family'];
//            $product = [];
////            $product['id'] = $row['id'];
////            $product['sap_number'] = $row['sap_number'];
////            $product['name'] = $row['name'];
////            $product['price'] = $row['price'];
////            $product['discount1'] = $row['discount1']; //crm_prices_dt the following 3 as well
////            $product['tarif'] = $row['tarif'];
////            $product['label'] = $row['name'];
////            $product['group'] = $row['family'];
////            $this->groups[$group][] = $product;
//        }

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

        $order_id = 11111;

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