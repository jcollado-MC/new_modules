<?php
// Script created with CFB Framework Builder
// Client:  MARKET CONTROL
// Project: MASTER I
// Class Revision: 2
// Date of creation: 2020-05-28
// All Copyrights reserved
// This is a class file and can not be executed directly
// CLASS FILE
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
}
class SSR2{
//[SUBTASKS]
//SUBTASK 18153: "_CONSTRUCT" --------------------------------------------
  function __construct($dmid, $type='', $report_id=0){
    global $CFR_USER, $myPageBody;
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
    if(self::$header==TRUE) return;
    self::$header=TRUE;
    $code = "<script>
$(document).ready(function() {

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



    /* MODALS */
    // hide on initial
    $('[class$=\"-modal\"]').hide();

    //show modal with class of button id
    $('.modal-button').on('click', function () {
        var id = $(this).attr('id');
        $('.' + id).show();
    });

    //close modal when click on close icon
    $('.modal-content span.close').on('click', function () {
        $(this).parent().parent().hide();
    });
    //close modal when click on cancel button
    $('.modal-content button.cancel').on('click', function () {
        $('[class$='-modal']').hide();
    });



    /* SEARCH TABLE SIDEBAR */

    $('#searchInput').on('keyup', function () {
        //get value of searchbar input
        var value = $(this).val().toLowerCase();
        //filter checkbox-labels for search value
        $('.table-fields .checkboxes label').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        // when the title-part still has unfiltered checkboxes as siblings, show, otherwise hide
        $('.table-fields .title-part').filter(function () {
            $(this).toggle($(this).siblings().text().toLowerCase().indexOf(value) > -1);
        });

    });


    /* SELECT ALL CHECKBOXES FOR CURRENT GROUP */

    $('.groups').on('click', function () {
        var id = $(this).attr('id');
        var allChecked = $(this).prop('checked');
        $('.' + id).prop({
            checked: allChecked
        });
    });

    /* TODO: IF ALL CHECKBOXES ARE SELECTED, CHECK \"SELECT ALL\" CHECKBOX */


    /* ADD IMAGE-GALLERY-SIDEBAR FIELDS */

    $('.add-gallery-fields').on('click', function () {
        //get group-id of Sidebar-Fields
        var id = $(this).attr('id');
        //first-field with group-id as class will be cloned,
        // cleaned and appended to container,
        // also delete button will be added
        $('.first-field .' + id).clone()
            .find('input')
            .val('')
            .end()
            .appendTo('#' + id + '~ .field-container')
            .append('<i class=\'fas fa-times delete col-1\'></i>');
    });
    /* REMOVE IMAGE-GALLERY-SIDEBAR FIELDS*/
    $('.field-container').on('click', '.delete', function () {
        // remove sidebar-field and the delete button
        $(this).siblings().remove();
        $(this).remove();
    });



    /* TOGGLE BETWEEN SPECIFIC AND PERIOD TIMESPAN */

    // initial status
    if ($('input:checkbox#period-timespan').prop('checked')) {
        //if checkbox for period timespan is checked,
        // show period timespan and hide specific timespan
        $('.period-timespan').show();
        $('.specific-timespan').hide();
    } else {
        //if checkbox for period timespan is not checked,
        // show specific timespan and hide period-timespan-fields
        $('.period-timespan').hide();
        $('.specific-timespan').show();
    }

    //on change
    $('#period-timespan').on('change', function () {
        //if checkbox for period timespan is checked,
        // show period timespan and hide specific timespan,
        // otherways hide
        var checked = $('#period-timespan').prop('checked');
        $('.specific-timespan').toggle(!checked);
        $('.period-timespan').toggle(checked);
    });






    /* ADD CUSTOM FILTER FIELDS */

    // variable for counting custom filter-fields
    var filterid = 1;

    $('.add-filter-fields').on('click', function () {
        // on add, count variable up
        filterid++;

        //clone first-filter-dropdown,
        // then clean the input-fields,
        // clean the selects,
        // add filter-count to classlist,
        // and appednt it to container for new filter
        // then remove the \"first-filer\" id
        $('.dropdown#first-filter').clone()
            .find('.dropdown-content input:text')
            .val('')
            .end()
            .find('.dropdown-content select')
            .prop('selectedIndex', 0)
            .end()
            .find('.dropdown-content')
            .addClass('filter-' + filterid)
            .removeClass('filter')
            .end()
            .appendTo('.new-filter')
            .find('button.dropbtn')
            .attr('id', 'filter-' + filterid)
            .end()
            .removeAttr('id');
    });


    /* REMOVE CUSTOM FILTER FIELDS*/

    $('.new-filter').on('click', '.delete', function () {
        //The highest parent div - the dropdown button has to be removed,
        //trigger update-overlay after deleting a filter
        $(this).parent().parent().parent().parent('div.dropdown').remove();
        $('.dropdown-content').trigger('change');
    });


    /* OVERLAY && UPDATE BUTTON*/

    $('.update-overlay').hide();
    $('form').change(function () {
        //when form fields change, show update-overlay
        $('.update-overlay').show();
    });
    $('.update-overlay button.update').on('click', function () {
        //hide overlay if updated
        $('.update-overlay').hide();
    });
    

   /* NO END DATE BEFORE START DATE IS SET */

    $('[name = 'report[date_end]']').attr('disabled',true);
    $('[name = 'report[date_start]']').change(function(){
        if($(this).val() !== ''){
            $('[name = 'report[date_end]']').attr('disabled', false);
        } else if($(this).val() == ''){
            $('[name = 'report[date_end]']').attr('disabled', true);
        }
    });

});




</script>";
    $code .= "<style>



/* CONTROLS */

.add, .share, .download, .copy, .newsletter{
    font-size: 1.2rem;
    color: #3f48cc;
    border: none;
    background: none;
    float: none;
}

.add-report{
    margin: 15px 0;
}


.actions button{
    float: right;
    margin: 0;
}

.table-fields, .matrix-fields, .gallery-fields{
    margin-top: 10px;
}


.custom-filter-group{
    background-color: #eeeeee;
    padding: 5px 10px;
    margin-top: 5px;
}

.custom-filter-group select, .custom-filter-group input{
    margin: 5px 0;
}

#first-filter .dropdown-content i.delete{
    display: none;
}

.new-filter{
    display: inline;
}


.update-overlay{
    min-height: 400px;
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

</style>";
    return $code;
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
    $code ="<form method='post'>";
    $code .= $this->sidebar();
    $code .= $this->save();
    $code .= $this->delete();
    $code .= $this->filter();
    $code .= $this->actions();
    $code .= $this->content();
    $code .="</form>";//*/
    $code .= self::header();
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
    $code .= "<h2>Table Settings</h2>";


    $code .= "<div class='search col-12'>";
    $code .= "<input class='col-11' type='text' id='searchInput' placeholder='Search'>";
    $code .= "<i class='fas fa-search search-icon col-1'></i>";
    $code .= "</div>";


    $cnt = 0;
    foreach($this->groups as $name => $fields){
      $cnt++;
      $code .= "<div class='col-12 table-fields'>";
      $code .= "<div class='title-part'>";
      $code .= "<h5 class='col-10'>".$name."</h5>";
      $code .= "<div class='col-2 row'>";
      $code .= "<label class='switch'>";
      $code .= "<input type='checkbox' id='group".$cnt."' class='groups'>";
      $code .= "<span class='slider round'></span>";
      $code .= "</label>";
      $code .= "</div>";
      $code .= "<hr class='col-12'>";
      $code .= "</div>";
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


    $code .= "<div class='col-12 row table-fields'>";
    $code .= "<label  class='col-12'>";
    $code .= "<h5>Entry Limit</h5>";
    $code .= "</label>";
    $code .= "<hr class='col-12'>";
    $code .= "<input class='col-3' type='number'>";

    $code .= "</div>";
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
    $code .= "<label>";
    $code .= "<h5>X-Axis";
    $code .= "<i class='fas fa-arrow-right'></i>";
    $code .= "</h5>";
    $code .= "</label>";
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

    $code .= "<select class='col-9'>";
    foreach($this->groups as $name => $fields){

      $code .= "<optgroup label='$name'>";
      foreach($fields as $field){

        $code .= "<option>";
        $code .= $field['name'];
        $code .= "</option>";
      }
    }
    $code .= "</select>";

    $code .= "<select class='col-3'>";
    $code .= "<option>Sum</option>";
    $code .= "<option>Average</option>";
    $code .= "<option>Min</option>";
    $code .= "<option>Max</option>";
    $code .= "</select>";
    $code .= "</div> ";


    $code .= "<div class='col-12 row matrix-fields'>";
    $code .= "<label><h5>Total</h5></label>";
    $code .= "<select class='col-3'>";
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
    $code .= "<div class='col-12 row gallery-fields'>";
    $code .= "<label  class='col-11'>";
    $code .= "<h5>Group Title</h5>";
    $code .= "</label>";
    $code .= "<button class='add-gallery-fields add col-1' type='button' id='group-title-fields'>";
    $code .= "<i class='fas fa-plus'></i>";
    $code .= "</button>";
    $code .= "<hr class='col-12'>";
    // TODO RENAME FIELDS
    $code .= "<div class='first-field'>";
    $code .= "<div class='group-title-fields'>";
    $code .= "<input type='text' list='value-list' class='col-11'>";
    $code .= "<datalist id='value-list'>";
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


    $code .= "<div class='col-12 row gallery-fields'>";
    $code .= "<label  class='col-11'>";
    $code .= "<h5>Image Title</h5>";
    $code .= "</label>";
    $code .= "<button class='add-gallery-fields add col-1' type='button' id='image-title-fields'>";
    $code .= "<i class='fas fa-plus'></i>";
    $code .= "</button>";
    $code .= "<hr class='col-12'>";
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


    $code .= "<div class='col-12 row gallery-fields'>";
    $code .= "<label  class='col-11'>";
    $code .= "<h5>Image Text</h5>";
    $code .= "</label>";
    $code .= "<button class='add-gallery-fields add col-1' type='button' id='image-text-fields'>";
    $code .= "<i class='fas fa-plus'></i>";
    $code .= "</button>";
    $code .= "<hr class='col-12'>";
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


    $code .= "<div class='col-12 row gallery-fields'>";
    $code .= "<label  class='col-11'>";
    $code .= "<h5>Image Subtitle</h5>";
    $code .= "</label>";
    $code .= "<button class='add-gallery-fields add col-1' type='button' id='image-subtitle-fields'>";
    $code .= "<i class='fas fa-plus'></i>";
    $code .= "</button>";
    $code .= "<hr class='col-12'>";
    $code .= "<div class='first-field'>";
    $code .= "<div class='image-subtitle-fields'>";
    $code .= "<input type='text' list='value-list' class='col-11'>";
    $code .= "<datalist id='value-list'>";
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

    $code .= "<div class='col-12 row gallery-fields'>";
    $code .= "<label  class='col-10'>";
    $code .= "<h5>Maximum Images per Row</h5>";
    $code .= "</label>";
    $code .= "<hr class='col-12'>";
    $code .= "<select class='col-2'>";
    $code .= "<option>1</option>";
    $code .= "<option>2</option>";
    $code .= "<option selected='selected'>3</option>";
    $code .= "</select>";
    $code .= "</div>";

    $code .="</div>";

    return $code;
  }

  private function filter(){
    $code  = "<div class='content col-9'>";
    $code .= "<div class='row col-9 filters'>";
    $code .= "<div class='dropdown'>";
    $code .= "<button id='timespan' class='dropbtn' type='button'>";
    $code .= "<h5>";
    if ($this->report[0]['datefield']!= "" ){
        $code .= $this->report[0]['datefield'];
    } else {
      $code .= "Time Span";
    }
    $code .= " <i class='fas fa-caret-down'></i></h5> </button>";
    $code .= "<div class='dropdown-content timespan'>";
    $code .= "<div class='col-12 row'>";
    $code .= "<label><input type='checkbox' id='period-timespan'>".l(18166,2,"Periodo móvil")."</label>";
    $code .= "<div class='specific-timespan'>";
    $code .= "<div class='col-12'>".l(18166,3,"From")." ";
    $code .= "<input type='date' name='report[date_start]' value='"

        .$this->report[0]['date_start']."'>";
    $code .= "</div>";
    $code .= "<div class='col-12'>".l(18166,4,"To")." ";
    $code .= "<input type='date' name='report[date_end]' value='".$this->report[0]['date_end']."'>";
    $code .= "</div>";
    $code .= "</div>";
    // PERIOD
    $code .= "<div class='period-timespan'>";
    $code .= "<select class='col-12' name='report[dateperiod]'>";
    $periods = ["TODAY", "YESTERDAY", "THIS_WEEK", "LAST_2_WEEKS", "MOBILE_MONTH",
        "LAST_6_MONTHS", "YTD", "NEXT_WEEK", "NEXT_MONTH"];
    $code .= "<option value=''>";
    foreach($periods as $period){
      $code .= "<option value='$period'>";
      $code .= l(18166,$period,str_replace('_', ' ', $period));
    }
    $code .= "</select>";
    $code .= "</div>";
    // CLOSE
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";

    // FILTERS
    /* TODO: Change Checkbox label with Filter Value */
    $code .= "<div class='dropdown' id='first-filter'>";
    $code .= "<button id='filter' class='dropbtn' type='button'><h5>Custom Filters <i class='fas fa-caret-down'></i></h5> </button>";
    $code .= "<div class='dropdown-content filter'>";


    $code .= "<div class='custom-filter-group col-12' >";
    $code .= "<div class='filter-header'>";
    $code .= "<label class='col-11'>Filter:</label>";
    $code .= "<i class='fas fa-times delete col-1'></i>";
    $code .= "</div>";

    $code .="<div class='col-12'>";
    $code .= "<select name='filter1[]' class='col-12' >";
    $code .= "<option></option>";
    foreach($this->groups as $name => $fields) {
      $code .= "<optgroup label='".$name."'>";
      foreach ($fields as $field) {
        $code .= "<option value='".$field['id']."'";
        // 	TODO: SAVE FILTER IN STRUCT
//        if($this->filters==$field['id']) $code .= "SELECTED";
        $code .= ">".$field['name']."</option>";
      }
    }
    $code .= "</select>";
    $code .= "</div>";
    $code .= "<div class='col-12'>";
    $code .= "<select class='col-12' name='filter2[]'>";
    $options = ['', '', '', '', '', '', '', ''];
    foreach($options as $key => $value){
      $code .= "<option value=''";
      $code .= ">".$value."</option>";
    }

    $code .= "</select>";
    $code .= "</div>";
    $code .= "<div class='col-12'>";
    $code .= "<input type='text' list='value-list' class='col-12'>";
    // OR ADD MULTI-SELECT
    /*
      $code .= "<datalist id='value-list'>";
    foreach($this->groups as $name => $fields) {
      $code .= "<optgroup label='$name'>";
      foreach ($fields as $field) {
        $code .= "<option>";
        $code .= $field['name'];
        $code .= "</option>";
      }
    }
    $code .= "</datalist>";
    */
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";
    $code .= "<div class='new-filter'></div>";
    $code .= "<button class='add add-filter-fields' type='button'>";
    $code .= "<i class='fas fa-plus'></i>";
    $code .= "</button>";
    $code .= "</div>";
    return $code;
  }

//SUBTASK 18167: "ELEMENT: ACTIONS" --------------------------------------------
  private function actions(){
    $code = "";
    $code .= "<div class='col-3 actions'>";
//    TODO: only show newsletter and share if saved
    $code .= "<button class='newsletter' type='button'>";
    $code .= "<i class='fas fa-envelope-open-text'></i>";
    $code .= "</button>";
    $code .= "<button class='modal-button share' type='button' id='share-modal'>";
    $code .= "<i class='fas fa-share-alt'></i>";
    $code .= "</button>";
    $code .= "<div class='share-modal'>";
    $code .= "<div class='modal-content'>";
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
    // return $this->report->build();
    $code  = "<div class='wrapper'>";
    $code .= "<div class='col-9 content'>";
    $code .= "<div class='col-12 update-overlay'>";
    $code .= "<button class='update' type='button'> <i class='fas fa-sync-alt'> </i> Update</button>";
    $code .= "</div>";
    switch($this->type){
      case "TABLE": $code .= $this->contentTable(); break;
      case "MATRIX": $code .=  $this->contentMatrix(); break;
      case "GALLERY": $code .=  $this->contentGallery();break;
      default: throw new exception("[18155-1] Content Type not defined");
    }
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";

    return $code;
  }
//SUBTASK 18156: "CONTENT: TABLE" --------------------------------------------
  private function contentTable(){
    $code = "";
    $code .= "TABLE";
    return $code;
  }
//SUBTASK 18157: "CONTENT: MATRIX" --------------------------------------------
  private function contentMatrix(){
    return "MATRIX";
  }

//SUBTASK 18158: "CONTENT: GALLERY" --------------------------------------------
  private function contentGallery(){
    $code = "<div class='image-gallery'>";
    $code .= "<div class='col-12 gallery-group'>";
    $code .= "<h3>First Store</h3>";
    $code .= "<div class='card col-4'>
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
    $code .= "</div>";
    return $code;
  }
//[/SUBTASKS]
}
?>
