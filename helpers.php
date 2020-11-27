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

global $link;
function db_connection(){
    if (!$link = mysql_connect('localhost', 'sem', 'sifre')) {
        echo 'Could not connect to mysql';
        exit;
    }

    if (!mysql_select_db('test_new_modules', $link)) {
        echo 'Could not select database';
        exit;
    }

    if(isset($link)){
        //echo "success";
    }
    return $link;
}

function db_query($query , $link) {
    $result = mysql_query($query , $link);
    return $result;
}

// FETCH ROW STATEMENT
function db_fetch_row($result) {
    return mysql_fetch_array($result);
}
//function db_direct(){}
//function db_value(){}

