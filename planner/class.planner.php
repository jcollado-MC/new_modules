<?php
  // Script created with CFB Framework Builder 
  // Client:  MARKET CONTROL
  // Project: MASTER I
  // Class Revision: 2
  // Date of creation: 2020-07-29
  // All Copyrights reserved 
  // This is a class file and can not be executed directly 
  // CLASS FILE
    if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){ 
      header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
      exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
    }
    class PLANNER{
//[SUBTASKS]
//SUBTASK 18259: "DATES" --------------------------------------------
static function dates($date_start, $date_end, $weekends= FALSE){
    global $myPageBody;
  $dates = array();
    $duration = (strtotime($date_end)-strtotime($date_start));
  $days = floor(($duration / 24 / 60 / 60));
  // $myPageBody .= "$days =    $duration = ($date_end-$date_start);<hr>";
    for($n=0;$n<$days;$n++){
    $date = date("Y-m-d", strtotime($date_start." +".$n."DAYS"));
    $weekday = date("l", strtotime($date_start." +".$n."DAYS"));
    $dates[$date] = $weekday;
  }
  return $dates;
}

//SUBTASK 18223: "STATIC: HEADER" --------------------------------------------
    private static $header;
    static function Header(){
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code  = "";

        $code .= "
        
        <script>
        
        
        /* UNDEFINED LABEL FOR GROUPING */
        var undefined_label = '". l(18221, 101, 'no category') ."';

        $(document).ready( function() {
            
            $('form').children().css({userSelect: 'none'});
            
            /* SIDEBAR SEARCH */
            
            function search(value){   
            
                //filter checkbox-labels for search value            
                $( '.pos li' ).each(function(  ) {
                    if($(this).text().toLowerCase().indexOf(value) < 0){               
                       
                        $(this).hide();
                    }
                });
                  
                
                $('.title-part').each( function() {
                    var id = $(this).attr('id');                     
                    if ($(this).siblings('.' + id).text().toLowerCase().indexOf(value) < 0) {
                        $(this).hide();
                    }                
                });
                
                $('ul.pos').each( function() {                 
                    if ($(this).children('li').text().toLowerCase().indexOf(value) < 0) {
                        $(this).hide();
                    }                
                });
            }
    
            
            $('#searchInput').on('keyup', function () {
                //get value of searchbar input
                var value = $(this).val().toLowerCase();     
                
                $( '.pos li, ul.pos, .title-part' ).show();       
                var valueArray = value.split(' ');                                    
                valueArray.forEach(search);
                
                if (value.length > 0){                                       
                     $('ul.pos[class*=\'panel-\'').addClass('active-accordion');
                     $('.accordion').addClass('active-accordion');
                } else {
                    $('ul.pos').css('display', '');
                    $('.active-accordion').removeClass('active-accordion');                    
                }
        
            });
            
            
            /* ACCORDION */
             $('.tabs').on('click', '.accordion', function(){
                 $(this).toggleClass('active-accordion');
                 var id = $(this).attr('id');
                $('.' + id).toggleClass('active-accordion');
                
                $('.' + id).css('display', '');
            });
             
             
             
             /* SORTABLES */
             $( function() {
                 
                 var recieverId;
                 
                $( '[id *= \'sortable-\']' ).sortable({                
                  connectWith: '.timetable',
                  revert: true,
                  receive: function(event, ui) {                        
                        recieverId = $(this).attr('id');
                    },                  
                  update: function(event, ui) {                      
                  var input = ui.item.parent().siblings(input);
                  var id = ui.item.parent().attr('id');
                  var text = ui.item.text();
                  var sender = ui.sender;
                  
                  
                  
                  if(sender != null){
                      var senderInput = ui.sender.siblings('input');
                      
                      $(senderInput).val(
                        $(sender).find('li').text()
                      );
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
                  console.log($('#' + recieverId).children('#' + ui.item.attr('id')).length);
                    if(!( ui.item.hasClass('single') && $('#' + recieverId).children('#' + ui.item.attr('id')).length > 1)){                        
                        ui.item.clone().appendTo('#' + recieverId);
                    }
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
             
             /* DELETE FROM TIMETABLE */
             
              $('.timetable').on( 'click' , '.multiple-event-infos i.delete' , function(){                 
                 var text = $(this).parent().text();
                 var input =  $(this).parent().parent().siblings('input');
                 
                 $(input).val(function() {
                        return $(this).val().replace(text, '');
                  });
                  
                  $(this).parent().remove();
             });
             
             $('.timetable').on('click', '.pos-infos i.delete, .event-infos i.delete', function(){                
                 var textDelete = $(this).parent().text();
                 var input =  $(this).parent().parent().siblings('input');
                 var timetableId = $(this).parent().parent().attr('id');                                   
                 var liElementName = $(this).parent().attr('name');
                 var liElementId = $(this).parent().attr('id');
                 
                 var li = $('body').find('.' + liElementName);
                    
                 $('#' + liElementId).appendTo(li);     
                 
                 
                 $(input).val(
                    $('#' + timetableId).find('li').text()
                  );            
                 
             });             
            
             /* MODALS */
            $('.content').on('click', '.modal-button' , function(){
               var id = $(this).attr('id');
                $('.'+id).show();
            });
        
            $('.modal-content span.close').on('click', function() {
                $(this).parent().parent().hide();        
            });
        
            $('.modal-content button.cancel').on('click', function() {        
                $('[class$=\"-modal\"]').hide();        
            });
            
            /*Add Event Modal*/
            
            $('button#add-event-modal').on('click', function() {        
                var date = $(this).attr('date');
                var timetable = $('ul[date=\"'+ date +'\"]');
                var singlesInTimetable  = $(timetable).find('.single');                
                $('.add-event-modal').attr('id', date);                
                $('.add-event-modal li').show();                
                singlesInTimetable.each(function() { 
                    var id = $(this).attr('id');
                    $('.add-event-modal#' + date).find('#' + id).hide();
                });             
            });
            
            $('.add-event-modal li').on('click', function() {        
                var date = $('.add-event-modal').attr('id');
                var timetable = $('ul[date=\"'+ date +'\"]');
                $(this).clone().prependTo($(timetable));              
                $('[class$=\"-modal\"]').hide();                         
            });
            
            
            /*COMMENTS*/
            
            
            var comments = $('.comment p');            
            
            for (let comment of comments){                
                var text = $(comment).text();
                       
                var commentLength = 15;             
                   
                if (text.length > commentLength){                                  
                    var text1 = text.slice(0, commentLength);
                    var text2 = text.slice(commentLength, text.length);
                                   
                    $(comment).parent().find('a.readMore').show();
                    $(comment).text(text1);
                    $(comment).append('<span>' + text2 + '</span>')
                }
            }
            
            
            $('a.readMore').click(function() {
                var id = $(this).attr('id');                
                $('.comment p.' + id + ' span').toggle();
                
                if($('.comment p.' + id + ' span').is(':visible')){
                    $(this).text(' - ');
                } else {
                    $(this).text(' + ');
                }
                
                                
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
            
            
            groupShops('group1');
            
            $('.grouping button').click( function() {
                var id = $(this).attr('id');
                  $('.grouping .active').removeClass('active');                  
                  $(this).addClass('active');
                  
                  groupShops(id);
                  
            });
           
            
            /* AUTOPLAN */
            
            var val = $('.autoload select').val();
            $('.' + val).show();
            
            $('.autoload select').change(function() {
              $('.planning-content').hide();
              var val = $(this).val();
              $('.' + val).show()
            });
            
        
             
             });
             </script>";

        $code .= "<style>
            h4{
                margin: 15px 0 10px 0;
            }
            
            ul {
            list-style-type: none;
            padding: 0;
            margin-top: 0;
            }
            
            
            ul li{
            list-style-type: none;
            display: block;
            }

            .pos p{
            margin: 0 0 5px 0;
            }
            
            
            
            .pos-number, .pos-address, .pos-client, .pos-type, .sap-number{
                font-size: 0.8rem;
            }
            
            .pos-number, .sap-number{
                display: inline;
            }
            
            p.sap-number{
                color: #6e6e6e;
                float: right;
                margin: 0 0 5px; 0;
            }
            
            .pos-client, .pos-type{
                display: inline;
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
            margin: 0;
            }
            
            .comment p span{
            display: none;
            }

            /* COLOR FILTERS */

            #color-filter{
                margin: 15px 0 0 0;
                
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
            
           
            #color-filter button#red, #color-filter button#red:hover{
                border-color: darkred;
                background: none;
                box-shadow: none;
            }
            
            #color-filter button#red.active{
                background-color: darkred;
                box-shadow: inset 0 0 5px #fff;
            }
            
            #color-filter button#yellow, #color-filter button#yellow:hover{
                border-color: orange;  
                background: none;             
            }
            
            #color-filter button#yellow.active{
                background-color: orange;   
                box-shadow: inset 0 0 5px #fff;            
            }
            
            #color-filter button#green, #color-filter button#green:hover{
                border-color: limegreen;  
                background: none;              
            }
            
            #color-filter button#green.active{
                background-color: limegreen;   
                box-shadow: inset 0 0 5px #fff;             
            }
            
            #color-filter button#blue, #color-filter button#blue:hover{
                border-color: dodgerblue;
                background: none;
            } 
            
            #color-filter button#blue.active{
                background-color: dodgerblue;
                box-shadow: inset 0 0 5px #fff;
            }
            
            
            li.red p.pos-name{
                color: darkred;
            }
            
            li.orange p.pos-name{
                color: orange;
            }
            
            li.green p.pos-name{
                color: limegreen;
            }
            
            li.blue p.pos-name{
                color: dodgerblue;
            }
            
            /* GROUPS */
            
            .grouping{
                margin: 0 0 10px 0;
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
            
            
            a.readMore{
                display: none;
            }
            
            </style>";


        return $code;
    }
//SUBTASK 18224: "STUFF" --------------------------------------------

private function eventModal(){
    $eventCnt = 0;
    $code = "";
    $code .= "<div class='add-event-modal'>";
    $code .= "<div class='modal-content'>";
    $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
    $code  .= "<h5>".l(18224,102,'Add Event')."</h5>";
    $code  .= "<hr>";
    $code  .= "<div class='col-12'>";
    $code  .= "<label>".l(18224,11,"Select Event")."</label>";
    $code .= "<ul class='pos'>";
    foreach ($this->events as $event) {
        $code .= "<li class='multiple-event-infos col-12";
        if ($event['multiple'] != 'true') {
            $code .=" single ";
        }
        $code .= "' id='event-" . $event['id'] ."' name='panel-multiple-event'>";
        $code .= "<i class='fas fa-times delete'></i>";
        $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
        $code .= "<div class='col-12'>";
        $code .= "<p class='event-name col-10'>" . $event['name'] . "</p>";
        if (isset($event['icon'])) {
            $code .= "<img class='col-2' src='" . $event['icon'] . "'>";
        }
        $code .= "</div>";
        $code .= "</li>";
        $eventCnt++;
    }
    $code .= "</ul>";
    $code .= "</div>";
    $code .= "<div class='modal-buttons'>";
    $code .= "<button id='delete' class='cancel' type='button'>".l(18224,4,"Cancel")."</button>";
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";
    return $code;
}


private function editModal(){
  $code = "";
  $code .= "<div class='pos-modal'>";
  $code .= "<div class='modal-content'>";
  $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
  $code .= "<div>";
  $code .= "<h5>".l(18224,101,"Additional Infos:")."</h5>";
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
  $eventCnt = 0;
  $code  = "";

  $code .= "<div class='content row col-9'>";
  $code .= "<div class='col-9 autoplans'>";
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



private function shop($entry){
    $commentCnt = 0;
    $cnt = 0;
    $code = "";
    $code .= "<li class='pos-infos col-12 " . strtolower($entry['color']) . "'  name='panel-" . $cnt . "' id='" . $entry['shop_id'] . "'>";
    $code .= "<i class='fas fa-times delete'></i>";
    $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
    if ($entry['offline'] == 'true') {
        $code .= "<i class='fas fa-wifi-slash offline'></i>";
    }
    if (!empty($entry['shop_id'])  ) {$code .= "<p class='pos-number'>" . $entry['shop_id'] . "</p>";}
    if (!empty($entry['sap_number'])  ) {$code .= "<p class='sap-number'>" . $entry['sap_number'] . "</p>";}
    if (!empty($entry['name'])  ) {$code .= "<p class='pos-name'>" . $entry['name'] . " <a target='_blank' href='/intern/modules/AGI/PV/shops_show.php?id=" . $entry['shop_id'] . "'><i class='fas fa-external-link-alt'> </i> </a> </p>";}
    if (!empty($entry['street']) || !empty($entry['city'])  ) {
        $code .= "<p class='pos-address'>";
        if (!empty($entry['street'])  ) {
            $code .= $entry['street'];
        }
        if (!empty($entry['street']) && !empty($entry['city'])  ) {
            $code .= ", ";
        }
        if (!empty($entry['city'])  ) {
            $code .= $entry['city'];
        }
        $code .= "</p>";
    }
    if (!empty($entry['client'])) {$code .= "<p class='pos-client'>" . $entry['client'] . " </p>";}
    if (!empty($entry['cat'])) {$code .= "<p class='pos-type'>" . $entry['cat'] . "</p>";}
    if (isset($entry['comment']) || isset($entry['reminder'])){
        $code .= "<div class='comment col-12'>";
        $code .= "<i class='fas fa-info col-2'></i>";
        $code .= "<div class='col-10'>";
        $code .= "<p>" . $entry['reminder'] . "</p>";
        $code .= "<p class='comment-" . $commentCnt . "''>";
        $code .= $entry['comment'];
        $code .= "</p>";
        $code .= "<a class='readMore' id='comment-" . $commentCnt . "'>" . l(18221, 1, "read more") . "</a>";
        $code .= "</div>";
        $code .= "</div>";
    }
    $code .= "</li>";
    $commentCnt++;

    return $code;
}



private function event($entry){
    $code = "";
    $code .= "<li class='event-infos col-12'  name='panel-event' id='event-" . $entry['id'] . "'>";
    $code .= "<i class='fas fa-times delete'></i>";
    $code .= "<i class='fas fa-comment add-comment modal-button' id='pos-modal'></i>";
    $code .= "<div class='col-12'>";
    $code .= "<p class='event-name col-10'>" . $entry['name'] . "</p>";
    if (isset($entry['icon'])) {
        $code .= "<img class='col-2' src='" . $entry['icon'] . "'>";
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
    return $code;
}

//SUBTASK 18220: "_CONSTRUCT" --------------------------------------------
var $user = '';
var $date_start = '';
var $date_end = '';
var $dates = [];
var $shops = [];
var $events = [];
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
  $this->dates = self::dates($date_start, $date_end);
  // LOAD SHOPS
  $myShops = \rtm::shops($user['id']);
  if(count($myShops)==0){
    throw new Exception(
      label('EXCEPTION', 'NO_SHOPS', 'No existen puntos de venta')
    );
  }
  $sql= "SELECT crm_shops_bs.id AS shop_id, 
                              crm_shops_bs.name AS name, 
                              crm_shops_bs.sap_number AS sap_number, 
                crm_shops_bs.shop_street AS street, 
                crm_shops_bs.shop_city AS city, 
                crm_shops_lk.name AS cat, 
                crm_clients_bs.name AS client, 
                crm_shops_bs.comment AS comment,  
                crm_shops_bs.comment AS reminder, 
                rt_focus_dt.status_color AS color,  
                crm_clients_bs.name AS group1, 
                crm_shops_bs.shop_city AS group2, 
                rt_focus_bs.name AS group3

           FROM crm_shops_bs
      LEFT JOIN crm_shops_lk ON crm_shops_bs.cat_id = crm_shops_lk.id
      LEFT JOIN crm_clients_bs ON crm_shops_bs.client_id=crm_clients_bs.id
      LEFT JOIN rt_focus_dt ON crm_shops_bs.id= rt_focus_dt.shop_id 
                                                      AND rt_focus_dt.status<90
                              AND ( rt_focus_dt.date_end='0000-00-00' 
                                          OR rt_focus_dt.date_end >DATE(NOW())
                                   )
      LEFT JOIN rt_focus_bs ON rt_focus_bs.id=focus_id 
                                                  AND rt_focus_bs.status<90
                                                  AND  rt_focus_bs.gpv_id IN (".$user['id'].")
              WHERE crm_shops_bs.id IN (".implode(',', $myShops).")";
  // $myPageBody .= "$sql<br>";
  $result = db_query($sql);
  while($row = mysql_fetch_assoc($result)){
    $this->groups[$row['client']][] = $row;
  }
  $sql= "SELECT * 
                   FROM gpv_previsit_lk
          WHERE active='true'
              AND is_visit <> 'true' 
       ORDER BY pos, name";
  $result = db_query($sql);
  while($row = db_fetch_row($result)){
    $this->events[] = $row;
  }
}
//SUBTASK 18221: "SIDEBAR" --------------------------------------------
private function sidebar(){
  $code = "";
  $code .= "<div class='col-3'>";
  $code .= "<div class='col-12 tabs'>";
  $code .= "<h2  class='col-12'>".l( 18221, 103, 'Planning Settings')."</h2>";
  
  $code .= "<div class='search col-12'>";
  $code .= "<input class='col-11' type='text' id='searchInput' placeholder='".l( 18221, 3, 'search')."'>";
  $code .= "<i class='fas fa-search search-icon col-1'></i>";
  $code .= "</div>";
  
  $code .= "<h4  class='col-7'>".l( 18221, 104, 'Point of sales')."</h4>";
  $code .= "<div class='col-5' id='color-filter'>";
  $code .= "<button class='active' id='blue' type='button'></button>";
  $code .= "<button class='active' id='green' type='button'></button>";
  $code .= "<button class='active' id='yellow' type='button'></button>";
  $code .= "<button class='active' id='red' type='button'></button>";
  $code .= "</div>";
  $code .= "<div class='grouping col-12'>";
  $code .= "<button class='active' type='button' id='group1'>".l( 18221, 6, 'Chain')."</button>";
  $code .= "<button type='button' id='group2'>".l( 18221, 7, 'City')."</button>";
  $code .= "<button type='button' id='group3'>".l( 18221, 8, 'Group')."</button>";
  $code .= "</div>";
  $code .= "<div class='points-of-sales'></div>";
  
  $code .= "<script>
        function groupShops(groupName){            
            $('.points-of-sales').empty();
             var groups = {};            
             for(let shop in shops){                
                var myShops = shops[shop];                
                var myGroups = myShops[groupName];
                if(groups[myGroups] == undefined){
                    groups[myGroups] = [];
                }
                groups[myGroups].push(myShops);
             }  
             
             const orderedGroups = {};
                Object.keys(groups).sort().forEach(function(key) {
                orderedGroups[key] = groups[key];
             });
             
             var html = '';
             var cnt = 0;            
             for(let group in orderedGroups){
                 html += '<div class=\'title-part accordion\' id=\'panel-' + cnt + '\'>';
                 html += '<h5 class=\'col-12\'>';  
                 if(group != 'null' && group != null){
                   html += group 
                 } else { 
                   html += undefined_label;
                 }  
                 html +='</h5>';
                 html += '<hr class=\'col-12\'>';
                 html += '</div>';
                 html += ' <ul class=\'panel-' + cnt + ' pos connectedSortable\' id=\'sortable-' + cnt + '\'>';
                 
                 for(let shopIndex in groups[group]){                     
                    var shop = groups[group][shopIndex];
                    /*DON'T LOAD ITEMS THAT ARE ALREADY IN THE TIMETABLE*/
                    if($('.timetable').find('li#' + shop['shop_id'] ).length < 1 ){                 
                     
                        html += ' <li class=\'pos-infos col-12 ' + shop['color'].toLowerCase() + '\'  name=\'panel-' + cnt + '\' id=\'' + shop['shop_id'] + '\'> ';
                        html += '<i class=\'fas fa-times delete\'></i>';
                        html += '<i class=\'fas fa-comment add-comment modal-button\' id=\'pos-modal\'></i>';
                        if( shop['offline'] == 'true' ) {
                            html += '<i class=\'fas fa-wifi-slash offline\'></i>';
                        }
                        if(shop['shop_id']) { html += '<p class=\'pos-number\'>' + shop['shop_id'] + ' </p>'; }
                        if(shop['sap_number']) { html += '<p class=\'sap-number\'>' + shop['sap_number'] + ' </p>';} 
                         if(shop['name']) {html += '<p class=\'pos-name\'>' + shop['name'] + '<a target=\'_blank\' href=\'/intern/modules/AGI/PV/shops_show.php?id=' + shop['shop_id'] + ' \'> <i class=\'fas fa-external-link-alt\'> </i> </a> </p>';}
                         if(shop['street'] ||  shop['city']) {
                             html += '<p class=\'pos-address\'>';
                             if(shop['street']){
                                 html += shop['street'];
                             }
                             if(shop['street'] &&  shop['city']){
                                 html += ', ';
                             }
                             if(shop['city']){
                                 html += shop['city'];
                             } 
                             html += '</p>';}
                         if(shop['client']) {html += '<p class=\'pos-client\'>' + shop['client'] + ' </p>';}
                         if(shop['cat']) {html += '<p class=\'pos-type\'>' + shop['cat'] +' </p>';}

                        html += '</li>';       
                    } else {                        
                        /*CHANGE GROUP NAME IN LISTED ITEMS*/
                        $('.timetable').find('li#' + shop['shop_id']).attr('name' ,'panel-' + cnt);
                    }                    
                }                 
                 html += '</ul>';                 
                 cnt++;
             }             
             $(html).appendTo('.points-of-sales');       
             
            /*ADD SORDTABLE*/             
             $( '[id *= \'sortable-\']' ).sortable({                
              connectWith: '.timetable',
              revert: true,
            }).disableSelection();         
             
             /* ONLY SHOW SELECTED COLORS */
            
            $('#color-filter button').each( function() {             
                var isActive = $(this).hasClass('active');
                var id = $(this).attr('id');  
                
                if(isActive){
                    $('ul.pos li.' + id).show();
                } else {
                    $('ul.pos li.' + id).hide();
                }
            });
            
            $('input#searchInput').keyup();
         }";
      
  
  $jsonShops = [];
  
  foreach($this->groups as $name => $shops){
    foreach ($shops as $shop) {
      $jsonShops[$shop['shop_id']] = $shop;
    }
  }
  $code .= "var shops = ".json_encode($jsonShops) .";";

    $jsonEvents = [];

    foreach($this->events as $event){
        $jsonEvents[$event['id']] = $event;
    }
    $code .= "var events = ".json_encode($jsonEvents) .";";


  $code .= "</script>";
  $code .= "</div>";
  $code .= "<div><button class='update' type='submit' name='button18191' value=1>".l(18221,2,"Save")."</button></div>";
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
  $code .= $this->eventModal();
  $code .= $this->content();
  $code .= "</form>";
  $code .= "</main>";
  return $code;
}
//SUBTASK 18260: "CONTENT" --------------------------------------------
private function content(){
  $cnt = 0;
  $code = "";


    $code .= "

        <script>
        $(document).ready( function() {        
            value = $('#myPlan').val();
            var savedShops = JSON.parse(value);
            var cnt = 0;
            var commentCnt = 0;
            
            for(let savedShop in savedShops){
                var savedShopId = savedShops[savedShop].shop_id;
                var savedShopDate = savedShops[savedShop].date;
                var savedShopComment = savedShops[savedShop].comment;
                var savedShopTime = savedShops[savedShop].time;
                var savedEventCatID = savedShops[savedShop].catID; 
                var html = ''; 
                
                if(savedShopId > 0){
                    for(let shopID in shops){
                        var shop = shops[shopID];
                        if(savedShopId == shopID){
                            html += ' <li class=\'pos-infos col-12 ' + shop['color'].toLowerCase() + '\'  name=\'panel-' + cnt + '\' id=\'' + shop['shop_id'] + '\'> ';
                            html += '<i class=\'fas fa-times delete\'></i>';
                            html += '<i class=\'fas fa-comment add-comment modal-button\' id=\'pos-modal\'></i>';
                            if( shop['offline'] == 'true' ) {
                                html += '<i class=\'fas fa-wifi-slash offline\'></i>';
                            }
                            if(shop['shop_id']) { html += '<p class=\'pos-number\'>' + shop['shop_id'] + ' </p>'; }
                            if(shop['sap_number']) { html += '<p class=\'sap-number\'>' + shop['sap_number'] + ' </p>';} 
                            if(shop['name']) {html += '<p class=\'pos-name\'>' + shop['name'] + '<a target=\'_blank\' href=\'/intern/modules/AGI/PV/shops_show.php?id=' + shop['shop_id'] + ' \'> <i class=\'fas fa-external-link-alt\'> </i> </a> </p>';}
                            if(shop['street'] ||  shop['city']) {
                                html += '<p class=\'pos-address\'>';
                                if(shop['street']){
                                    html += shop['street'];
                                }
                                if(shop['street'] &&  shop['city']){
                                    html += ', ';
                                }
                                if(shop['city']){
                                    html += shop['city'];
                                } 
                                html += '</p>';}
                            if(shop['client']) {html += '<p class=\'pos-client\'>' + shop['client'] + ' </p>';}
                            if(shop['cat']) {html += '<p class=\'pos-type\'>' + shop['cat'] +' </p>';}
                             
                            if(savedShopComment || savedShopTime){
                               html += '<div class=\'comment col-12\'>';
                               html += '<i class=\'fas fa-info col-2\'></i>';
                               html += '<div class=\'col-10\'>';
                               if(savedShopTime){
                                   html += '<p>' + savedShopTime + '</p>';
                               }
                               if(savedShopComment){
                                   html += '<p class=\'comment-' + commentCnt + '\'>';
                                   html += savedShopComment;
                                   html += '</p>';
                                   html += '<a class=\'readMore\' id=\'comment-\'' + commentCnt + '\'> + </a>';
                               }
                               html += '</div>';
                               html += '</div>';
                            }
                            html += '</li>';   
                        } 
                    } 
                }
                    
                if (savedShopId < 1) {
                    for(let catID in events){
                        var event = events[catID];
                        if(savedEventCatID == catID){
                            html += '<li class=\'event-infos col-12\'  name=\'panel-event\' id=\'event-' + event['id'] + '\'>';
                            html += '<i class=\'fas fa-times delete\'></i>';
                            html += '<i class=\'fas fa-comment add-comment modal-button\' id=\'pos-modal\'></i>';
                            html += '<div class=\'col-12\'>';
                            html += '<p class=\'event-name col-10\'>'  + event['name'] + '</p>';
                            if (event['icon']) {
                                html += '<img class=\'col-2\' src=\''  + event['icon'] + '\'>';
                            }
                            html += '</div>';
                            html += '</li>';
                        }
                    }
                }  
                
                $(html).appendTo( $('ul[date=\"'+ savedShopDate +'\"]'));
            }
        }); 
    </script>";


  $code .=  "<div class='col-9 content'>";
  //$code .= "<input type='text' name='myPlan' id='myPlan' value='".$this->object()."'>";
  $code .= "<textarea name='myPlan' id='myPlan' style='width: 100%; height:200px'>".$this->object()."</textarea>";
  foreach($this->dates as $date=>$day) {
    $code .= "<div class='timetable-box'>";
    $code .= "<p class='list-header'>";
    $code .=  l('WEEKDAY', $day, $day)."<br>";
    $code .= "<small>".format::date($date)."</small>";
    $code .= "</p>";
      $code  .= "<button class='col-12 dropbtn modal-button' id='add-event-modal' type='button' date='" .format::date($date)."'>";
      $code  .= "<h5> <i class='fas fa-plus'> </i> ".l(18224,9,"Add Event")."</h5>";
      $code  .= "</button>";
    $code .= "<ul class='timetable ". $day ." connectedSortable' id='sortable-". $day ."' date='" .format::date($date)."'>";
    /* Saved shops are loaded inside here */
    $code .= "</ul>";
    $code .= "</div>";
    $cnt++;
  }
  $code .= "</div>";
  return $code;
}


//[/SUBTASKS]
  }
?>
