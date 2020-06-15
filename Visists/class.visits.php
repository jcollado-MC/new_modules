<?php

class visits{

    function _construct() {}

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script></script>";
        $code .= "<style></style>";

        return code;
    }


    function show() {

        $code = "";
        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->subheader();
        $code .= $this->sidebar();
        $code .= $this->map();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;

    }


    private function subheader(){
        
        $code = "";

        $code = "<div class='col-12 row'>
                <i class='fas fa-angle-left previous-visit col-1'></i>
                <h2 class='visit-date col-10'>Tuesday, 05.05.2020 <a><i class='fas fa-calendar-alt'></i> </a></h2>
                <i class='fas fa-angle-right next-visit col-1'></i>
            </div>";

        return $code;
    }

    private function sidebar(){

    }

    private function map(){

    }

    private function content(){

    }




}


?>