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
        $code .= "<script>

        $(document).ready( function() {
            
            $('form').children().css({userSelect: 'none'});
            

        /* SEARCH SIDEBAR */
        
            $('#searchInput').on('keyup', function () {
                //get value of searchbar input
                var value = $(this).val().toLowerCase();
                
                    //filter checkbox-labels for search value
                    $('.pos li').filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                    // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
                    $('.title-part').filter(function () {                    
                        var id = $(this).attr('id');                    
                        $(this).toggle( $(this).siblings('.' + id).text().toLowerCase().indexOf(value) > -1 );
                    });
                    
                     $('ul.pos').filter(function () {
                        var children = $(this).children('li').text();
                        $(this).toggle(children.toLowerCase().indexOf(value) > -1);
                    });
                   
                 if (value.length > 0){                                       
                     $('ul.pos[class*=\'panel-\'').addClass('active-accordion');
                     $('.accordion').addClass('active-accordion');
                } else {
                    $('ul.pos').css('display', '');
                    $('.active-accordion').removeClass('active-accordion');                    
                }
                
        
            });
            
            /* ACCORDION */

             $('.accordion').on('click', function(){
                 $(this).toggleClass('active-accordion');
                 var id = $(this).attr('id');
                $('.' + id).toggleClass('active-accordion');
            });
             
             
             
             $( function() {
                 
                 var recieverId;
                 
                $( '[id *= \'sortable-\']' ).sortable({                
                  connectWith: '.timetable',
                  revert: true,
                  receive: function(event, ui) {                        
                        recieverId = $(this).attr('id');  
                        console.log(recieverId);
                    },                  
                  update: function(event, ui) {                      
                  var input = ui.item.parent().siblings(input);
                  var id = ui.item.parent().attr('id');
                  var text = ui.item.text();
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
                  },
                  
                }).disableSelection();
                
                
                $( '#sortable-multiple-events' ).sortable({
                
                  connectWith: '.timetable',
                  revert: true,
                  
                  stop: function (event, ui) {
                    ui.item.clone().appendTo('#' + recieverId);
                    $('.' + ui.item.attr('name')).sortable('cancel');
                  },
                  update: function(event, ui) {                      
                  var input = ui.item.parent().siblings(input);
                  var id = ui.item.parent().attr('id');
                  var text = ui.item.text();
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
                  },
                  
                }).disableSelection();
                
                
             });
             
              $('.timetable').on( 'click' , '.multiple-event-infos i.delete' , function(){                 
                 var text = $(this).parent().text();
                 var input =  $(this).parent().parent().siblings('input');
                 
                 $(input).val(function() {
                        return $(this).val().replace(text, '')
                      });
                  
                  $(this).parent().remove();
             });
             
             $('.pos-infos i.delete, .event-infos i.delete').click( function(){
                 
                 var text = $(this).parent().text();
                 var input =  $(this).parent().parent().siblings('input');
                 
                 $(input).val(function() {
                        return $(this).val().replace(text, '')
                      });
                 
                 var liElementName = $(this).parent().attr('name');
                 var liElementId = $(this).parent().attr('id');
                 $('#' + liElementId).appendTo('.' + liElementName);
                 
                 
             });
             

             
             
             /* MODALS */

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
                var text = $(comment).text();            
                var commentLength = 30;                
                if (text.length > commentLength){              
                    var text1 = text.slice(0, commentLength);
                    var text2 = text.slice(commentLength, text.length);               
    
                    $(comment).text(text1);
                    $(comment).append(' ... <span>' + text2 + '</span>')
                }
            }
            
            

            $('a.readMore').click(function() {
                var id = $(this).attr('id');
                $('.comment p.' + id + ' span').toggle();
                
            });
            
            
            /* COLOR FILTERS*/
            
            $('#color-filter button').click(function() {        
                $(this).toggleClass('active');
                
                var isActive = $(this).hasClass('active');
                var id = $(this).attr('id');  
              
                
                if(isActive){
                    $('ul.pos li.' + id).show();
                } else {
                    $('ul.pos li.' + id).hide();
                }
            });
            
            
            /* DROPDOWN */
            $(document).on(\"click\", 'button.dropbtn', function () {
                // get button id
                var id = $(this).attr('id');
                // show dropdown-content when it's class is button id
                $(\".dropdown-content.\" + id).toggle();
                // hide all other dropdowns then
                $(\".dropdown-content\").not(\".\" + id).hide();
            });
        
            $(document).mouseup(function (e) {
                // set container value
                var container = $(\".dropdown-content\");
        
                // If the target of the click isn't the container, hide it
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });

            
            
            /* GROUPING */
            
            $('.grouping button').click( function() {
                  $('.grouping .active').removeClass('active');
                  
                  $(this).addClass('active');
            });
            
            
            /* AUTOPLAN */
            
            var val = $('.autoload select').val();
            $('.' + val).show()
            
            $('.autoload select').change(function() {
              $('.planning-content').hide();
              var val = $(this).val();
              $('.' + val).show()
            });
            
        
             
             });
             </script>";
        $code .= "<style>


            .content{
            min-height: 10px;;
            }
            
            h4{
                margin: 20px 0 0 0;
            }

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
                font-size: 0.8rem;
                margin: 0 0 5px 0;
            }
            
            .pos-client, .pos-type{
                font-size: 0.7rem;
                display: inline;
                margin: 0 0 5px 0;
            }
            
            p.pos-name, p.event-name{
            font-size: 0.9rem;
            font-weight: bold;
            margin: 0 0 10px 0;
            }
            
            
            .pos-infos, .event-infos, .multiple-event-infos {
                border: none;
                background-color: #eeeeee;
                padding: 10px 15px;
                margin-bottom: 5px;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                cursor: pointer;
            }
            
            .pos-infos:hover,.event-infos:hover,  .multiple-event-infos:hover{
                background-color: #ddd;
            }
            
            
            .event-infos,  .multiple-event-infos{
                background-color: #fff;
            }
            
            
            .event-infos img,  .multiple-event-infos img{
                height: auto;              
            }
            
            
            .timetable{
            min-height: 100vh;
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
            margin: 0 0 10px 0;
            text-align: center;
            font-weight: bold;
            }
            
            .pos i.delete, .pos i.add-comment {
            display: none;
            }
            
            i.offline{
            float: right;
            font-size: 0.8rem;
            padding: 2px;
            color: #bbb;
            }
            
            /*COMMENTS*/
            
            .pos .comment{
            display: none;
            }
            
            
            .comment{
                margin: 5px 0;
                border: 1px solid #d9d9d9;
                padding: 5px;
                font-size: 0.8rem;
            }
            
            .comment i{
            color: #3f48cc;
            }
            
            .comment p{
            margin: 0px;
            }
            
            .comment p span{
            display: none;
            }

            /* COLOR FILTERS */

            #color-filter{
                margin: 20px 0 0 0;
                
            }
            
            #color-filter button{
            margin-right: 5px;
            margin-bottom: 5px;
            height: 20px;
            width: 20px;
            border: 2px solid;
            border-radius: 15px;
            float: right;
            }
            
           
            #color-filter button#freq-1, #color-filter button#freq-1:hover{
                border-color: darkred;
                background: none;
                box-shadow: none;
            }
            
            #color-filter button#freq-1.active{
                background-color: darkred;
                box-shadow: inset 0 0 5px #fff;
            }
            
            #color-filter button#freq-2, #color-filter button#freq-2:hover{
                border-color: orange;  
                background: none;             
            }
            
            #color-filter button#freq-2.active{
                background-color: orange;   
                box-shadow: inset 0 0 5px #fff;            
            }
            
            #color-filter button#freq-3, #color-filter button#freq-3:hover{
                border-color: limegreen;  
                background: none;              
            }
            
            #color-filter button#freq-3.active{
                background-color: limegreen;   
                box-shadow: inset 0 0 5px #fff;             
            }
            
            #color-filter button#freq-4, #color-filter button#freq-4:hover{
                border-color: dodgerblue;
                background: none;
            } 
            
            #color-filter button#freq-4.active{
                background-color: dodgerblue;
                box-shadow: inset 0 0 5px #fff;
            }
            
            
            li.freq-1 p.pos-name{
                color: darkred;
            }
            
            li.freq-2 p.pos-name{
                color: orange;
            }
            
            li.freq-3 p.pos-name{
                color: limegreen;
            }
            
            li.freq-4 p.pos-name{
                color: dodgerblue;
            }
            
            /* GROUPS */
            
            .grouping{
                margin: 15px 0;
            }
            
            .grouping button{
                padding: 5px 10px;
                margin: 0 5px 0 0;
                border: none;
            }
            
            .grouping button.active, .grouping button:hover{
                background-color: #bbb;
                color: white;                
            }


            /*AUTOPLAN*/
            
            .planning-content{
            display: none;
            }
            
            
            </style>";


        return $code;
    }


    //SUBTASK 18224: "STUFF" --------------------------------------------




    private function editModal(){
        $code = "";
        $code .= "<div class='pos-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Additional Infos:</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<label>".l(18224,1,"Time")."</label>";
        $code .= "<input type='time' min='06:00' max='24:00'>";
        $code .= "<label>".l(18224,2,"Comment")."</label>";
        $code .= "<textarea class='col-12' rows='5'></textarea>";
        $code .= "</div>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save' type='button'>".l(18224,3,"Save Comment")."</button>";
        $code .= "<button id='delete' class='cancel' type='button'>".l(18224,4,"Cancel")."</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }


    private function filter(){

        $code  = "<div class='content row col-9'>";
        $code  .= "<div class='col-9 autoplans'>";
        $code  .= "<button class='dropbtn modal-button' id='autoplan-modal' type='button'>";
        $code  .= "<h5>".l(18224,5,"Autoplan week")."</h5>";
        $code  .= "</button>";

        $code .= "<div class='autoplan-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code  .= "<div class='col-12'>";
        $code  .= "Autoplan coming soon!";
        $code  .= "</div>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save' type='button'>".l(18224,6,"Load")."</button>";
        $code .= "<button id='delete' class='cancel' type='button'>".l(18224,4,"Cancel")."</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";

        $code  .= "<button class='dropbtn modal-button' id='import-modal' type='button'>";
        $code  .= "<h5>".l(18224,7,"Import canvas")."</h5>";
        $code  .= "</button>";

        $code .= "<div class='import-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code  .= "<div class='col-12'>";
        $code  .= "Import coming soon!";
        $code  .= "</div>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save' type='button'>".l(18224,6,"Load")."</button>";
        $code .= "<button id='delete' class='cancel' type='button'>".l(18224,4,"Cancel")."</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";

        $code  .= "<button class='dropbtn modal-button' id='copy-modal' type='button'>";
        $code  .= "<h5>".l(18224,8,"Copy other week")."</h5>";
        $code  .= "</button>";

        $code .= "<div class='copy-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code  .= "<div class='col-12'>";
        $code  .= "Copy Week coming soon!";
        $code  .= "</div>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save' type='button'>".l(18224,6,"Load")."</button>";
        $code .= "<button id='delete' class='cancel' type='button'>".l(18224,4,"Cancel")."</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";


        $code .= "</div>";
        return $code;
    }


//    private function filter2(){
//
//        $code  = "<div class='content row col-9'>";
//        $code  .= "<div class='col-9 autoplans'>";
//        $code  .= "<div class='dropdown'>";
//        $code  .= "<button id='autoload' class='dropbtn' type='button'>";
//        $code  .= "<h5>".l(18224,5,"Autoload")." <i class='fas fa-caret-down'></i></h5>";
//        $code  .= "</button>";
//        $code  .= "<div class='dropdown-content autoload'>";
//        $code  .= "<div class='col-12 row'>";
//        $code  .= "<label>".l(18224,6,"Autoloading Type")."</label>";
//        $code  .= "<select class='col-12'>";
//        $code  .= "<option value='autoplan'>".l(18224,7,"Autoplan week")."</option>";
//        $code  .= "<option value='import'>".l(18224,8,"Import canvas")."</option>";
//        $code  .= "<option value='copy'>".l(18224,9,"Copy other week")."</option>";
//        $code  .= "</select>";
//        $code  .= "<div class='planning-content col-12 autoplan'>";
//        $code  .= "Autoplan coming soon!";
//        $code  .= "</div>";
//        $code  .= "<div class='planning-content col-12 import'>";
//        $code  .= "Import coming soon!";
//        $code  .= "</div>";
//        $code  .= "<div class='planning-content col-12 copy'>";
//        $code  .= "Copy coming soon!";
//        $code  .= "</div>";
//        $code  .= "<button class='update col-12'> <i class='fas fa-sync-alt'> </i>".l(18224,10,"Load")."</button>";
//        $code  .= "</div>";
//        $code  .= "</div>";
//        $code  .= "</div>";
//        $code .= "</div>";
//        return $code;
//    }


    private function actions(){
        $code = "";
        $code .= "<div class='col-3 actions'>";
        $code .= "<button class='download' type='button'>";
        $code .= "<i class='fas fa-file-download'></i>";
        $code .= "</button>";
        $code .= "<button class='copy' type='button'>";
        $code .= "<i class='fas fa-copy'></i>";
        $code .= "</button>";
        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }




    private function content(){
        $code =  "";
        $code .= "<div class='col-9 content'>";
        $code .= "<div class='timetable-box'><p class='list-header'>".l(18224,11,"Monday").", 4.5.</p><input type='hidden' name='monday' value=''><ul class='timetable monday connectedSortable' id='sortable-monday'></ul></div>";
        $code .= "<div  class='timetable-box'><p class='list-header'>".l(18224,12,"Tuesday").", 5.5.</p><input type='hidden' name='tuesday' value=''><ul class='timetable tuesday connectedSortable' id='sortable-tuesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>".l(18224,13,"Wednesday").", 6.5.</p><input type='hidden' name='wednesday' value=''><ul class='timetable wednesday connectedSortable' id='sortable-wednesday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>".l(18224,14,"Thursday").", 7.5.</p><input type='hidden' name='thursday' value=''><ul class='timetable thursday connectedSortable' id='sortable-thursday'></ul></div>";
        $code .= "<div class='timetable-box'><p class='list-header'>".l(18224,15,"Friday").", 8.5.</p><input type='hidden' name='friday' value=''><ul class='timetable friday connectedSortable' id='sortable-friday'></ul></div>";
        $code .= "</div>";

        return $code;
    }






    //SUBTASK 18220: "_CONSTRUCT" --------------------------------------------
    var $user = '';
    var $date_start = '';
    var $date_end = '';
    var $shops = [];
    function __construct($user, $date_start='', $date_end=''){
        global $myPageBody;
        if(!is_numeric($user)){
            $user = db_value("SELECT id FROM authuser WHERE uname='$user'");
        }
        // CHECK USER
        $user = db_direct("SELECT id FROM authuser WHERE id=$user");
        if($user['id']==''){
            throw new Exception(
                label('EXCEPTION', 'USER_NOT_FOUND', 'No se ha encontrado el usuario')
            );
        }
        $this->user = $user;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        // LOAD SHOPS
        $myShops = \rtm::shops($user['id']);
        if(count($myShops)==0){
            throw new Exception(
                label('EXCEPTION', 'NO_SHOPS', 'No existen puntos de venta')
            );
        }
        $sql= "SELECT crm_shops_bs.id,
                              crm_shops_bs.name,
                crm_shops_bs.shop_street AS street,
                crm_shops_bs.shop_city AS city,
                crm_shops_lk.name AS cat,
                crm_clients_bs.name AS client
           FROM crm_shops_bs
      LEFT JOIN crm_shops_lk ON crm_shops_bs.cat_id = crm_shops_lk.id
      LEFT JOIN crm_clients_bs ON crm_shops_bs.client_id=crm_clients_bs.id
              WHERE crm_shops_bs.id IN (".implode(',', $myShops).")";
        // $myPageBody .= "$sql<br>";
        $result = db_query($sql);
        while($row = db_fetch_row($result)){
            $this->groups[$row['client']][] = $row;
        }
    }

    //SUBTASK 18221: "SIDEBOARD" --------------------------------------------
    private function sidebar(){
        $cnt = 0;
        $commentCnt = 0;
        $eventCnt = 0;
        
        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2  class='col-12'>Planning Settings</h2>";

        $code .= "<div class='search col-12'>";
        $code .= "<input class='col-11' type='text' id='searchInput' placeholder='Search'>";
        $code .= "<i class='fas fa-search search-icon col-1'></i>";
        $code .= "</div>";

        $code .= "<h4  class='col-7'>Points of Sales</h4>";
        $code .= "<div class='col-5' id='color-filter'>";
        $code .= "<button class='active' id='freq-4' type='button'></button>";
        $code .= "<button class='active' id='freq-3' type='button'></button>";
        $code .= "<button class='active' id='freq-2' type='button'></button>";
        $code .= "<button class='active' id='freq-1' type='button'></button>";
        $code .= "</div>";
        $code .= "<div class='grouping col-12'>";
        $code .= "<button class='active' type='button' id='group1'>Chain</button>";
        $code .= "<button type='button' id='group2'>City</button>";
        $code .= "<button type='button' id='group3'>Group</button>";
        $code .= "</div>";




        foreach($this->groups as $name => $shops) {
            $code .= "<div class='title-part accordion' id='panel-".$cnt ." '>";
            $code .= "<h5 class='col-12'>" . $name . "</h5>";
            $code .= "<hr class='col-12'>";
            $code .= "</div>";

            $code .= "<ul class='panel-".$cnt." pos connectedSortable' id='sortable-".$cnt."'>";
            foreach ($shops as $shop) {
                $code .= "<li class='pos-infos col-12 freq-". $shop['freq'] ."'  name='panel-".$cnt ."' id='". $shop['shop_id'] ."'>";
                $code .= "<i class='fas fa-times delete'></i>";
                $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
                if( $shop['offline'] == 'true' ) {
                    $code .= "<i class='fas fa-wifi-slash offline'></i>";
                }
                $code .= "<p class='pos-number'>". $shop['number'] ."</p>";
                $code .= "<p class='pos-name'>". $shop['name'] . " <a target='_blank' href='/intern/modules/AGI/PV/shops_show.php?id=". $shop['shop_id'] ."'><i class='fas fa-external-link-alt'> </i> </a> </p>";
                $code .= "<p class='pos-address'>". $shop['street'] . ", " . $shop['city'] ."</p>";
                $code .= "<p class='pos-client'>". $shop['client'] ." </p>";
                $code .= "<p class='pos-type'>". $shop['typ'] ."</p>";
//                $code .= "<div class='comment col-12'>";
//                $code .= "<i class='fas fa-info col-2'></i>";
//                $code .= "<div class='col-10'>";
//                $code .= "<p>15:30</p>";
//                $code .= "<p class='comment-".$commentCnt."''>";
//                $code .= "Kinder delice en este centro se vende muy bien. Falta stock de cards. Bombones y nutella sin stock practicamente.";
//                $code .= "</p>";
//                $code .= "<a class='readMore' id='comment-".$commentCnt."'>".l(18221,1,"read more")."</a>";
//                $code .= "</div>";
//                $code .= "</div>";

                $code .= "</li>";
                $commentCnt++;
            }
            $code .= "</ul>";
            $cnt++;
        }

        $code .= "<h4  class='col-12'>Events</h4>";

            $code .= "<div class='title-part accordion' id='panel-event'>";
            $code .= "<h5 class='col-12'>Events</h5>";
            $code .= "<hr class='col-12'>";
            $code .= "</div>";




            $code .= "<ul class='panel-event pos connectedSortable' id='sortable-event'>";

            foreach ($this->events as $event) {
                if ($event['multiple'] != 'true') {
                    $code .= "<li class='event-infos col-12'  name='panel-event' id='event-" . $event['id'] . "'>";
                    $code .= "<i class='fas fa-times delete'></i>";
                    $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
                    $code .= "<div class='col-12'>";
                    $code .= "<p class='event-name col-10'>" . $event['name'] . "</p>";
                    if (isset($event['icon'])) {
                        $code .= "<img class='col-2' src='" . $event['icon'] . "'>";
                    }
                    $code .= "</div>";
//                    $code .= "<div class='comment col-12'>";
//                    $code .= "<i class='fas fa-info col-2'></i>";
//                    $code .= "<div class='col-10'>";
//                    $code .= "<p>15:30</p>";
//                    $code .= "<p class='comment-event-".$eventCnt."''>";
//                    $code .= "Kinder delice en este centro se vende muy bien. Falta stock de cards. Bombones y nutella sin stock practicamente.";
//                    $code .= "</p>";
//                    $code .= "<a class='readMore' id='comment-event-".$eventCnt."'>".l(18221,1,"read more")."</a>";
//                    $code .= "</div>";
//                    $code .= "</div>";

                    $code .= "</li>";
                }
                $eventCnt++;
            }
            $code .= "</ul>";

            $code .= "<div class='title-part accordion' id='panel-multiple-event'>";
            $code .= "<h5 class='col-12'>Multiple Events</h5>";
            $code .= "<hr class='col-12'>";
            $code .= "</div>";
            $code .= "<ul class='panel-multiple-event pos' id='sortable-multiple-events'>";

            foreach ($this->events as $event) {
                if ($event['multiple'] == 'true') {
                    $code .= "<li class='multiple-event-infos col-12' id='event-" . $event['id'] ."' name='panel-multiple-event'>";
                    $code .= "<i class='fas fa-times delete'></i>";
                    $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
                    $code .= "<div class='col-12'>";
                    $code .= "<p class='event-name col-10'>" . $event['name'] . "</p>";
                    if (isset($event['icon'])) {
                        $code .= "<img class='col-2' src='" . $event['icon'] . "'>";
                    }
                    $code .= "</div>";
                    $code .= "</li>";
                }
                $eventCnt++;
            }
            $code .= "</ul>";



        $code .= "</div>";
        $code .= "<div ><button class='update' type='submit' name='button18191' value=1>".l(18221,2,"Save")."</button></div>";
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
        $code .= $this->filter();
        $code .= $this->actions();
        $code .= $this->editModal();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;
    }
}

?>