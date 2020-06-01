<?php

require_once("class.ssr2.php");
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
        $l = trim($CFR_USER['lang']);
        switch ($l) {
            case 'lang_es':
                $l = 'es_ES';
                break;
            case 'lang_de':
                $l = 'de_DE';
                break;
            default:
                $l = 'en_EN';
        }
        // LOAD FIELDS
        $fields[] = ['id' => 0, 'description' => 'Store', 'name' => 'ID'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Name'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Street'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'City'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Region'];
        $fields[] = ['id' => 0, 'description' => 'Store2', 'name' => 'ID'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Name2'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Street2'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'City2'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Region2'];
        $fields[] = ['id' => 0, 'description' => 'Store3', 'name' => 'ID2'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Name'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Street'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'City'];
        $fields[] = ['id' => 0, 'description' => '', 'name' => 'Region'];
        foreach ($fields as $row) {
            if ($row['description'] <> '') $group = $row['description'];
            $field = [];
            $field['id'] = $row['id'];
            $field['name'] = $row['name'];
            $field['label'] = $row['name'];
            $field['type'] = $row[''];
            $field['group'] = $row[''];
            $this->groups[$group][] = $field;
        }
    }

}

?>