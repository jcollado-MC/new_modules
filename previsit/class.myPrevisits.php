<?php

require_once("class.planner.php");

include("../helpers.php");

class myPrevisits extends Planner
{
    static function header()
    {
        echo parent::Header();
    }


    function __construct()
    {
        global $CFR_USER, $myPageBody;
        ini_set("memory_limit", "1024M");
        ini_set("max_execution_time", "1200");



        // LOAD FIELDS
        $shops[] = ['shop_id' => '1', 'number' => '1714', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Mittelstr. 20, 58095 Hagen',  'typ' => 'Elektrofachm (groß)', 'freq' => '1'];
        $shops[] = ['shop_id' => '2', 'number' => '1715', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Limbecker Platz 1a, 45127 Essen',  'typ' => 'Elektrofachm (groß)', 'freq' => '1'];
        $shops[] = ['shop_id' => '3', 'number' => '1553', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Bahnhofstr. 48, 45879 Gelsenkirchen',  'typ' => 'Elektrofachm (groß)', 'freq' => '2'];
        $shops[] = ['shop_id' => '4', 'number' => '1721', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Kabeler Str. 25, 58099 Hagen', 'typ' => 'SBW Hypermarket', 'freq' => '1'];
        $shops[] = ['shop_id' => '5', 'number' => '811', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Schweriner Str. 4, 33605 Bielefeld', 'typ' => 'SBW Hypermarket', 'freq' => '1'];
        $shops[] = ['shop_id' => '6', 'number' => '812', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Teutoburger Str. 98, 33607 Bielefeld', 'typ' => 'SBW Hypermarket', 'freq' => '1'];
        $shops[] = ['shop_id' => '7', 'number' => '18803', 'client' => 'REWE Center', 'name' => 'REWE Markt N. Heiderich oHG', 'address' => 'Glindfelder Weg 1, 59964 Medebach', 'typ' => '', 'freq' => '3'];
        $shops[] = ['shop_id' => '8', 'number' => '1375', 'client' => 'Metro C+C', 'name' => 'METRO Deutschland GmbH', 'address' => 'Parkstr. 200, 47829 Krefeld', 'typ' => 'C&C', 'freq' => '4'];
        foreach ($shops as $row) {
            if ($row['client'] <> '') $group = $row['client'];
            $shop = [];
            $shop['shop_id'] = $row['shop_id'];
            $shop['number'] = $row['number'];
            $shop['name'] = $row['name'];
            $shop['address'] = $row['address'];
            $shop['typ'] = $row['typ'];
            $shop['freq'] = $row['freq'];
            $shop['client'] = $row['client'];
            $this->groups[$group][] = $shop;
        }




    }

}

?>