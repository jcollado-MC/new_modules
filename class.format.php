<?php
  // Script created with CFB Framework Builder 
  // Client:  MARKET CONTROL
  // Project: MASTER I
  // Class Revision: 1
  // Date of creation: 2020-07-27 
  // All Copyrights reserved 
  // This is a class file and can not be executed directly 
  // CLASS FILE
    if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){ 
      header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
      exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
    }
    class FORMAT{
//[SUBTASKS]
//SUBTASK 17492: "DATE" --------------------------------------------
static function date($date){
  return cfr_formatdate($date);
}
//SUBTASK 17473: "MINUTES" --------------------------------------------
function minutes($val){
	global $myPageBody;
	$val = round($val);
  $hours = floor($val/60);
  $min = ($val - ($hours*60));
  $time = str_pad($hours, 2, 0, STR_PAD_LEFT).":".str_pad($min, 2, 0, STR_PAD_LEFT);
  // $myPageBody .= "$val => $time<br>";
  return $time;
}

//SUBTASK 17601: "DECODE" --------------------------------------------
static function decode($text, $utf8_decode=false){
  global $myPageBody;
  // https://stackoverflow.com/questions/4407854/how-do-i-detect-if-have-to-apply-utf-8-decode-or-encode-on-a-string
  for($n=1;$n<=100;$n++){
    if($text == html_entity_decode($text)) break;
    $text = html_entity_decode($text);
  }
  if(preg_match('!!u', $string)){   // This is UTF-8
    // if(!$returnUTF) 
    if($utf8_decode)$text = utf8_decode($text);	
  }else{
    // if($returnUTF) $text = utf8_encode($text);
  }
  return $text;
}
//SUBTASK 17447: "FILESIZE" --------------------------------------------
static function filesize($bytes, $precision = 2) {
  if($bytes==0) return '';
  $unit = ["B", "KB", "MB", "GB"];
  $exp = floor(log($bytes, 1024)) | 0;
  if($exp<2) $precision=0;
  return round($bytes / (pow(1024, $exp)), $precision).$unit[$exp];
}
//[/SUBTASKS]
  }
?>
