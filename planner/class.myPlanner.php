<?php

require_once("class.planner.php");
include("../class.format.php");

include("../helpers.php");

class myPlanner extends Planner
{
    static function header()
    {
        echo parent::Header();
    }
    function object(){
        $object = "[{\"id\":\"434225\",\"date\":\"2020-07-20\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4548\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434228\",\"date\":\"2020-07-20\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4544\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434224\",\"date\":\"2020-07-20\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"4513\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434226\",\"date\":\"2020-07-20\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4587\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434232\",\"date\":\"2020-07-20\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"11766\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434239\",\"date\":\"2020-07-21\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4509\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434249\",\"date\":\"2020-07-21\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4497\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434236\",\"date\":\"2020-07-21\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"4052\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434247\",\"date\":\"2020-07-21\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4536\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434234\",\"date\":\"2020-07-21\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"4582\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434250\",\"date\":\"2020-07-21\",\"pos\":6,\"cat_id\":\"6\",\"shop_id\":\"4998\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434263\",\"date\":\"2020-07-22\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4546\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434258\",\"date\":\"2020-07-22\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4954\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434253\",\"date\":\"2020-07-22\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"5048\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434257\",\"date\":\"2020-07-22\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"5082\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434255\",\"date\":\"2020-07-22\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"11186\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434300\",\"date\":\"2020-07-23\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"3813\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434275\",\"date\":\"2020-07-23\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"3836\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434277\",\"date\":\"2020-07-23\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"3878\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434297\",\"date\":\"2020-07-23\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4945\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434273\",\"date\":\"2020-07-23\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"5084\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434302\",\"date\":\"2020-07-23\",\"pos\":6,\"cat_id\":\"6\",\"shop_id\":\"5042\",\"time\":\"\",\"comment\":\"\"}][{\"id\":\"434225\",\"date\":\"2020-07-20\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4548\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434228\",\"date\":\"2020-07-20\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4544\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434224\",\"date\":\"2020-07-20\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"4513\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434226\",\"date\":\"2020-07-20\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4587\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434232\",\"date\":\"2020-07-20\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"11766\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434239\",\"date\":\"2020-07-21\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4509\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434249\",\"date\":\"2020-07-21\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4497\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434236\",\"date\":\"2020-07-21\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"4052\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434247\",\"date\":\"2020-07-21\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4536\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434234\",\"date\":\"2020-07-21\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"4582\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434250\",\"date\":\"2020-07-21\",\"pos\":6,\"cat_id\":\"6\",\"shop_id\":\"4998\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434263\",\"date\":\"2020-07-22\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"4546\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434258\",\"date\":\"2020-07-22\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"4954\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434253\",\"date\":\"2020-07-22\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"5048\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434257\",\"date\":\"2020-07-22\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"5082\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434255\",\"date\":\"2020-07-22\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"11186\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434300\",\"date\":\"2020-07-23\",\"pos\":1,\"cat_id\":\"6\",\"shop_id\":\"3813\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434275\",\"date\":\"2020-07-23\",\"pos\":2,\"cat_id\":\"6\",\"shop_id\":\"3836\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434277\",\"date\":\"2020-07-23\",\"pos\":3,\"cat_id\":\"6\",\"shop_id\":\"3878\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434297\",\"date\":\"2020-07-23\",\"pos\":4,\"cat_id\":\"6\",\"shop_id\":\"4945\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434273\",\"date\":\"2020-07-23\",\"pos\":5,\"cat_id\":\"6\",\"shop_id\":\"5084\",\"time\":\"\",\"comment\":\"\"},{\"id\":\"434302\",\"date\":\"2020-07-23\",\"pos\":6,\"cat_id\":\"6\",\"shop_id\":\"5042\",\"time\":\"\",\"comment\":\"\"}]";
        return $object;
    }

    function __construct($date_start='', $date_end='')
    {


        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->dates = self::dates($date_start, $date_end);


        global $CFR_USER, $myPageBody;
        ini_set("memory_limit", "1024M");
        ini_set("max_execution_time", "1200");

/*
        $this -> shops[] = [ 'order' => '0', 'reminder' => '12:30','comment' => 'test','date' => '2020-05-04','shop_id' => '812', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Teutoburger Str. 98', 'city' => 'Bielefeld', 'cat' => 'SBW Hypermarket', 'color' => 'RED', 'offline' => 'false',  'group1'=>'Real', 'group2'=>'Bielefeld', 'group3'=>'Nordwest'];
        $this -> shops[] = ['order' => '0', 'reminder' => '18:30','comment' => 'Lorem Ipsum dolor sit amet, test test test','date' => '2020-05-05', 'shop_id' => '1715', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Limbecker Platz 1a', 'city' =>'Essen',  'cat' => 'Elektrofachm (groß)', 'color' => 'RED', 'offline' => 'false', 'group1'=>'Saturn', 'group2'=>'Essen', 'group3'=>'Rhein-Ruhr'];
        $this -> shops[] = ['order' => '0', 'date' => '2020-05-06','shop_id' => '1721', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Kabeler Str. 25', 'city' => 'Hagen', 'cat' => 'SBW Hypermarket', 'color' => 'RED', 'offline' => 'true', 'group1'=>'Real', 'group2'=>'Hagen', 'group3'=>'Nordwest'];
        $this -> shops[] = ['id'=>4, 'shop_id' => '0',  'name'=>'Call', 'date' => '2020-05-06','multiple' =>'true'];
        $this -> shops[] = ['id'=>5, 'shop_id' => '0', 'name'=>'Holiday','date' => '2020-05-07', 'multiple' =>'', 'icon'=>"http://brita.de.market-control.net/intern/data_site/PRV/12_20160706121710.png"];
        $this -> shops[] = ['order' => '0', 'date' => '2020-05-07', 'shop_id' => '1375', 'client' => 'Metro C+C', 'name' => 'METRO Deutschland GmbH', 'street' => 'Parkstr. 200', 'city' => 'Krefeld', 'cat' => 'C&C', 'color' => 'BLUE', 'offline' => 'true',  'group1'=>'Metro', 'group2'=>'Krefeld', 'group3'=>'Bergisches Land'];
        $this -> shops[] = ['order' => '2', 'date' => '2020-05-06','shop_id' => '18803', 'client' => 'REWE Center', 'name' => 'REWE Markt N. Heiderich oHG', 'street' => 'Glindfelder Weg 1', 'city' => 'Medebach', 'cat' => '', 'color' => 'GREEN', 'offline' => 'true',  'group1'=>'Rewe', 'group2'=>'Medebach', 'group3'=>'Nordwest'];
        $this -> shops[] = ['id'=>5, 'shop_id' => '0', 'name'=>'Holiday','date' => '2020-05-08', 'multiple' =>'', 'icon'=>"http://brita.de.market-control.net/intern/data_site/PRV/12_20160706121710.png"];
        $this -> shops[] = ['order' => '1', 'date' => '2020-05-08','shop_id' => '1714', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => '', 'city' =>'Hagen',  'cat' => 'Elektrofachm (groß)', 'color' => 'RED', 'offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Hagen', 'group3'=>'Nordwest'];
        $this -> shops[] = ['order' => '0', 'date' => '2020-05-08','shop_id' => '1553', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => '', 'city' =>'Gelsenkirchen',  'cat' => 'Elektrofachm (groß)', 'color' => 'ORANGE','offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Gelsenkirchen', 'group3'=>'Rhein-Ruhr'];
*/


        $shops[1] = ['shop_id' => '1714', 'sap_number' => '111', 'client' => 'Saturn', 'name' => 'Saturn && äöü<<>>!!---Electro-Handels GmbH', 'street' => 'Mittelstr. 20', 'city' =>'Hagen',  'cat' => 'Elektrofachm (groß)', 'color' => 'RED', 'offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Hagen', 'group3'=>'Nordwest' ];
        $shops[2] = ['shop_id' => '1715',  'sap_number' => '112', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Limbecker Platz 1a', 'city' =>'Essen',  'cat' => 'Elektrofachm (groß)', 'color' => 'RED', 'offline' => 'false', 'group1'=>'Saturn', 'group2'=>'Essen', 'group3'=>'Rhein-Ruhr'];
        $shops[3] = ['shop_id' => '1553', 'sap_number' => '113', 'client' => 'Saturn', 'name' => 'Saturn Electro-Handels GmbH', 'street' => 'Bahnhofstr. 48', 'city' =>'Gelsenkirchen',  'cat' => 'Elektrofachm (groß)', 'color' => 'ORANGE','offline' => 'true', 'group1'=>'Saturn', 'group2'=>'Gelsenkirchen', 'group3'=>'Rhein-Ruhr'];
        $shops[4] = ['shop_id' => '1721', 'sap_number' => '114', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Kabeler Str. 25', 'city' => 'Hagen', 'cat' => 'SBW Hypermarket', 'color' => 'RED', 'offline' => 'true', 'group1'=>'Real', 'group2'=>'Hagen', 'group3'=>'Nordwest'];
        $shops[5] = ['shop_id' => '811', 'sap_number' => '115', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Schweriner Str. 4', 'city' => 'Bielefeld', 'cat' => 'SBW Hypermarket', 'color' => 'RED', 'offline' => 'false', 'group1'=>'Real', 'group2'=>'Bielefeld', 'group3'=>'Nordwest'];
        $shops[6] = ['shop_id' => '812', 'sap_number' => '116', 'client' => 'Real', 'name' => 'real GmbH', 'street' => 'Teutoburger Str. 98', 'city' => 'Bielefeld', 'cat' => 'SBW Hypermarket', 'color' => 'RED', 'offline' => 'false',  'group1'=>'Real', 'group2'=>'Bielefeld', 'group3'=>'Nordwest'];
        $shops[7] = ['shop_id' => '18803', 'sap_number' => '117', 'client' => 'REWE Center', 'name' => 'REWE Markt N. Heiderich oHG', 'street' => 'Glindfelder Weg 1', 'city' => 'Medebach', 'cat' => '', 'color' => 'GREEN', 'offline' => 'true',  'group1'=>'null', 'group2'=>'Medebach', 'group3'=>'Nordwest'];
        $shops[8] = ['shop_id' => '1375', 'sap_number' => '118', 'client' => 'Metro C+C', 'name' => 'METRO Deutschland GmbH', 'street' => '', 'city' => 'Krefeld', 'cat' => 'C&C', 'color' => 'BLUE', 'offline' => 'true',  'group1'=>'Metro', 'group2'=>'Krefeld', 'group3'=>'Bergisches Land'];
        foreach ($shops as $row) {
            if ($row['client'] <> '') $group = $row['client'];
            $shop = [];
            $shop['shop_id'] = $row['shop_id'];
            $shop['sap_number'] = $row['sap_number'];
            $shop['offline'] = $row['offline'];
            $shop['name'] = $row['name'];
            $shop['city'] = $row['city'];
            $shop['street'] = $row['street'];
            $shop['cat'] = $row['cat'];
            $shop['color'] = $row['color'];
            $shop['client'] = $row['client'];
            $shop['group1'] = $row['group1'];
            $shop['group2'] = $row['group2'];
            $shop['group3'] = $row['group3'];
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
