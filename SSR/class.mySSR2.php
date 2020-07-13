<?php

require_once("class.ssr2.php");

include("../helpers.php");

class mySSR2 extends SSR2
{
    static function header()
    {
        echo parent::Header();
    }


    function __construct($dmid, $type = '', $report_id = 0)
    {
        global $CFR_USER, $myPageBody;
        self::Header();
        ini_set("memory_limit", "1024M");
        ini_set("max_execution_time", "1200");
        $this->dm = "Stores";
        if ($this->dm == '') $mypage->PageDenied();
        $this->dmid = $dmid;
        // CHECK TYPE & LANGUAGE
        $this->type = $type;
        if (!in_array($type, $this->types)) {
            throw new exception("[18153-1] Report Type not defined");
        }


        $this -> report[] = ['date_start' => '2020-01-22', 'date_end' => '2020-08-19', 'datefield' => '22.01.2020 - 19.08.2020', 'filter1' => ['Name', 'equal to', 'City']];




        // LOAD FIELDS
        $fields[] = ['id' => 0, 'description' => 'Store', 'name' => 'ID'];
        $fields[] = ['id' => 1, 'description' => '', 'name' => 'Name'];
        $fields[] = ['id' => 2, 'description' => '', 'name' => 'Street'];
        $fields[] = ['id' => 3, 'description' => '', 'name' => 'City'];
        $fields[] = ['id' => 4, 'description' => '', 'name' => 'Region'];
        $fields[] = ['id' => 5, 'description' => 'Store2', 'name' => 'ID'];
        $fields[] = ['id' => 6, 'description' => '', 'name' => 'Name2'];
        $fields[] = ['id' => 7, 'description' => '', 'name' => 'Street2'];
        $fields[] = ['id' => 8, 'description' => '', 'name' => 'City2'];
        $fields[] = ['id' => 9, 'description' => '', 'name' => 'Region2'];
        $fields[] = ['id' => 10, 'description' => 'Store3', 'name' => 'ID2'];
        $fields[] = ['id' => 11, 'description' => '', 'name' => 'Name'];
        $fields[] = ['id' => 12, 'description' => '', 'name' => 'Street'];
        $fields[] = ['id' => 13, 'description' => '', 'name' => 'City'];
        $fields[] = ['id' => 14, 'description' => '', 'name' => 'Region'];
        foreach ($fields as $row) {
            if ($row['description'] <> '') $group = $row['description'];
            $field = [];
            $field['id'] = $row['id'];
            $field['name'] = $row['name'];
            $field['label'] = $row['name'];
            $this->groups[$group][] = $field;
        }
    }

}

?>