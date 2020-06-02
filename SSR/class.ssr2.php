<?php
  // Script created with CFB Framework Builder 
  // Client:  MARKET CONTROL
  // Project: MASTER I
  // Class Revision: 2
  // Date of creation: 2020-06-02 
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
var $report_id=0;
var $report_name=0;
var $report;
var $dfn = [];
var $groups = [];
var $owners = [];
var $type = '';
static $types = ['TABLE', 'MATRIX', 'GALLERY', 'MAP'];
//SUBTASK 18153: "_CONSTRUCT" --------------------------------------------
function __construct($dmid){
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
  // CHECK LANGUAGE
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
//SUBTASK 18186: "PRIVATE: FIELD" --------------------------------------------
private function field($id){
	return db_value("SELECT field_name FROM cfr_fielddev WHERE id='".$id."'");
}
//SUBTASK 18154: "STATIC: HEADER" --------------------------------------------
private static $header;
static function Header(){
  if(self::$header==TRUE) return;
  self::$header=TRUE;
  $code = "<script>
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

    if($('input:checkbox#period-timespan').prop('checked')){
        $('.period-timespan').show()
        $('.specific-timespan').hide();
    }else {
        $('.period-timespan').hide();
        $('.specific-timespan').show();
    }
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
        $('.dropdown-content').trigger('change');
    });
});

/* OVERLAY && UPDATE BUTTON*/
$(document).ready(function(){


    if($('input:checkbox#period-timespan').prop('checked')){
        $('p.period-time-tag span').html($('.period-timespan select').val());
        $('.period-time-tag').show();
        $('.specific-time-tag').hide();
    } else if(($('.timespan input#start-date').val().length || $('.timespan input#end-date').val().length) > 0){
        $('.period-time-tag').hide();

        var startdate = $('.timespan input#start-date').val().split('-');
        startdate = startdate[2] + '.' + startdate[1] + '.' + startdate[0].slice(-2);

        var enddate = $('.timespan input#end-date').val().split('-');
        enddate = enddate[2] + '.' + enddate[1] + '.' + enddate[0].slice(-2);

        $('p.specific-time-tag .start').html(startdate);
        $('p.specific-time-tag .end').html(' - ' + enddate);

        $('.specific-time-tag').show();
    }else{
        $('.period-time-tag').hide();
        $('.specific-time-tag').hide();
    }


    $('.update-overlay').hide();
    $('form').change(function () {
        $('.update-overlay').show();
    });
    $('.update-overlay button.update').on('click', function() {
        $('.update-overlay').hide();


        $('.specific-time-tag').hide();
        $('.period-time-tag').hide();


        if ($('input:checkbox#period-timespan').prop('checked')) {
            $('.specific-time-tag').hide();
            $('p.period-time-tag span').html($('.period-timespan select').val());
            $('.period-time-tag').show();
        } else if (($('.timespan input#start-date').val().length || $('.timespan input#end-date').val().length) > 0) {
            $('.period-time-tag').hide();

            var startdate = $('.timespan input#start-date').val().split('-');
            startdate = startdate[2] + '.' + startdate[1] + '.' + startdate[0].slice(-2);

            var enddate = $('.timespan input#end-date').val().split('-');
            enddate = enddate[2] + '.' + enddate[1] + '.' + enddate[0].slice(-2);

            $('p.specific-time-tag .start').html(startdate);
            $('p.specific-time-tag .end').html(' - ' + enddate);

            $('.specific-time-tag').show();
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
  $code .= "<style>
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


.add-filter-fields{
    margin-top: 5px;
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
    padding: 5px 10px;
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
  return $code;
}
//SUBTASK 18188: "STATIC: GET ICON" --------------------------------------------
static function getIcon($type){
  switch($type){
    case 'TABLE': 	return "<i class='fas fa-table'></i>";
    case 'MATRIX': 	return "<i class='fas fa-border-all'></i>";
    case 'GALLERY': return "<i class='fas fa-images'></i>";
    case 'MAP': 		return "<i class='fas fa-globe-europe'></i>";
  }
}
//SUBTASK 18187: "STATIC: TYPES" --------------------------------------------
static function types($dmid){
  global $myPageBody;
  $code  = "";
  // $code .= "<div class='delete-modal' >";
  $code .= "<div class='modal-content'>";
  $code .= "<div>";
  $code .= "<h5>".l(18173,1,"What type of report do you want?")."</h5>";
  $code .= "<hr class='col-12'>";
  $link = "ssr_show2.php?dmid=".$dmid."&report[type]=";
  foreach(self::$types as $key){
    $code .= "<a href='".$link.$key."'>";
    $code .= self::getIcon($key);
    $code .= label('LITERAL', $key, $key);
    $code .= "</a><br>";
  }
  $code .= "</div>";
  $code .= "</div>";
  // $code .= "</div>";
  $code .= self::header();
  return $code;
}
//SUBTASK 18161: "LOAD" --------------------------------------------
function load($report_id){
	global $myPageBody, $CFR_USER, $USERNAME;
  $sql = "SELECT *
            FROM cfr_ssr_bs 
        	 WHERE id = ".$report_id;
  $report = db_direct($sql);
  // ACCESS & SHARED
  if($USERNAME==$report['user_create']) $this->owners[0] = $CFR_USER['id'];
  for($n=1;$n<=5;$n++){
    $this->owners[$n] = $report['user'.$n];
  }
  if(!in_array($CFR_USER['id'], $this->owners) && $CFR_USER['team']<>'Admin'){
    return false;
  }
  // SET UP
  $this->report_id = $report_id;
  $this->report_name = $report['name'];
  $myPageBody .= "<h2>".$report['name']."</h2>";
  $all = unserialize(base64_decode($report['ssr']));
  $d = array_pop($all);
  if(trim($d['datedelimiter1'])<>'')$d['date_start'] = trim($d['datedelimiter1']);
  if(trim($d['datedelimiter2'])<>'')$d['date_end'] = trim($d['datedelimiter2']);
  if(trim($dfn['dateperiod'])=='0 DAY') $dfn['dateperiod']="TODAY";
  if(trim($dfn['dateperiod'])=='1 DAY')	$dfn['dateperiod']="YESTERDAY";
  $this->open($d);
}
//SUBTASK 18164: "OPEN" --------------------------------------------
function open($dfn){
  global $myPageBody;
  // $myPageBody .= "<pre>".print_r($_REQUEST,true)."</pre><hr>";
  $myPageBody .= "<pre>".print_r($dfn,true)."</pre><hr>";
  switch($dfn['type']){
    case 1: 
    case "TABLE": 
    	$this->report = new ListReport(); 
      $this->type = "TABLE";
      foreach($dfn['columns'] as $field){
        if(!is_numeric($field)) continue;
        $type = db_value("SELECT datatype FROM cfr_fielddev WHERE id=$field ");
        if($type=='') continue;
        $this->report->addField($this->field($field), $type);
        $this->columns[] = $field;
      }
      $this->report->limit(2000);
    	if(($dfn['limit']+0)>0) $this->report->limit($dfn['limit']);
      break;
    case 3: 
    case "MATRIX": 
    	$this->type = "MATRIX";
      $this->matrixX = $dfn['matrix1'];
      $this->matrixY = $dfn['matrix2'];
    	$this->report = new MatrixReport(); 
    	$this->report->addGroup($this->field($this->matrixY));
    	$this->report->addGroup($this->field($this->matrixX));
    	$this->report->addOrder($this->field($this->matrixY));
    	$this->report->addOrder($this->field($this->matrixX));
      foreach($dfn['columns'] as $field){
        switch($field){
          case -101: $this->report->addField('COUNT(*) '); break;
          case -102: $this->report->addField('COUNT(DISTINCT shop_id) '); break;
          default: 
          	$first = substr($field, 0, 1);
            switch($first){
              case 'S': $op="SUM"; 	break;
              case 'A': $op="AVG"; 	break;
              case 'm': $op="MIN"; 	break;
              case 'M': $op="MAX"; 	break;
              case 'Z': $op="MODA"; break;
              case 'P': $op="CUOTA"; break;
              case 'L': $op="LAST"; break;
            }
            $this->report->addCalc($op,$this->field(substr($field, 1)));
        }
        $this->columns[] = $field;
      }
      break;
    case 7: 
    case "GALLERY": 
    	$this->report = new GalleryReport(); 
      $this->type = "GALLERY";
    	$this->gallery_imgcnt = $dfn['gallery_imgcnt'];
    	if($this->report->gallery_imgcnt<1)$this->report->gallery_imgcnt=3;
        // GALLERY OPTIONS
        $this->report->galleryfield1 = $this->field($dfn['galleryfield']);
        $this->report->gallery_imgcnt = $dfn['gallery_imgcnt'];
        foreach($dfn['gallerytitle'] as $gallerytitle){
          $this->report->gallerytitle[] = $this->field($gallerytitle);
        }
        foreach($dfn['gallerylabel'] as $gallerylabel){
          $this->report->gallerylabel[] = $this->field($gallerylabel);
        }
        foreach($dfn['gallerytext'] as $gallerytext){
          $this->report->gallerytext[] = $this->field($gallerytext);
        }
      break;
    case 8: 
    case "MAP": 
    	$this->report = new MapReport(); 
      $this->type = "MAP";
      break;
    default: 
    	throw new exception("[18164-1] Report Type not defined");
  }
  // GENERIC OPTIONS
  $this->report->setDatamodel($this->dmid);
  // if($dfn['only_last_visit']=='true') $this->report->setLastVisit($date_start,$date_end);

  // DATES
		//3- FECHAS Y PERIODOS
  $dateField = $this->field($dfn['datefield']);
  $this->date = "";
  $this->datefield = $dfn['datefield'];
  if($dateField<>''){
    if($dfn['dateperiod']!=""){
      $this->report->addFilterPeriod($dateField, $dfn['dateperiod']);
      $this->date = l(18166,$dfn['dateperiod'],$dfn['dateperiod']);
    }else{
      $this->date_start = $dfn['date_start'];
      if($dfn['date_start']<>"" ){
        $this->date .= l(18164,2,"Desde")." ". \format::date($this->date_start);
				$this->report->addFilter($dateField,'>=','"'.$dfn['date_start'].'"');
      }
      $this->date_end = $dfn['date_end'];
      if($dfn['date_end']<>""){
        $this->date .= " ".l(18164,3,"hasta")." ".\format::date($this->date_end);
				$this->report->addFilter($dateField,'<=',"'".$dfn['date_end']."'");
      }
      if($this->date=='') $this->date = l(18166,1,"Periodo");
    }
  }
	// $myPageBody .= "<pre>".print_r($this->report,true)."</pre>";

  // FILTERS
  	// ADD FILTERS

}
//SUBTASK 18165: "SHOW" --------------------------------------------
function show(){
  global $myPageBody;
  $code = "<form method='post'>";
  $code .= "<input type='hidden' name='report[type]' value='".$this->type."'>";
  $code .= $this->sidebar();
  // $code .="<div>";
  	$code .= $this->save();
  	$code .= $this->delete();
  $code .="</div>";

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
  // $myPageBody .= "<pre>".print_r($this->columns,true)."</pre>";

  $code  = "<div class='col-3'>";
  $code .= "<div class='col-12 tabs'>";
  $code .= "<h2>".l(18151,1,"Table Settings")."</h2>";
  $code .= "<div class='search col-12'>
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
      $code .= "<input type='checkbox' name='report[columns][".$field['id']."]' value='".$field['id']."'";
      if(in_array($field['id'], $this->columns)) $code .= "CHECKED";
      $code .= " class='group".$cnt."'>";
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
  $code  = "<div class='col-3'>";
  $code .= "<div class='col-12 tabs'>";
  $code .= "<h2>".l(18159,1,"Matrix")."</h2>";
  $code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<h5>".l(18159,2,"X-Axis")." <i class='fas fa-arrow-right'></i></h5>";
  $code .= "<select class='col-12' name='report[matrix1]'>";
  foreach($this->groups as $name => $fields){    
    $code .= "<optgroup label='".$name."'>";
    foreach($fields as $field){
      $code .= "<option value='".$field['id']."' ";
      if($this->matrixX==$field['id']) $code .= "SELECTED";
      $code .= ">";
      $code .= $field['name'];
      $code .= "</option>";
    }
  }
  $code .= "</select>";
  $code .= "</div>";

  $code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<h5>".l(18159,3,"Y-Axis")." <i class='fas fa-arrow-down'></i></h5>";
  $code .= "<select class='col-12'  name='report[matrix2]'>";
  foreach($this->groups as $name => $fields){
    $code .= "<optgroup label='".$name."'>";
    foreach($fields as $field){
      $code .= "<option value='".$field['id']."' ";
      if($this->matrixY==$field['id']) $code .= "SELECTED";
      $code .= ">";
      $code .= $field['name'];
      $code .= "</option>";
    }
  }
  $code .= "</select>";
  $code .= "</div>";

  $code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<h5>".l(18159,4,"Calculation")."</h5>";
  $code .= "<select class='col-12' name='report[columns][]'>";
  $code .= "<option></option>";
  $code .= "<optgroup label='".l(18159,5,"General")."'>";
  $specials  = [];
  $specials[-101] = l(18159,6,"Entradas");
  $specials[-102] = l(18159,7,"Puntos de Venta");
  foreach($specials as $key=>$value){
    $code .= "<option value='".$key."' data-options='' ";
    if(in_array($key, $this->columns)) $code .= "SELECTED";
    $code .= ">".$value."</option>";
  }
  foreach($this->groups as $name => $fields){
    $code .= "<optgroup label='".$name."'>";
    foreach($fields as $field){
      $code .= "<option value='".$field['id']."' data-options='calc'";
      if(in_array($field['id'], $this->columns)) $code .= "SELECTED";
      $code .= ">";
      $code .= $field['name'];
      $code .= "</option>";
    }
  }
  $code .= "</select>";
  $code .= "</div> ";
  /*
  $code .= "<select class='col-12'>";
  $code .= "<option>Sum</option>";
  $code .= "<option>Average</option>";
  $code .= "<option>Min</option>";
  $code .= "<option>Max</option>";
  $code .= "<option>Last Visit</option>";*/

  /*$code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<label><h5>Total</h5></label>";
  $code .= "<select class='col-12'>";
  $code .= "<option>Sum</option>";
  $code .= "<option>Average</option>";
  $code .= "<option>Count</option>";
  $code .= "<option>Median</option>";
  $code .= "</select>";
  $code .= "</div> ";*/
  
  $code .="</div>";
  return $code;
}
//SUBTASK 18160: "SIDEBAR: GALLERY" --------------------------------------------
private function sidebarGallery(){
  global $myPageBody;
  $code  = "<div class='col-3'>";
  $code .= "<div class='col-12 tabs'>";
  $code .= "<h2>".l(18160,1,"Gallery Settings")."</h2>";
  $code .= "<div class='col-12 row gallery-fields'>";
  $code .= "<h5 class='col-12'>".l(18160,2,"Maximum Images per Row")."</h5>";
  $code .= "<hr class='col-12'>";
  $code .= "<select class='col-2' name='report[gallery_imgcnt]'>";
  foreach([1, 2, 3] as $n){
    $code .= "<option ";
    if($n==$this->gallery_imgcnt) $code .= "SELECTED";
    $code .= ">$n</option>";
  }
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
  $code  = "<div class='report-content col-9'>";
  $code .= "<div class='row col-9 filters'>";
  $code .= "<div class='dropdown'>";
  $code .= "<button id='timespan' class='dropbtn' type='button'>";
  $code .= "<h5>".$this->date." <i class='fas fa-caret-down'></i></h5> </button>";
  $code .= "<div class='dropdown-content timespan' style='display: none'>";
  $code .= "<div class='col-12 row'>";
  	$code .= "<input type='text' name='report[datefield]' value='".$this->datefield."'>";
	  $code .= "<label><input type='checkbox' id='period-timespan'>".l(18166,2,"Periodo móvil")."</label>";
  	$code .= "<div class='specific-timespan'>";
  		$code .= "<div class='col-12'>".l(18166,3,"Desde")." ";
    	  $code .= "<input type='date' name='report[date_start]' value='".$this->date_start."'>";
		  $code .= "</div>";
			$code .= "<div class='col-12'>".l(18166,4,"Hasta")." ";
	      $code .= "<input type='date' name='report[date_end]' value='".$this->date_end."'>";
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
  $code .= "<div class='dropdown'>";
  $code .= "<button id='filter' class='dropbtn' type='button'><h5>Custom Filters <i class='fas fa-caret-down'></i></h5> </button>";
  $code .= "<div class='dropdown-content filter'>";


  $code .= "<div class='custom-filter-group col-12' id='first'>
                                <div class='filter-header'>
                                <label class='col-11'>Filter:</label>
                                <i class='fas fa-times delete col-1'></i>
                                </div>";

  $code .="<div class='col-12'>";
  $code .= "<select name='filter1[]' class='col-12' >";
  $code .= "<option></option>";
  foreach($this->groups as $name => $fields) {
    $code .= "<optgroup label='".$name."'>";
    foreach ($fields as $field) {
      $code .= "<option value='".$field['id']."'";
      // 	TODO: SAVE FILTER IN STRUCT
      if($this->filters==$field['id']) $code .= "SELECTED";
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
  /*<option>does not contain</option>
    <option> starts with </option>
    <option>is equal to</option>
    <option> is greater than </option>
    <option> is less than </option>
    <option> is empty </option>*/
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
  $code .= "<div id='new-filter'></div> 
                            <button class='add add-filter-fields' type='button'>
                            <i class='fas fa-plus'></i>
                            </button>        
                        </div>
                    </div>";
  	/*
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
  $code .= "</div>";
  */
  $code .= "</div>";
  return $code;
}

//SUBTASK 18167: "ELEMENT: ACTIONS" --------------------------------------------
private function actions(){
  $code  = "<div class='col-3 actions'>";
  $code .= "<button class='download' type='button'>
                <i class='fas fa-file-download'></i>
            </button>";

  $code .= "<button class='copy' type='button'>
              <i class='fas fa-copy'></i>
            </button>";

  if($this->report_id>0){ // SAVED REPORT OPTIONS
    $code .= "<button class='newsletter' type='button'>
                  <i class='fas fa-envelope-open-text'></i>
                </button>";
    $code .= "<button class='modal-button share' type='button' id='share-modal'>
                    <i class='fas fa-share-alt'></i>
                </button>";

    $code .= "<div class='share-modal' style='display:none'>
                        <div class='modal-content'>";
    $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
    $code .= "<div>";
    $code .= "<h5>".l(18167,1,"Share this Report")."</h5>";
    $code .= "<hr class='col-12'>";
    $code .= "<label>With other users:</label>";
    // USERS
    $sql= "SELECT uname, name 
             FROM authuser 
            WHERE status = 'Active' 
              AND uname<>'$USERNAME' 
              AND status < 90
         ORDER BY name";

    for($n=1;$n<=5;$n++){
      $code .= "<select name='report[user".$n."]'>";
      $code .= "<option value=''> ";
      $result = db_query($sql);
      while($row = db_fetch_row($result)){
        $code .= "<option value='$row[0]' ";
        if($row[0]==$users[$n]) $code .= " SELECTED ";
        $code .= ">$row[1]";
      }
      $code .= "</select><br>\n";
    }
    $code .= "<button id='save'>Share</button>";
    $code .= "</div>";
    $code .= "</div>";
    $code .= "</div>";
  }
  $code .= "</div>";
  return $code;
}
//SUBTASK 18172: "ELEMENT: SAVE" --------------------------------------------
private function save(){
  $code = "<button id='save' class='modal-button' type='button'>".label('LITERAL', 'SAVE')."</button>";
  $code .= "<div class='save save-modal' style='display:none'>";
  $code .= "<div class='modal-content'>";
  $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
  $code .= "<div>";
  $code .= "<h5>".l(18172,2,"Save this report")."</h5>";
  $code .= "<hr class='col-12'>";
  $code .= "<label>".l(18172,2,"Choose a name:")."</label>";
  $code .= "<input class='col-12' type='text' placeholder='".l(18172,3,"My report")."' value='".$this->report_name."'>";
  $code .= "<div class='modal-buttons'>";
  $code .= "<button id='save'>".label('LITERAL', 'SAVE')."</button>";
  $code .= "<button id='delete' class='cancel' type='button'>".label('LITERAL', 'CANCEL')."</button>";
  $code .= "</div>";
  $code .= "</div>";
  $code .= "</div>";
  $code .= "</div>"; 
  return $code;
}
//SUBTASK 18173: "ELEMENT: DELETE" --------------------------------------------
private function delete(){
  // if($this->report_id==0) return '';
  $code = "<button id='delete' class='modal-button' type='button'>".label('LITERAL', 'DELETE')."</button>";
  $code .= "<div class='delete delete-modal' style='display: none'>";
  $code .= "<div class='modal-content'>";
  $code .= "<span class='close'><i class='fas fa-times delete'></i></span>";
  $code .= "<div>";
  $code .= "<h5>".l(18173,1,"Do you really want to delete this report?")."</h5>";
  $code .= "<hr class='col-12'>";
  $code .= "<p>It will be gone forever</p>";
  $code .= "<button id='delete'  class='cancel' type='button'>".label('LITERAL', 'CANCEL')."</button>";
  $code .= "<button id='save'>".label('LITERAL', 'DELETE')."</button>";
  $code .= "</div>";
  $code .= "</div>";
  $code .= "</div>";
  return $code;
}

//SUBTASK 18155: "CONTENT: MAIN" --------------------------------------------
function content(){
  try{
    $code .= "<div class='ssr col-12 content'>";
    $code .= "<div class='col-12 update-overlay'>";
    $code .= "<button class='update' type='submit'> ";
    $code .= "<i class='fas fa-sync-alt'> </i> ";
    $code .= label('LITERAL', 'UPDATE', 'Actualizar');
    $code .= "</button>";
    $code .= "</div>";
    if($this->type=="GALLERY"){
      $code .= $this->report->build2();
      // $this->contentGallery();
    }else{
      if(count($this->columns)==0){
        $code .= "<div class='col-12' style='box-shadow: 0 20px 20px 0 rgba(0,0,0,.4);'>";
  	      $code .= l(18155,1,"Please configure the report");
        $code .= "</div>";
      }else{
        // $code .= $this->report->explain()."<hr>";
        $code .= $this->report->build();
      }
    }
    $code .= "</div>";
    return $code;
  }catch (Exception $e) {
    $myPageBody .=  "Exception Subtask 18155: ". $e->getMessage(). "<hr>\n";
  }
}
//SUBTASK 18158: "CONTENT: GALLERY" --------------------------------------------
private function contentGallery(){
  $code  = "<div class='col-12 gallery-group'>";
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
  return $code;
}
//[/SUBTASKS]
  }
?>
