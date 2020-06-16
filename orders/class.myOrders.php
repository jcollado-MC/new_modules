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

        // CHECK TYPE & LANGUAGE


        // LOAD FIELDS
        $products[] = ['id' => 1, 'family' => 'Cheeses', 'name' => 'Gouda'];
        $products[] = ['id' => 2, 'family' => 'Cheeses', 'name' => 'Gorgonzola'];
        $products[] = ['id' => 3, 'family' => 'Cheeses', 'name' => 'Mozzarella'];
        $products[] = ['id' => 4, 'family' => 'Cheeses', 'name' => 'Parmesan'];
        $products[] = ['id' => 5, 'family' => 'Burgers', 'name' => 'Veggie Burger'];
        $products[] = ['id' => 6, 'family' => 'Burgers', 'name' => 'Beef Burger'];
        $products[] = ['id' => 7, 'family' => 'Burgers', 'name' => 'Cheese Burger'];
        $products[] = ['id' => 8, 'family' => 'Burgers', 'name' => 'Chicken Burger'];
        $products[] = ['id' => 9, 'family' => 'Burgers', 'name' => 'Pulled Pork Burger'];
        $products[] = ['id' => 10, 'family' => 'Drinks', 'name' => 'Cola'];
        $products[] = ['id' => 11, 'family' => 'Drinks', 'name' => 'Fanta'];
        $products[] = ['id' => 12, 'family' => 'Drinks', 'name' => 'Sprite'];
        $products[] = ['id' => 13, 'family' => 'Drinks', 'name' => 'Water'];
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