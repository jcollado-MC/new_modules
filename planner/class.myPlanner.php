<?php

require_once("class.planner.php");

include("../helpers.php");

class myPlanner extends Planner
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


        $shops[] = ['shop_id' => '1', 'number' => '1714', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Mittelstr. 20', 'city' =>'Hagen',  'typ' => 'Elektrofachm (groß)', 'freq' => '1', 'offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Hagen', 'group3'=>'Nordwest' ];
        $shops[] = ['shop_id' => '2', 'number' => '1715', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Limbecker Platz 1a', 'city' =>'Essen',  'typ' => 'Elektrofachm (groß)', 'freq' => '1', 'offline' => 'false', 'group1'=>'Saturn', 'group2'=>'Essen', 'group3'=>'Rhein-Ruhr'];
        $shops[] = ['shop_id' => '3', 'number' => '1553', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Bahnhofstr. 48', 'city' =>'Gelsenkirchen',  'typ' => 'Elektrofachm (groß)', 'freq' => '2','offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Gelsenkirchen', 'group3'=>'Rhein-Ruhr'];
        $shops[] = ['shop_id' => '4', 'number' => '1721', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Kabeler Str. 25', 'city' => 'Hagen', 'typ' => 'SBW Hypermarket', 'freq' => '1', 'offline' => 'true', 'group1'=>'Real', 'group2'=>'Hagen', 'group3'=>'Nordwest'];
        $shops[] = ['shop_id' => '5', 'number' => '811', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Schweriner Str. 4', 'city' => 'Bielefeld', 'typ' => 'SBW Hypermarket', 'freq' => '1', 'offline' => 'false', 'group1'=>'Real', 'group2'=>'Bielefeld', 'group3'=>'Nordwest'];
        $shops[] = ['shop_id' => '6', 'number' => '812', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Teutoburger Str. 98', 'city' => 'Bielefeld', 'typ' => 'SBW Hypermarket', 'freq' => '1', 'offline' => 'false',  'group1'=>'Real', 'group2'=>'Bielefeld', 'group3'=>'Nordwest'];
        $shops[] = ['shop_id' => '7', 'number' => '18803', 'client' => 'REWE Center', 'name' => 'REWE Markt N. Heiderich oHG', 'street' => 'Glindfelder Weg 1', 'city' => 'Medebach', 'typ' => '', 'freq' => '3', 'offline' => 'true',  'group1'=>'Rewe', 'group2'=>'Medebach', 'group3'=>'Nordwest'];
        $shops[] = ['shop_id' => '8', 'number' => '1375', 'client' => 'Metro C+C', 'name' => 'METRO Deutschland GmbH', 'street' => 'Parkstr. 200', 'city' => 'Krefeld', 'typ' => 'C&C', 'freq' => '4', 'offline' => 'true',  'group1'=>'Metro', 'group2'=>'Krefeld', 'group3'=>'Bergisches Land'];
        foreach ($shops as $row) {
            if ($row['client'] <> '') $group = $row['client'];
            $shop = [];
            $shop['shop_id'] = $row['shop_id'];
            $shop['number'] = $row['number'];
            $shop['offline'] = $row['offline'];
            $shop['name'] = $row['name'];
            $shop['city'] = $row['city'];
            $shop['street'] = $row['street'];
            $shop['typ'] = $row['typ'];
            $shop['freq'] = $row['freq'];
            $shop['client'] = $row['client'];
            $this->groups[$group][] = $shop;
        }


        $this->events[] = ['id'=>1, 'name'=>'Meeting', 'multiple' =>'true'];
        $this->events[] = ['id'=>2, 'name'=>'Hotel', 'multiple' =>'false', 'icon'=>"http://brita.de.market-control.net/intern/data_site/PRV/prv14_20160706122249.png"];
        $this->events[] = ['id'=>3, 'name'=>'Convention', 'multiple' =>'false', 'icon'=>"http://brita.de.market-control.net/intern/data_site/PRV/prv10_20160706123959.jpg"];
        $this->events[] = ['id'=>4, 'name'=>'Call', 'multiple' =>'true'];
        $this->events[] = ['id'=>5, 'name'=>'Holiday', 'multiple' =>'', 'icon'=>"http://brita.de.market-control.net/intern/data_site/PRV/12_20160706121710.png"];


    }

}

?>