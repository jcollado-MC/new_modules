<?php

require_once("class.visits.php");

include("../helpers.php");

class myVisits extends Visits
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



        $visits[1] = ['visit_id' => '1', 'date'=>'25.08.20', 'time_start' => '17:14', 'time_end' => '18:32', 'pos_id' => '2' , 'pos_name' => 'Saturn Electro-Handels GmbH', 'pos_street' => 'Mittelstr. 20', 'pos_city' =>'Hagen', 'type' => 'Standard Visit'];
        $visits[2] = ['visit_id' => '2', 'date'=>'25.08.20', 'time_start' => '18:44', 'time_end' => '19:32', 'pos_id' => '5' , 'pos_name' => 'real GmbH', 'pos_street' => 'Schweriner Str. 4', 'pos_city' =>'Hagen', 'type' => 'Standard Visit'];
        $visits[3] = ['visit_id' => '3', 'date'=>'25.08.20', 'time_start' => '19:44', 'time_end' => '20:32', 'pos_id' => '6' , 'pos_name' => 'METRO Deutschland GmbH', 'pos_street' => 'Parkstr. 200', 'pos_city' =>'Krefeld', 'type' => 'Standard Visit'];

        foreach ($visits as $row) {
            if ($row['date'] <> '') $group = $row['date'];
            $visit = [];
            $visit['visit_id'] = $row['visit_id'];
            $visit['date'] = $row['date'];
            $visit['time_start'] = $row['time_start'];
            $visit['time_end'] = $row['time_end'];
            $visit['pos_id'] = $row['pos_id'];
            $visit['pos_name'] = $row['pos_name'];
            $visit['pos_city'] = $row['pos_city'];
            $visit['pos_street'] = $row['pos_street'];
            $visit['type'] = $row['type'];

            $this->groups[$group][] = $visit;
        }

    }

}

?>