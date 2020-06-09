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

function db_query(){}
function db_fetch_row(){}
function db_direct(){}
function db_value(){}

