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
        $shops[] = ['number' => '1714', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Mittelstr. 20, 58095 Hagen',  'typ' => 'Elektrofachm (groß)'];
        $shops[] = ['number' => '1715', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Limbecker Platz 1a, 45127 Essen',  'typ' => 'Elektrofachm (groß)'];
        $shops[] = ['number' => '1553', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'address' => 'Bahnhofstr. 48, 45879 Gelsenkirchen',  'typ' => 'Elektrofachm (groß)'];
        $shops[] = ['number' => '1721', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Kabeler Str. 25, 58099 Hagen', 'typ' => 'SBW Hypermarket'];
        $shops[] = ['number' => '811', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Schweriner Str. 4, 33605 Bielefeld', 'typ' => 'SBW Hypermarket'];
        $shops[] = ['number' => '812', 'client' => 'Real', 'name' => 'real GmbH', 'address' => 'Teutoburger Str. 98, 33607 Bielefeld', 'typ' => 'SBW Hypermarket'];
        $shops[] = ['number' => '18803', 'client' => 'REWE Center', 'name' => 'REWE Markt N. Heiderich oHG', 'address' => 'Glindfelder Weg 1, 59964 Medebach', 'typ' => ''];
        $shops[] = ['number' => '1375', 'client' => 'Metro C+C', 'name' => 'METRO Deutschland GmbH', 'address' => 'Parkstr. 200, 47829 Krefeld', 'typ' => 'C&C'];
        foreach ($shops as $row) {
            if ($row['client'] <> '') $group = $row['client'];
            $shop = [];
            $shop['number'] = $row['number'];
            $shop['name'] = $row['name'];
            $shop['address'] = $row['address'];
            $shop['typ'] = $row['typ'];
            $shop['client'] = $row['client'];
            $this->groups[$group][] = $shop;
        }




    }

}

?>