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

        $this -> products[1] = ['id' => 1,'product_id' => '', 'units' => '5', 'sap-number' => '', 'sap-name' => 'Gouda', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $this -> products[3] = ['id' => 3, 'product_id' => '', 'units' => '80', 'sap-number' => '', 'sap-name' => 'Mozzarella', 'discount1' => '', 'price' => '', 'tarif' => ''];
        $this -> products[6] = ['id' => 6, 'product_id' => '', 'units' => '1337', 'sap-number' => '', 'sap-name' => 'Beef Burger', 'discount1' => '', 'price' => '', 'tarif' => ''];



        // LOAD FIELDS
        $products[1] = ['id' => 1, 'family' => 'Cheeses', 'name' => 'Gouda'];
        $products[2] = ['id' => 2, 'family' => 'Cheeses', 'name' => 'Gorgonzola'];
        $products[3] = ['id' => 3, 'family' => 'Cheeses', 'name' => 'Mozzarella'];
        $products[4] = ['id' => 4, 'family' => 'Cheeses', 'name' => 'Parmesan'];
        $products[5] = ['id' => 5, 'family' => 'Burgers', 'name' => 'Veggie Burger'];
        $products[6] = ['id' => 6, 'family' => 'Burgers', 'name' => 'Beef Burger'];
        $products[7] = ['id' => 7, 'family' => 'Burgers', 'name' => 'Cheese Burger'];
        $products[8] = ['id' => 8, 'family' => 'Burgers', 'name' => 'Chicken Burger'];
        $products[9] = ['id' => 9, 'family' => 'Burgers', 'name' => 'Pulled Pork Burger'];
        $products[10] = ['id' => 10, 'family' => 'Drinks', 'name' => 'Cola'];
        $products[11] = ['id' => 11, 'family' => 'Drinks', 'name' => 'Fanta'];
        $products[12] = ['id' => 12, 'family' => 'Drinks', 'name' => 'Sprite'];
        $products[13] = ['id' => 13, 'family' => 'Drinks', 'name' => 'Water'];
        foreach ($products as $row) {
            if ($row['family'] <> '') $group = $row['family'];
            $product = [];
            $product['id'] = $row['id'];
            $product['name'] = $row['name'];
            $product['label'] = $row['name'];
            $product['group'] = $row['family'];
            $this->groups[$group][] = $product;
        }




    }

}

?>