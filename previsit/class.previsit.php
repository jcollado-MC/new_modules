<?php

class Previsit
{

    function _construct()
    {
    }

    private static $header;

    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";
        $code .= "<script src='../Jquery/jquery-3.4.1.min.js'></script>";
        $code .= "<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.min.js' 
                integrity='sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU='
                crossorigin='anonymous'></script>";
        $code .= "<link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>";
        $code .= "<script>

        $(document).ready( function() {

        /* SEARCH SIDEBAR */
        
            $('#searchInput').on('keyup', function () {
                //get value of searchbar input
                var value = $(this).val().toLowerCase();
                
                if(value.length > 0){
                
                $('ul[class*=\'panel-\'').addClass('active-accordion');
                             
                
                //filter checkbox-labels for search value
                $('li').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
                $('.title-part').filter(function () {
                    
                    var id = $(this).attr('id');
                    
                    $(this).toggle( $(this).siblings('.' + id).text().toLowerCase().indexOf(value) > -1 );

                });
                } else {
                    $('ul[class*=\'panel-\'').removeClass('active-accordion');
                }
        
            });
            
            /* ACCORDION */

             $('.accordion').on('click', function(){
                 $(this).toggleClass('active-accordion');
                 var id = $(this).attr('id');
                $('.' + id).toggleClass('active-accordion');
            });
             
             
             
             $( function() {
                $( '[id *= \'sortable-\']' ).sortable({
                  connectWith: '.connectedSortable'
                }).disableSelection();
              } );
             
             
             });
             </script>";
        $code .= "<style>



            ul {
            list-style-type: none;
            padding: 0px;
            margin-top: 0;
            }
            
            
            ul li{
            list-style-type: none;
            display: block;
            }

            .pos p{
            margin: 0 0 5px 0;
            }
            
            .pos-number, .pos-address{
                font-size: 1rem;
                margin: 0 0 5px 0;
            }
            
            .pos-client, .pos-type{
                font-size: 0.7rem;
                display: inline;
                margin: 0 0 5px 0;
            }
            
            p.pos-name{
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 10px;
            }
            
            
            .pos-infos {
                border: none;
                background-color: #eeeeee;
                padding: 10px 15px;
                margin-bottom: 5px;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                cursor: pointer;
            }
            
            .pos-infos:hover{
                background-color: #ddd;
            }
            
            
            .timetable{
            height: 90vh;
            border: 1px solid #ddd;
            width: 100%;
            float: left;
            }
            
            .timetable-box{
            width: 20%;
            float: left;
            }
            
            .timetable-box p.list-header{
            padding: 0;
            display: block;
            margin: 10px 0;
            text-align: center;
            font-weight: bold;
            }
            
            </style>";


        return $code;
    }

    function show()
    {
        $code = "";
        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;
    }


    private function sidebar()
    {
        $cnt = 0;
        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Points of Sale</h2>";
        $code .= "<div class='search col-12'>
        <input class='col-11' type='text' id='searchInput' placeholder='Search'>
         <i class='fas fa-search search-icon col-1'></i>          
    </div>";
        foreach($this->groups as $name => $POS) {
            $code .= "<div class='title-part accordion' id='panel-".$cnt ." '>
                        <h5 class='col-12'>" . $name . "</h5>
                                <hr class='col-12'>
                            </div>";

            $code .= "<ul class='panel-".$cnt." pos connectedSortable' id='sortable-".$cnt."'>";
            foreach ($POS as $pos) {
                $code .= "<li class='pos-infos col-12'>
                    <p class='pos-number'>". $pos['number'] ."</p>
                    <p class='pos-name'>". $pos['name'] ."<a> <i class='fas fa-external-link-alt'> </i> </a> </p>
                    <p class='pos-address'>". $pos['address'] ."</p>
                    <p class='pos-client'>". $pos['client'] .", </p>
                    <p class='pos-type'>". $pos['typ'] ."</p>
                </li>";
            }
            $code .= "</ul>";

            $cnt++;
        }

        $code .= "</div>
        <div >
            <button class='update' type='submit' name='button18191' value=1>Save</button>
        </div>";
        $code .= "</div>";

        return $code;
    }

    private function content()
    {
        $code =  "";
        $code .= "<div class='col-9 content'>";
        $code .= "<div class='timetable-box'>
                    <p class='list-header'>Monday</p>
                    <ul class='timetable monday connectedSortable' id='sortable-monday'></ul>
                </div>";
        $code .= "<div  class='timetable-box'><p class='list-header'>Tuesday</p><ul class='timetable tuesday connectedSortable' id='sortable-tuesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Wednesday</p><ul class='timetable wednesday connectedSortable' id='sortable-wednesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Thursday</p><ul class='timetable thursday connectedSortable' id='sortable-thursday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Friday</p><ul class='timetable friday connectedSortable' id='sortable-friday'></ul></div>";
        $code .= "</div>";

        return $code;
    }

}


?>