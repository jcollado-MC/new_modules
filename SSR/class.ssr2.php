<?php
  // Script created with CFB Framework Builder 
  // Client:  MARKET CONTROL
  // Project: MASTER I
  // Class Revision: 2
  // Date of creation: 2020-05-26 
  // All Copyrights reserved 
  // This is a class file and can not be executed directly 
  // CLASS FILE
    if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){ 
      header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
      exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
    }
    class SSR2{
//[SUBTASKS]
//SUBTASK 18163: "VARS" --------------------------------------------
var $dm = [];
var $dmid = [];
var $report;
var $dfn = [];
var $groups = [];
var $type = '';
var $types = ['TABLE', 'MATRIX', 'GALLERY', 'MAP'];

//SUBTASK 18154: "STATIC: HEADER" --------------------------------------------
private static $header;
static function Header(){
  global $myHeader;
  if(self::$header==TRUE) return;
  self::$header=TRUE;
  $myHeader .= "<script>


/* SEARCH */
$(document).ready(function(){
    $('#reports-search-bar').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $('.accordion').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 || $(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});




/* SEARCH TABLE SIDEBAR */


$(document).ready(function(){
    $('#tableSearchInputSSR').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('.table-fields .checkboxes label').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        $('.table-fields .title-part').filter(function() {
            $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });
});


/* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

$(document).ready(function(){
    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });
});



$(document).ready(function(){
    /* ADD IMAGE-GALLERY-SIDEBAR FIELDS */
    $('.add-gallery-fields').on('click', function () {
        var id = $(this).attr('id');
        $('.first-field .' + id ).clone().appendTo('#' + id + '~ .field-container').append('<i class=\'fas fa-times delete col-1\'></i>');
    });
    /* REMOVE IMAGE-GALLERY-SIDEBAR FIELDS*/
    $('.field-container').on('click', '.delete', function () {
        $(this).siblings().remove();
        $(this).remove();
    });
});



/* TOGGLE BETWEEN SPECIFIC AND PERIOD TIMESPAN */
$(document).ready(function(){
    $('.period-timespan').hide();
    $('#period-timespan').on('change', function(){
        var checked = $('#period-timespan').prop('checked');
        $('.specific-timespan').toggle(!checked);
        $('.period-timespan').toggle(checked);
    });
});




$(document).ready(function(){
    /* ADD CUSTOM FILTER FIELDS */
    $('.add-filter-fields').on('click', function () {
        $('.custom-filter-group#first').clone().find('input:text').val('').end().appendTo('#new-filter').removeAttr('id');
    });

    /* REMOVE CUSTOM FILTER FIELDS*/
    $('#new-filter').on('click', '.delete', function () {
        $(this).parent().parent('div').remove();
        $(this).remove();
    });
});

/* OVERLAY && UPDATE BUTTON*/
$(document).ready(function(){


    $('.specific-time-tag').hide();
    $('.period-time-tag').hide();
    $('.filter-tag').hide();


    $('.update-overlay').hide();
    $('form').change(function () {
        $('.update-overlay').show();
    });
    $('.update-overlay button.update').on('click', function() {
        $('.update-overlay').hide();


        $('.specific-time-tag').hide();
        $('.period-time-tag').hide();
        $('.filter-tag').hide();

        if($('input:checkbox#period-timespan').prop('checked')){
            $('.specific-time-tag').hide();
            $('p.period-time-tag span').html($('.period-timespan select').val());
            $('.period-time-tag').show();
        } else if(($('.timespan input#start-date').val().length || $('.timespan input#end-date').val().length) > 0){
            $('.period-time-tag').hide();

            var startdate = $('.timespan input#start-date').val().split('-');
            startdate = startdate[2] + '.' + startdate[1] + '.' + startdate[0].slice(-2);

            var enddate = $('.timespan input#end-date').val().split('-');
            enddate = enddate[2] + '.' + enddate[1] + '.' + enddate[0].slice(-2);

            $('p.specific-time-tag .start').html(startdate);
            $('p.specific-time-tag .end').html(' - ' + enddate);

            $('.specific-time-tag').show();
        }

        var filters = $('.custom-filter-group');

        for (let filter of filters){
            console.log(filter);
        }


    });
});



$(document).ready(function(){

    $('.filter-tags i.delete').on('click', function(){
        console.log($(this).attr('id'));
        var id = $(this).attr('id');

        if(id == 'period-timespan'){
            $('input:checkbox#' + id).prop('checked', false).trigger('change');
        }else if(id == 'specific-timespan'){
            $('.' + id + ' input').val('').trigger('change');
        }

        $(this).parent().hide();
    });

});




</script>";
  $myHeader .= "<style>

  .report-content{
    padding: 0 15px;
    margin-bottom: 15px;
}


input#tableSearchInputSSR{
    background: none;
    border: none;
    border-bottom: 1px solid black;
    padding: 5px 10px;
}


/* CONTROLS */

.add, .share, .download, .copy, .newsletter{
    font-size: 1.2rem;
    color: #3f48cc;
    border: none;
    background: none;
    float: right;
}

.add-report{
    margin: 15px 0;
}

.actions button.share, .actions button.download, .actions button.copy, .actions button.newsletter{
    float: right;
    margin: 0;
}

.table-fields, .matrix-fields, .gallery-fields{
    margin-top: 20px;
}


#group-by-dropdown , #sort-by-dropdown {
    padding: 0;
}

#group-by-dropdown ul, #sort-by-dropdown ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
}

#group-by-dropdown ul li, #sort-by-dropdown ul li{
    padding: 5px;
    text-align: left;
}

#group-by-dropdown ul li:hover, #sort-by-dropdown ul li:hover, #group-by-dropdown ul li:active, #sort-by-dropdown ul li:active{
    background-color: #cccccc;
}



.custom-filter-group{
    background-color: #eeeeee;
    padding: 10px 15px;
    margin-top: 5px;
}

.custom-filter-group select, input{
    margin: 5px 0;
}

.custom-filter-group#first i.delete{
    display: none;
}

.content{
    position: relative;
    min-height: 400px;
}


.update-overlay{
    position: absolute; /* Stay in place */
    z-index: 333; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    box-shadow: 0 20px 20px 0 rgba(0,0,0,0.4);
}

.update-overlay button.update{
    width: 120px;
    position: absolute;
    top: 200px;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    filter: none;
}

.filter-tags{
    display: inline-block;
}


.filter-tags p{
    display: inline;
    background-color: #eee;
    border-radius: 15px;
    font-size: 0.8rem;
    padding: 5px;
    color:#777;
    margin: 5px;
}

.filter-tags i.delete, .filter-tags i.delete:before{
    float: none;
}
</style>";
}
//SUBTASK 18153: "_CONSTRUCT" --------------------------------------------




function __construct($dmid, $type='', $report_id=0){
        global $CFR_USER, $myPageBody;
        self::header();
        ini_set("memory_limit", "1024M");
        ini_set("max_execution_time", "1200");
        $this->dm = "Stores";
        if($this->dm=='') $mypage->PageDenied();
        $this->dmid = $dmid;
        // CHECK TYPE & LANGUAGE
        $this->type = $type;
        if(!in_array($type, $this->types)){
            throw new exception("[18153-1] Report Type not defined");
        }
        $l = trim($CFR_USER['lang']);
        switch($l){
            case 'lang_es': $l = 'es_ES';break;
            case 'lang_de': $l = 'de_DE';break;
            default: $l = 'en_EN';
        }
        // LOAD FIELDS
        $fields[] = ['id' => 0,'description'=>'Store', 'name'=>'ID'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Name'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Street'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'City'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Region'];
        $fields[] = ['id' => 0,'description'=>'Store2', 'name'=>'ID'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Name2'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Street2'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'City2'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Region2'];
        $fields[] = ['id' => 0,'description'=>'Store3', 'name'=>'ID2'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Name'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Street'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'City'];
        $fields[] = ['id' => 0,'description'=>'', 'name'=>'Region'];
        foreach($fields as $row){
            if($row['description']<>'') $group = $row['description'];
            $field = [];
            $field['id'] = $row['id'];
            $field['name'] = $row['name'];
            $field['label'] = $row['name'];
            $field['type'] = $row[''];
            $field['group'] = $row[''];
            $this->groups[$group][] = $field;
        }
    }




function __construct2($dmid, $type='', $report_id=0){
  global $CFR_USER, $myPageBody;
  self::header();
  $sql =" SELECT field_name
            FROM cfr_fielddev 
           WHERE table_name = 'TABLE' 
             AND id = ".$dmid." 
             AND drs_searchable <> 'FALSE' 
             AND FIND_IN_SET('".$CFR_USER['team']."', user_groups)>0
    ";
  ini_set("memory_limit", "1024M");
  ini_set("max_execution_time", "1200");
  $this->dm = db_value($sql);
  if($this->dm=='') $mypage->PageDenied();
  $this->dmid = $dmid;
  // CHECK TYPE & LANGUAGE
  $this->type = $type;
  if(!in_array($type, $this->types)){
    throw new exception("[18153-1] Report Type not defined");
  }
  $l = trim($CFR_USER['lang']);
  switch($l){
    case 'lang_es': $l = 'es_ES';break;
    case 'lang_de': $l = 'de_DE';break;
    case 'lang_fr': $l = 'fr_FR';break;
    case 'lang_it': $l = 'it_IT';break;
    default: $l = 'en_EN'; 
  }
  db_query("SET lc_time_names = '$l'"); // get lang

  // LOAD FIELDS
  $sql= "SELECT id, 
  							name, 
                description 
           FROM cfr_fielddev 
          WHERE table_name = '".$this->dm."' 
         		AND UPPER(drs_searchable)='TRUE' 
      	ORDER BY position, id";
  $result = db_query($sql);
  while($row = db_fetch_row($result)){
    if($row['description']<>'') $group = $row['description'];
    $field = [];
    $field['id'] = $row['id'];
    $field['name'] = $row['name'];
    $field['label'] = $row['name'];
    $field['type'] = $row[''];
    $field['group'] = $row[''];
    $this->groups[$group][] = $field;
  }
}
//SUBTASK 18161: "LOAD" --------------------------------------------
function load($report_id){
	global $myPageBody;
  $sql = "SELECT id, 
  							 name, 
                 ssr 
            FROM cfr_ssr_bs 
        	 WHERE id = ".$report_id;
  $report = db_direct($sql);
  $myPageBody .= "<h2>".$report[1]."</h2>";
  $all = unserialize(base64_decode($report['ssr']));
  $definition = array_pop($all);
  $this->open($definition);
}
//SUBTASK 18164: "OPEN" --------------------------------------------
function open($dfn){
  global $myPageBody;
  // $myPageBody .= "<pre>".print_r($dfn,true)."</pre><hr>";
  switch($dfn['type']){
    case 1: 
    	$report = new ListReport(); 
      $this->type = "TABLE";
      break;
    case 3: 
    	$report = new MatrixReport(); 
      $this->type = "MATRIX";
      break;
    case 7: 
    	$report = new GalleryReport(); 
      $this->type = "GALLERY";
      break;
    case 8: 
    	$report = new MapReport(); 
      $this->type = "MAP";
      break;
    default: 
    	throw new exception("[18164-1] Report Type not defined");
  }
  $this->report = $report;
  $this->matrix1 = $dfn['matrix1'];
  $this->matrix2 = $dfn['matrix2'];
  // $myPageBody .= "<pre>".print_r($this,true)."</pre>";
}
//SUBTASK 18165: "SHOW" --------------------------------------------
function show(){
  global $myPageBody;
  $code ="<form>";
  $code .= $this->sidebar();
  $code .= $this->save();
  $code .= $this->delete();
  $code .= $this->filter();
  $code .= $this->actions();
  $code .= $this->content();
  $code .="</form>";//*/
  return $code;
}

//SUBTASK 18150: "SIDEBAR: MAIN" --------------------------------------------
function sidebar(){
    switch($this->type){
        case "TABLE": return $this->sidebarTable();
        case "MATRIX": return $this->sidebarMatrix();
        case "GALLERY": return self::sidebarGallery();
    }
    throw new exception("[18150-1]: Sidebar Type not defined");
}

//SUBTASK 18151: "SIDEBAR: TABLE" --------------------------------------------
    private function sidebarTable(){
        global $myPageBody;

        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Table Settings</h2>
        <div class='search col-12'>
         <i class='fas fa-search search-icon col-1'></i>
          <input class='col-11' type='text' id='tableSearchInputSSR' placeholder='Search'>
    </div>";
        $cnt = 0;
        foreach($this->groups as $name => $fields){
            $cnt++;
            $code .= "<div class='col-12 table-fields'>";
            $code .= "<div class='title-part'>
                        <h5 class='col-10'>".$name."</h5>
                        <div class='col-2 row'>
                            <label class='switch'>
                                <input type='checkbox' id='group".$cnt."' class='groups'>
                                <span class='slider round'></span>
                            </label>
                        </div>
                        <hr class='col-12'>
                    </div>";
            // TODO RENAME FIELDS
            $code .= "<div class='col-12 checkboxes'>";
            foreach($fields as $field){
                $code .= "<label class='col-6' data-id='1'>";
                $code .= "<input type='checkbox' class='group".$cnt."'>";
                $code .= $field['name'];
                $code .= "</label>";
            }
            $code .= "</div> "; // FIELDS
            $code .= "</div>"; // GROUP
        }
        $code .="</div>";

        return $code;
    }
//SUBTASK 18159: "SIDEBAR: MATRIX" --------------------------------------------
    private function sidebarMatrix(){
        global $myPageBody;

        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Matrix Settings</h2>";
        $code .= "<div class='col-12 row matrix-fields'>";
        $code .= "<label>
                        <h5>X-Axis <i class='fas fa-arrow-right'></i></h5>
                  </label>";
        $code .= "<select class='col-12'>";

        foreach($this->groups as $name => $fields){

            $code .= "<optgroup label='$name'>";
            foreach($fields as $field){

                $code .= "<option>";
                $code .= $field['name'];
                $code .= "</option>";
            }
        }
        $code .= "</select>";
        $code .= "</div>";

        $code .= "<div class='col-12 row matrix-fields'>";
        $code .= "<label><h5>Y-Axis <i class='fas fa-arrow-down'></i></h5></label>";
        $code .= "<select class='col-12'>";
        foreach($this->groups as $name => $fields){

            $code .= "<optgroup label='$name'>";
            foreach($fields as $field){

                $code .= "<option>";
                $code .= $field['name'];
                $code .= "</option>";
            }
        }
        $code .= "</select>";
        $code .= "</div>";


        $code .= "<div class='col-12 row matrix-fields'>";
        $code .= "<label><h5>Calculation</h5></label>";
        $code .= "<select class='col-12'>";
        $code .= "<option>Entries</option>";
        $code .= "<option>Sum</option>";
        $code .= "<option>Average</option>";
        $code .= "<option>Min</option>";
        $code .= "<option>Max</option>";
        $code .= "<option>Last Visit</option>";
        $code .= "</select>";
        $code .= "</div> ";


        $code .= "<div class='col-12 row matrix-fields'>";
        $code .= "<label><h5>Total</h5></label>";
        $code .= "<select class='col-12'>";
        $code .= "<option>Sum</option>";
        $code .= "<option>Average</option>";
        $code .= "<option>Count</option>";
        $code .= "<option>Median</option>";
        $code .= "</select>";
        $code .= "</div> ";

        $code .="</div>";

        return $code;
    }

//SUBTASK 18160: "SIDEBAR: GALLERY" --------------------------------------------
  private function sidebarGallery(){
        global $myPageBody;
        $code = "";
        $code .= "<div class='col-3'>";
        $code .= "<div class='col-12 tabs'>";
        $code .= "<h2>Gallery Settings</h2>";
        $code .= "<div class='col-12 row gallery-fields'>
                            <label  class='col-12'>
                                <h5>Maximum Images per Row</h5>
                            </label>";
        $code .= "<hr class='col-12'>";
        $code .= "<select class='col-2'>";
        $code .= "<option>1</option>";
        $code .= "<option>2</option>";
        $code .= "<option selected='selected'>3</option>";
        $code .= "</select>";
        $code .= "</div>";


        $code .= "<div class='col-12 row gallery-fields'>
                            <label  class='col-11'>
                                <h5>Group Title</h5>
                            </label>
                            <button class='add-gallery-fields add col-1' type='button' id='group-title-fields'>
                                <i class='fas fa-plus'></i>
                            </button>
                            <hr class='col-12'>";
        // TODO RENAME FIELDS
        $code .= "<div class='first-field'>";
        $code .= "<div class='group-title-fields'>";
        $code .= "<input type='text' list='value-list' class='col-11'>
                                    <datalist id='value-list'>";
        foreach($this->groups as $name => $fields) {
          $code .= "<optgroup label='$name'>";
          foreach ($fields as $field) {
            $code .= "<option>";
            $code .= $field['name'];
            $code .= "</option>";
          }
        }
        $code .= "</datalist>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "<div class='field-container'>";
        $code .="</div>";
        $code .="</div>";


        $code .= "<div class='col-12 row gallery-fields'>
                            <label  class='col-11'>
                                <h5>Image Title</h5>
                            </label>
                            <button class='add-gallery-fields add col-1' type='button' id='image-title-fields'>
                                <i class='fas fa-plus'></i>
                            </button>
                            <hr class='col-12'>";
        // TODO RENAME FIELDS
        $code .= "<div class='first-field'>";
        $code .= "<div class='image-title-fields'>";
        $code .= "<input type='text' list='value-list' class='col-11'>
                                    <datalist id='value-list'>";
        foreach($this->groups as $name => $fields) {
          $code .= "<optgroup label='$name'>";
          foreach ($fields as $field) {
            $code .= "<option>";
            $code .= $field['name'];
            $code .= "</option>";
          }
        }
        $code .= "</datalist>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "<div class='field-container'>";
        $code .="</div>";
        $code .="</div>";


        $code .= "<div class='col-12 row gallery-fields'>
                            <label  class='col-11'>
                                <h5>Image Text</h5>
                            </label>
                            <button class='add-gallery-fields add col-1' type='button' id='image-text-fields'>
                                <i class='fas fa-plus'></i>
                            </button>
                            <hr class='col-12'>";
        // TODO RENAME FIELDS
        $code .= "<div class='first-field'>";
        $code .= "<div class='image-text-fields'>";
        $code .= "<input type='text' list='value-list' class='col-11'>
                                    <datalist id='value-list'>";
        foreach($this->groups as $name => $fields) {
          $code .= "<optgroup label='$name'>";
          foreach ($fields as $field) {
            $code .= "<option>";
            $code .= $field['name'];
            $code .= "</option>";
          }
        }
        $code .= "</datalist>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "<div class='field-container'>";
        $code .="</div>";
        $code .="</div>";


        $code .= "<div class='col-12 row gallery-fields'>
                            <label  class='col-11'>
                                <h5>Image Subtitle</h5>
                            </label>
                            <button class='add-gallery-fields add col-1' type='button' id='image-subtitle-fields'>
                                <i class='fas fa-plus'></i>
                            </button>
                            <hr class='col-12'>";
        $code .= "<div class='first-field'>";
            $code .= "<div class='image-subtitle-fields'>";
        $code .= "<input type='text' list='value-list' class='col-11'>
                                    <datalist id='value-list'>";
        foreach($this->groups as $name => $fields) {
          $code .= "<optgroup label='$name'>";
          foreach ($fields as $field) {
            $code .= "<option>";
            $code .= $field['name'];
            $code .= "</option>";
          }
        }
        $code .= "</datalist>";
            $code .= "</div>";
        $code .= "</div>";
        $code .= "<div class='field-container'>";
        $code .="</div>";
        $code .="</div>";

        $code .="</div>";

        return $code;
      }


//SUBTASK 18166: "ELEMENT: FILTER" --------------------------------------------
    private function filter(){
    $code = "
            <div class='report-content col-9'>
                <div class='row col-9 filters'>";

    $code .= "
                    <div class='dropdown'>
                        <button id='timespan' class='dropbtn' type='button'><h5>Timespan <i class='fas fa-caret-down'></i></h5> </button>
                        <div class='dropdown-content timespan'>
                            <div class='col-12 row'>
                                <label>
                                    <input type='checkbox' id='period-timespan'>
                                    Period Timespan
                                </label>
                                
                                <div class='specific-timespan'>
    
                                  <div class='col-12'>
                                      <label>From</label>
                                      <input type='date' id='start-date'>
                                  </div>
                                  <div class='col-12'>
                                      <label>To</label>
                                      <input type='date' id='end-date'>
                                  </div>
                                </div>
                                
                                <div class='period-timespan'>
                                    <select class='col-12'>
                                        <option>yesterday</option>
                                        <option>last week</option>
                                        <option>last month</option>
                                        <option>last year</option>
                                        <option>last half year</option>
                                    </select>
                                 </div>
                            </div>                            
                        </div>
                    </div>";
    $code .= "
                    <div class='dropdown'>
                        <button id='filter' class='dropbtn' type='button'><h5>Custom Filters <i class='fas fa-caret-down'></i></h5> </button>
                        <div class='dropdown-content filter'>
                            <button class='add add-filter-fields' type='button'>
                            <i class='fas fa-plus'></i>
                            </button>
                           
                            <div class='custom-filter-group col-12' id='first'>
                                <div class='filter-header'>
                                <label class='col-11'>Filter:</label>
                                <i class='fas fa-times delete col-1'></i>
                                </div>";

                                $code .="<div class='col-12'>";
                                $code .= "<input type='text' list='value-list' class='col-12'>
                                         <datalist id='value-list'>";
                                foreach($this->groups as $name => $fields) {
                                  $code .= "<optgroup label='$name'>";
                                  foreach ($fields as $field) {
                                    $code .= "<option>";
                                    $code .= $field['name'];
                                    $code .= "</option>";
                                  }
                                }
                                $code .= "</datalist>";
                                $code .= "</div>
                                <div class='col-12'>
                                    <select class='col-12'>
                                        <option> contains </option>
                                        <option>does not contain</option>
                                        <option> starts with </option>
                                        <option>is equal to</option>
                                        <option> is greater than </option>
                                        <option> is less than </option>
                                        <option> is empty </option>
                                    </select>
                                </div>
                                <div class='col-12'>";
                                $code .= "<input type='text' list='value-list' class='col-12'>
                                         <datalist id='value-list'>";
                                foreach($this->groups as $name => $fields) {
                                  $code .= "<optgroup label='$name'>";
                                  foreach ($fields as $field) {
                                    $code .= "<option>";
                                    $code .= $field['name'];
                                    $code .= "</option>";
                                  }
                                }
                                $code .= "</datalist>";
                                $code .= "</div>
                                </div>
                            <div id='new-filter'></div>         
                        </div>
                    </div>";
        $code .= "<div class='filter-tags'>";
        $code .= "<p class='specific-time-tag'>";
        $code .= "<span class='start'></span>";
        $code .= "<span class='end'></span>";
        $code .= "<i class='fas fa-times delete' id='specific-timespan'></i>";
        $code .= "</p>";
        $code .= "<p class='period-time-tag'>";
        $code .= "<span></span>";
        $code .= "<i class='fas fa-times delete' id='period-timespan'></i>";
        $code .= "</p>";
        $code .= "<p class='filter-tag'>";
        $code .= "<span></span>";
        $code .= "<i class='fas fa-times delete' id='filter-tag'></i>";
        $code .= "</p>";
        $code .= "</div>";
    $code .= "</div>";

    return $code;
  }
//SUBTASK 18167: "ELEMENT: ACTIONS" --------------------------------------------
    private function actions(){
    $code = "";
    $code .= "<div class='col-3 actions'>";
//    TODO: only show newsletter and share if saved
    $code .= "<button class='newsletter' type='button'>
                <i class='fas fa-envelope-open-text'></i>
              </button>";
    $code .= "<button class='modal-button share' type='button' id='share-modal'>
                  <i class='fas fa-share-alt'></i>
              </button>
                    
                    <div class='share-modal'>
                      <div class='modal-content'>";
                        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
                        $code .= "<div>";
                          $code .= "<h5>Share this Report</h5>";
                          $code .= "<hr class='col-12'>";
                          $code .= "<label>With other users:</label>";
//                          TODO: Iterate over user list!
                          $code .= "<div class='row col-12'>
                        <label class='col-4'>
                            <input type='checkbox'>
                            User 1
                        </label>
                        <label class='col-4'>
                            <input type='checkbox' CHECKED>
                            User 2
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Super U
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Monoprix
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Cora
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Carrefour
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Intermarché
                        </label>
                        <label  class='col-4'>
                            <input type='checkbox'>
                            Géant
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Monoprix
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Cora
                        </label>
                        <label  class='col-4'>
                            <input type='checkbox'>
                            Carrefour
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            User 1
                        </label>
                        <label class='col-4'>
                            <input type='checkbox' CHECKED>
                            User 2
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Super U
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Monoprix
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Cora
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Carrefour
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Intermarché
                        </label>
                        <label  class='col-4'>
                            <input type='checkbox'>
                            Géant
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Monoprix
                        </label>
                        <label class='col-4'>
                            <input type='checkbox'>
                            Cora
                        </label>
                        <label  class='col-4'>
                            <input type='checkbox'>
                            Carrefour
                        </label>
                    </div>";
                          $code .= "<button id='save'>Share</button>";
                          $code .= "<button id='delete' class='cancel'>Cancel</button>";
                        $code .= "</div>";
                      $code .= "</div>";
                    $code .= "</div>";

  $code .= "<button class='download' type='button'>
                <i class='fas fa-file-download'></i>
             </button>";


  $code .= "<button class='copy' type='button'>
              <i class='fas fa-copy'></i>
            </button>
             
          </div>";

    return $code;
  }
//SUBTASK 18172: "ELEMENT: SAVE" --------------------------------------------
    private function save(){
        $code = "<button id='save' class='modal-button' type='button'>Save</button>";
        $code .= "<div class='save save-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Save this report</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<label>Choose a name:</label>";
        $code .= "<input class='col-12' type='text' placeholder='Unknown'>";
        $code .= "<div class='modal-buttons'>";
        $code .= "<button id='save'>Save</button>";
        $code .= "<button id='delete' class='cancel' type='button'>Cancel</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }
//SUBTASK 18173: "ELEMENT DELETE" --------------------------------------------
    private function delete(){
//        TODO: only show button if saved
        $code = "<button id='delete' class='modal-button' type='button'>Delete</button>";
        $code .= "<div class='delete delete-modal'>";
        $code .= "<div class='modal-content'>";
        $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
        $code .= "<div>";
        $code .= "<h5>Do you really want to delete this report?</h5>";
        $code .= "<hr class='col-12'>";
        $code .= "<p>It will be gone forever</p>";
        $code .= "<button id='delete'  class='cancel' type='button'>Cancel</button>";
        $code .= "<button id='save'>Delete</button>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .="</div>"; //CLOSE SIDEBAR

        return $code;
    }

//SUBTASK 18155: "CONTENT: MAIN" --------------------------------------------
function content(){
//  return $this->report->build();
    switch($this->type){
    case "TABLE": return $this->contentTable();
     case "MATRIX": return $this->contentMatrix();
     case "GALLERY": return $this->contentGallery();
  }
  throw new exception("[18155-1] Content Type not defined");
}

//SUBTASK 18156: "CONTENT: TABLE" --------------------------------------------
    private function contentTable(){
    $code = "";

    $code .= "<div class='table col-12 content'>";

        $code .= "<div class='col-12 update-overlay'>";
        $code .= "<button class='update' type='button'> <i class='fas fa-sync-alt'> </i> Update</button>";
        $code .= "</div>";

    $code .= "TABLE";
    $code .= "</div>";

    return $code;
    }

//SUBTASK 18157: "CONTENT: MATRIX" --------------------------------------------
    private function contentMatrix(){
    $code = "";
    $code .= "<div class='wrapper'>";
    $code .= "<div class='matrix col-12 content'>";
        $code .= "<div class='col-12 update-overlay'>";
        $code .= "<button class='update' type='button'> <i class='fas fa-sync-alt'> </i> Update</button>";
        $code .= "</div>";
    $code .= "MATRIX";
    $code .= "</div>";
    $code .= "</div>";
    return $code;
    }

//SUBTASK 18158: "CONTENT: GALLERY" --------------------------------------------
    private function contentGallery(){
    $code = "";
    $code = "<div class='image-gallery col-12 content'>";
        $code .= "<div class='col-12 update-overlay'>";
        $code .= "<button class='update' type='button'> <i class='fas fa-sync-alt'> </i> Update</button>";
        $code .= "</div>";
        $code .= "<div class='col-12 gallery-group'> 
                        <h3>First Store</h3>";
        $code .= "
                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_10742_11_377_4.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4><b>Title Example</b></h4>
                                <p class='text'>Text Example, very good Text!</p>
                                <p class='subtitle'>I am a Subtitle</p>
                            </div>
                        </div> ";

        $code .= "  
                        <div class='card col-4'>
                            <div class='image' style='background-image: url(Images/img_10742_11_377_9.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4><b>Title Example</b></h4>
                                <p class='text'>Text Example, very good Text!</p>
                                <p class='subtitle'>I am a Subtitle</p>
                            </div>
                        </div>";

        $code .= "  
                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_10742_11_377_11.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4><b>Title Example</b></h4>
                                <p class='text'>Text Example, very good Text!</p>
                                <p class='subtitle'>I am a Subtitle</p>
                            </div>
                        </div>";

        $code .= "
                    </div>";

        $code .="   
                        <div class='col-12 gallery-group'>
        
                        <h3>Second Store</h3>";

        $code .="
                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_10265_31_205_3.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4><b>Title Example</b></h4>
                                <p class='text'>Text Example, very good Text!</p>
                                <p class='subtitle'>I am a Subtitle</p>
                            </div>
                        </div>";

        $code .="        
                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_10306_31_136_4.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4><b>Title Example</b></h4>
                                <p class='text'>Text Example, very good Text!</p>
                                <p class='subtitle'>I am a Subtitle</p>
                            </div>
                        </div>";

        $code .="
                    </div>
                </div>
            </div>";
    $code .= "</div>";
    return $code;
    }

//[/SUBTASKS]
  }
?>
