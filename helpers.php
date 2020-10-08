<?php

function l($p1, $p2, $p3){
    return $p3;
}
function label($p1, $p2, $p3){
    return $p3;
}

abstract class _reports{
    function build(){
    }
}
class ListReport extends _reports{}
class MatrixReport extends _reports{}
class GalleryReport extends _reports{}

function db_connection(){
    if (!$link = mysql_connect('localhost', 'sem', 'sempass')) {
        echo 'Could not connect to mysql';
        exit;
    }

    if (!mysql_select_db('test_new_modules', $link)) {
        echo 'Could not select database';
        exit;
    }

    if(isset($link)){
        echo "success";
    }
    return $link;
}

//function db_query(){}
//function db_fetch_row(){}
//function db_direct(){}
//function db_value(){}

