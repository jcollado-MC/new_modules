<?php
  // Script created with CFB Framework Builder 
  // Client:  MARKET CONTROL
  // Project: MASTER I
  // Class Revision: 2
  // Date of creation: 2020-05-25 
  // All Copyrights reserved 
  // This is a class file and can not be executed directly 
  // CLASS FILE
    if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){ 
      header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
      exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
    }
    class SSR2{
      //------------START SUBTASK BLOCK---------------------------------
var $dm = [];
var $dmid = [];
var $report;
var $dfn = [];
var $groups = [];
var $type = '';
var $types = ['TABLE', 'MATRIX', 'GALLERY', 'MAP'];

      //------------START SUBTASK BLOCK---------------------------------
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
    .add, .share, .download, .copy{
        font-size: 1.2rem;
        color: #3f48cc;
        border: none;
        background: none;
        float: right;
    }
    .add-report{
        margin: 15px 0;
    }
    .actions button{
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
  </style>";
}
      //------------START SUBTASK BLOCK---------------------------------
function __construct($dmid, $type='', $report_id=0){
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
      //------------START SUBTASK BLOCK---------------------------------
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
      //------------START SUBTASK BLOCK---------------------------------
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
      //------------START SUBTASK BLOCK---------------------------------
function show($id){
  global $myPageBody;
  $code .="<form>";
  $code .= $this->sidebar();
  $code .= $this->filter();
  $code .= $this->actions();
  $code .= $this->content();
  $code .="</form>";//*/
  return $code;
}

      //------------START SUBTASK BLOCK---------------------------------
function sidebar(){
  switch($this->type){
    case "TABLE": return $this->sidebarTable();
    case "MATRIX": return self::sidebarMatrix();
    case "GALLERY": return self::sidebarGallery();
  }
  throw new exception("[18150-1]: Sidebar Type not defined");
}

      //------------START SUBTASK BLOCK---------------------------------
private function sidebarTable(){
  global $myPageBody;
  $code = "
		<div class='col-3'>
    	<div class='col-12 tabs'>
	      <h2>Table Settings</h2>
        <div class='search col-12'>
         <i class='fas fa-search search-icon col-1'></i>
          <input class='col-11' type='text' id='tableSearchInputSSR' placeholder='Search'>
    </div>";
  $cnt=0;
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
  $code .="<button id='save'>Save</button>";
  // TODO: Only show delete when saved
  $code .= "<button id='delete'>Delete</button>";
  $code .= "</div>";
  return $code;
}
      //------------START SUBTASK BLOCK---------------------------------
private function sidebarMatrix(){
  global $myPageBody;
  $code = "<div class='col-3'>
		<div class='col-12 tabs'>
		<h2>Matrix Settings</h2>";
  $code .= "<form>";
  $cnt = 0;

  $code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<h5>X-Axis <i class='fas fa-arrow-right'></i></h5>";
  $code .= "<select class='col-12' name='dfn[matrix1]'>";
  foreach($this->groups as $name => $fields){
    $code .= "<optgroup label='$name'>";
    foreach($fields as $field){
      $code .= "<option value='".$field['id']."'";
      if($this->matrix1 == $field['id']) $code .= "SELECTED";
      $code .= ">".$field['name'];
      $code .= "</option>";
    }
  }
  $code .= "</select>";
  $code .= "</div>";

  $code .= "<div class='col-12 row matrix-fields'>";
  $code .= "<h5>Y-Axis <i class='fas fa-arrow-down'></i></h5>";
  $code .= "<select class='col-12' name='dfn[matrix2]'>";
  foreach($this->groups as $name => $fields){
    $code .= "<optgroup label='$name'>";
    foreach($fields as $field){
      $code .= "<option value='".$field['id']."'";
      if($this->matrix2 == $field['id']) $code .= "SELECTED";
      $code .= ">".$field['name'];
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
  
  
  $code .="</form>";
  $code .="</div>";
  $code .="<button id='save'>Save</button>";
  // TODO: Only show delete when saved
  $code .= "<button id='delete'>Delete</button>";
  $code .= "</div>";
  return $code;
}

      //------------START SUBTASK BLOCK---------------------------------
private function sidebarGallery(){
  global $myPageBody;



}
      //------------START SUBTASK BLOCK---------------------------------
function filter(){
  $code = "<div class='report-content col-9'>
                <div class='row col-9 filters'>";
  $code .= "
                    <div class='dropdown'>

                        <button onclick='dropdownFunction(\"timespan\")' class='dropbtn'><h5>Timespan <i class='fas fa-caret-down'></i></h5> </button>

                        <div class='dropdown-content' id='timespan'>

                            <div class='col-12 row'>

                                <label>

                                    <input type='checkbox' name='timespan' >

                                    Moving Timespan

                                </label>

    

                                <div class='col-12'>

                                    <label>From</label>

                                    <input type='date'>

                                </div>

                                <div class='col-12'>

                                    <label>To</label>

                                    <input type='date'>

                                </div>

                                <!--TODO: If moving Timespan is active-–>-->

                                <!--                    <select class='col-12'>-->

                                <!--                        <option>yesterday</option>-->

                                <!--                        <option>last week</option>-->

                                <!--                        <option>last month</option>-->

                                <!--                        <option>last year</option>-->

                                <!--                        <option>last half year</option>-->

                                <!--                    </select>-->

                            </div>

                            <button class='update col-12'> <i class='fas fa-sync-alt'> </i> Update</button>

                        </div>

                    </div>";

  $code .= "<div class='dropdown'>

                        <button onclick='dropdownFunction(\"filters\")' class='dropbtn'>

                            <h5>Custom Filters 

                                <i class='fas fa-caret-down'></i>

                            </h5> 

                        </button>

                        <div id='filters' class='dropdown-content'>

                            <button class='add' >

                            <i class='fas fa-plus'></i>

                            </button>

                            <div class='custom-filter-group col-12'>

                                <label class='col-11'>Filter:</label>

                                <i class='fas fa-times delete col-1'></i>

                                <div class='col-12'>

                                    <select class='col-12'>

                                        <option>Store Number</option>

                                        <option>Store</option>

                                        <option>Visit Date</option>

                                        <option>Activity</option>

                                    </select>

                                </div>

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

                                <div class='col-12'>

                                    <input type='text' list='value-list' class='col-12'>

                                    <datalist id='value-list'>

                                        <option>Store Number</option>

                                        <option>Store</option>

                                        <option>Visit Date</option>

                                        <option>Activity</option>
                                    </datalist>
                                </div>
                            </div>
				<button class='update col-12'> <i class='fas fa-sync-alt'> </i> Update</button>
			</div>
		</div>";
  $code .= "</div>";
  return $code;
}
      //------------START SUBTASK BLOCK---------------------------------
function actions(){
  $code = "<div class='col-3 actions'>
      <button class='share'>
      	<i class='fas fa-share-alt'></i>
      </button>
      <button class='download'>
      	<i class='fas fa-file-download'></i>
      </button>
      <button class='copy'>
      	<i class='fas fa-copy'></i>
      </button>
		</div>";
  return $code;
}
      //------------START SUBTASK BLOCK---------------------------------
function content(){
  return $this->report->build();
  /*switch($this->type){
    case "TABLE": return $this->contentTable();
    // case "MATRIX": return self::contentMatrix();
    // case "GALLERY": return self::contentGallery();
  }
  throw new exception("[18155-1] Content Type not defined");*/
}

      //------------START SUBTASK BLOCK---------------------------------

      //------------START SUBTASK BLOCK---------------------------------

      //------------START SUBTASK BLOCK---------------------------------

  }
?>
