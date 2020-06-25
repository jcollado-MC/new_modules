<?php
// Script created with CFB Framework Builder
// Client:  MARKET CONTROL
// Project: MASTER I
// Class Revision: 2
// Date of creation: 2020-06-25
// All Copyrights reserved
// This is a class file and can not be executed directly
// CLASS FILE
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
}
class PLANNER{
//[SUBTASKS]
//SUBTASK 18223: "STATIC: HEADER" --------------------------------------------
    private static $header;
    static function Header(){
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code  = "";
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
                $('.pos li').filter(function () {
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
                  connectWith: '.timetable',
                  revert: true,
                  update: function(event, ui) {
                      
                  var input = ui.item.parent().siblings(input);
                  var id = ui.item.parent().attr('id');
                  var text = ui.item.children('p').text();
                  var sender = ui.sender;
                  
                  if(sender != null){
                      var senderInput = ui.sender.siblings('input');
                      
                      $(senderInput).val(function() {
                        return $(this).val().replace(text, '')
                      });
                  }
                      
                    var elements = [];                    
                    var dayListElements = $('#' + id + ' li');      
                    
                    for(let element of dayListElements){
                        let text = $(element).find('p').text();                       
                        elements.push(text);
                    }
                    
                    $(input).val(elements);
                    
                    
                }
                }).disableSelection();
              } );
             
             $('i.delete').click( function(){
                 var liElementName = $(this).parent().attr('name');
                 var liElementId = $(this).parent().attr('id');                 
                 
                 $('#' + liElementId).appendTo('.' + liElementName);

             });
             
             
             /* MODALS */

            $('[class$=\"-modal\"]').hide();
        
        
            $('.modal-button').on('click', function(){
               var id = $(this).attr('id');
                $('.'+id).show();
            });
        
        
            $('.modal-content span.close').on('click', function() {
        
                $(this).parent().parent().hide();
        
            });
        
            $('.modal-content button.cancel').on('click', function() {
        
                $('[class$=\"-modal\"]').hide();
        
            });
            
            
            /*COMMENTS*/
            
            var comments = $('.comment p');            
            
            for (let comment of comments){
                
                console.log(comment);
                
                var text = $(comment).find('p').text();
                
                console.log('text: ' + text);
            
                if (text.length > 30){              
                    var text1 = text.slice(0, 30);
                    var text2 = text.slice(30, text.length);               
    
                    $(comment + ' p').text(text1);
                    $(comment + ' p').append('<span>' + text2 + '</span>')
                }
            }
            
//            if ($('.comment p').text().length > 30){
//                var text = $('.comment p').text();
//                                
//                var text1 = text.slice(0, 30);
//                var text2 = text.slice(30, text.length);               
//
//                $('.comment p').text(text1);
//                $('.comment p').append('<span>' + text2 + '</span>')
//            }

            $('.readMore').click(function() {
                var id = $(this).attr('id');                
                $('#' + id + ' span').toggle();
            });
        
             
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
            
            .pos i.delete, .pos i.comment, .pos i.existing-comment{
            display: none;
            }
            
            
            /* SUB-HEADER */
            
            .dateheader{
            background-color: #eee;
            padding: 5px 10px;
            margin-bottom: 15px;
            }
            
            h2.visit-date{
                text-align: center;
                margin: 0;
                padding: 2.5px 0;
            }
            
            i.previous-visit, i.next-visit{
                font-size: 1.8rem;
                cursor: pointer;
            }
            
            i.previous-visit:hover, i.next-visit:hover{
                color: #777777;
            }
            
            i.previous-visit{
                float: left;
            }
            
            i.next-visit, i.next-visit:before{
                float: right;
            }
            
            .dateheader i:hover{
                cursor: pointer;
            }
            
            /*COMMENTS*/
            
            .comment{
                border: 1px solid #ddd;
                padding: 5px;
            }

            


            </style>";


        return $code;
    }


    //SUBTASK 18224: "STUFF" --------------------------------------------
    function editModal(){
        $code = "";
        $code .= "<div class='pos-modal'>
                      <div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Additional Infos:</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<label>Time:</label>";
        $code .= "<input type='time' min='06:00' max='24:00'>";
        $code .= "<label>Comment:</label>";
        $code .= "<textarea class='col-12' rows='5'></textarea>";
        $code .= "</div>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save'>Save</button>";
        $code .= "<button id='delete' class='cancel' type='button'>Cancel</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }

    function dateHeader(){
        $code = "";
        $code .= "<div class='col-9 content'>";
        $code .= "<div class='col-12 row dateheader'>
                <i class='fas fa-angle-left previous-visit col-1'></i>
                <h2 class='visit-date col-10'>Max Mustermann, KW 19</h2>
                <i class='fas fa-angle-right next-visit col-1'></i>
            </div>";
        return $code;
    }

    private function content(){
        $code =  "";
        $code .= "<div class='timetable-box'><p class='list-header'>Monday, 4.5.</p><input type='hidden' name='monday' value=''><ul class='timetable monday connectedSortable' id='sortable-monday'></ul></div>";
        $code .= "<div  class='timetable-box'><p class='list-header'>Tuesday, 5.5.</p><input type='hidden' name='tuesday' value=''><ul class='timetable tuesday connectedSortable' id='sortable-tuesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Wednesday, 6.5.</p><input type='hidden' name='wednesday' value=''><ul class='timetable wednesday connectedSortable' id='sortable-wednesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Thursday, 7.5.</p><input type='hidden' name='thursday' value=''><ul class='timetable thursday connectedSortable' id='sortable-thursday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>Friday, 8.5.</p><input type='hidden' name='friday' value=''><ul class='timetable friday connectedSortable' id='sortable-friday'></ul></div>";
        $code .= "</div>";

        return $code;
    }

//    //SUBTASK 18220: "_CONSTRUCT" --------------------------------------------
//    var $user = '';
//    var $date_start = '';
//    var $date_end = '';
//    var $shops = [];
//    function __construct($user, $date_start='', $date_end=''){
//        global $myPageBody;
//        if(!is_numeric($user)){
//            $user = db_value("SELECT id FROM authuser WHERE uname='$user'");
//        }
//        // CHECK USER
//        $user = db_direct("SELECT id FROM authuser WHERE id=$user");
//        if($user['id']==''){
//            throw new Exception(
//                label('EXCEPTION', 'USER_NOT_FOUND', 'No se ha encontrado el usuario')
//            );
//        }
//        $this->user = $user;
//        $this->date_start = $date_start;
//        $this->date_end = $date_end;
//        // LOAD SHOPS
//        $myShops = \rtm::shops($user['id']);
//        if(count($myShops)==0){
//            throw new Exception(
//                label('EXCEPTION', 'NO_SHOPS', 'No existen puntos de venta')
//            );
//        }
//        $sql= "SELECT crm_shops_bs.id,
//                              crm_shops_bs.name,
//                crm_shops_bs.shop_street AS street,
//                crm_shops_bs.shop_city AS city,
//                crm_shops_lk.name AS cat,
//                crm_clients_bs.name AS client
//           FROM crm_shops_bs
//      LEFT JOIN crm_shops_lk ON crm_shops_bs.cat_id = crm_shops_lk.id
//      LEFT JOIN crm_clients_bs ON crm_shops_bs.client_id=crm_clients_bs.id
//              WHERE crm_shops_bs.id IN (".implode(',', $myShops).")";
//        // $myPageBody .= "$sql<br>";
//        $result = db_query($sql);
//        while($row = db_fetch_row($result)){
//            $this->groups[$row['client']][] = $row;
//        }
//    }

    //SUBTASK 18221: "SIDEBOARD" --------------------------------------------
    private function sidebar(){
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
                $code .= "<li class='pos-infos col-12'  name='panel-".$cnt ."' id='". $pos['number'] ."'>";
                $code .= "<i class='fas fa-times delete'></i>";
                $code .= "<i class='fas fa-comment comment modal-button' id='pos-modal'></i>";
                //                $code .= "<i class='fas fa-comment-exclamation exsisting-comment modal-button' id='pos-modal'></i>";
                $code .= "<p class='pos-number'>". $pos['number'] ."</p>";
                $code .= "<p class='pos-name'>". $pos['name'] ."<a> <i class='fas fa-external-link-alt'> </i> </a> </p>";
                $code .= "<p class='pos-address'>". $pos['address'] ."</p>";
                $code .= "<p class='pos-client'>". $pos['client'] .", </p>";
                $code .= "<p class='pos-type'>". $pos['typ'] ."</p>";

                $code .= "<div class='comment col-12'>";
                $code .= "<i class='fas fa-info col-2'></i>";
                $code .= "<p class='col-10 comment-".$cnt."''>";
                $code .= "Kinder delice en este centro se vende muy bien. Falta stock de cards. Bombones y nutella sin stock practicamente.";
                $code .= "</p>";
                $code .= "<a class='readMore' id='comment-".$cnt."'>Read More</a>";
                $code .= "</div>";

                $code .= "</li>";
            }
            $code .= "</ul>";
            $cnt++;
        }

        $code .= "</div>";
        $code .= "<div ><button class='update' type='submit' name='button18191' value=1>Save</button></div>";
        $code .= "</div>";

        return $code;
    }


    //SUBTASK 18222: "SHOW" --------------------------------------------
    function show(){
        $code = "";
        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->sidebar();
        $code .= $this->editModal();
        $code .= $this->dateHeader();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;
    }
}

?>