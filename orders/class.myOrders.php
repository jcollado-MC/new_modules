<?php

require_once("class.orders.php");

include("../helpers.php");

class myOrders extends Orders
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

        $this -> products[1] = ['id' => 1,'product_id' => '', 'units' => '5', 'sap_number' => '111', 'sap-name' => 'Gouda', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $this -> products[3] = ['id' => 3, 'product_id' => '', 'units' => '80', 'sap_number' => '113', 'sap-name' => 'Mozzarella', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $this -> products[6] = ['id' => 6, 'product_id' => '', 'units' => '1337', 'sap_number' => '116', 'sap-name' => 'Beef Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];



        // LOAD FIELDS
        $products[1] = ['id' => 1, 'sap_number' => '111', 'family' => 'Cheeses', 'name' => 'Gouda', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[2] = ['id' => 2, 'sap_number' => '112', 'family' => 'Cheeses', 'name' => 'Gorgonzola', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[3] = ['id' => 3, 'sap_number' => '113', 'family' => 'Cheeses', 'name' => 'Mozzarella', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[4] = ['id' => 4, 'sap_number' => '114', 'family' => 'Cheeses', 'name' => 'Parmesan', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[5] = ['id' => 5, 'sap_number' => '115', 'family' => 'Burgers', 'name' => 'Veggie Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[6] = ['id' => 6, 'sap_number' => '116', 'family' => 'Burgers', 'name' => 'Beef Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[7] = ['id' => 7, 'sap_number' => '117', 'family' => 'Burgers', 'name' => 'Cheese Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[8] = ['id' => 8, 'sap_number' => '118', 'family' => 'Burgers', 'name' => 'Chicken Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[9] = ['id' => 9, 'sap_number' => '119', 'family' => 'Burgers', 'name' => 'Pulled Pork Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[10] = ['id' => 10, 'sap_number' => '120', 'family' => 'Drinks', 'name' => 'Cola', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[11] = ['id' => 11, 'sap_number' => '121', 'family' => 'Drinks', 'name' => 'Fanta', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[12] = ['id' => 12, 'sap_number' => '122', 'family' => 'Drinks', 'name' => 'Sprite', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $products[13] = ['id' => 13, 'sap_number' => '123', 'family' => 'Drinks', 'name' => 'Water', 'discount1' => '', 'price' => '', 'tarif' => ''];
        foreach ($products as $row) {
            if ($row['family'] <> '') $group = $row['family'];
            $product = [];
            $product['id'] = $row['id'];
            $product['sap_number'] = $row['sap_number'];
            $product['name'] = $row['name'];
            $product['price'] = $row['price'];
            $product['discount1'] = $row['discount1'];
            $product['tarif'] = $row['tarif'];
            $product['label'] = $row['name'];
            $product['group'] = $row['family'];
            $this->groups[$group][] = $product;
        }




    }

}

?>