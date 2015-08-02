<?php

include('data.php') ;

// Do we need to escape anything?  Probably not...
$args = strtoupper($_GET['q']) ;

// Array of error messages in case we need to make an error page
$errors = array() ;

// Debug mode
$debug = false ;
if(isset($_GET['debug'])){
  if($_GET['debug']) $debug = true ;
}

if($debug){
  echo '<pre>' , PHP_EOL ;
  echo 'args = ' , $args , PHP_EOL ;
  echo $master_regex , PHP_EOL ;
  print_r($_GET) ;
}
//$debug = true ;

// First look for category
$regex_category     = '/^[C]([0-9]+)(?:[D]([0-9]*))?$/'     ;
$regex_meeting      = '/^([0-9]*)(?:[D]([0-9]*))?$/'        ;
$regex_contribution = '/^([0-9]*)(?:[D]([0-9]*))?([CMRS])/' ;
if(preg_match_all($regex_category, $args, $matches)){
  print_r($matches) ;
  $cateId = $matches[1][0] ;
  $domainId = ($matches[2][0]!='') ? $matches[2][0] : 0 ;
  if($domainId>=count($domains)){
    $error[] = 'Error: cannot find domain with index ' . $domainId ;
    error_page() ;
  }
  $url = $domains[$domainId] . '/categoryDisplay.py?categId=' . $cateId . '' ;
  if($debug) echo '<h1><a href="' , $url , '">' , $url , '</a></h1>' ;
  header('Location: ' . $url) ;
}

// Look for contribution
else if(preg_match_all($regex_contribution, $args, $matches)){
  if($debug){
    echo 'A contribution has been specified!' , PHP_EOL ;
    print_r($matches) ;
  }
  $confId = $matches[1][0] ;
  
  // Get parameters
  preg_match('/[S]([0-9]*)/'      , $args,  $session_results) ;
  preg_match('/[C]([0-9]*)/'      , $args,  $contrib_results) ;
  preg_match('/[R]([0-9]*)/'      , $args,      $res_results) ;
  preg_match('/[M]([A-Z]|[0-9]*)/', $args, $material_results) ;
  preg_match('/[D]([0-9]*)/'      , $args,   $domain_results) ;
  
  $contribId  = (count( $contrib_results)>0) ?  $contrib_results[1] : -1 ;
  $sessionId  = (count( $session_results)>0) ?  $session_results[1] : -1 ;
  $resId      = (count(     $res_results)>0) ?      $res_results[1] : -1 ;
  $materialId = (count($material_results)>0) ? $material_results[1] : -1 ;
  $domainId   = (count(  $domain_results)>0) ?   $domain_results[1] :  0 ;
  
  if($domainId>=count($domains)){
    $errors[] = 'Error: cannot find domain with index ' . $domainId ;
    error_page() ;
  }
  
  // Push into an array
  $url_args = array() ;
  if( $sessionId!=-1) $url_args['sessionId'] = $sessionId ;
  if( $contribId!=-1) $url_args['contribId'] = $contribId ;
  if(     $resId!=-1) $url_args[    'resId'] =     $resId ;
  // materialId needs some special attention
  if($materialId!=-1){
    if(!is_numeric($materialId)){
      $materialId = $materials[strtoupper($materialId)] ;
    }
    $url_args['materialId'] = $materialId ;
  }
  
  $url = $domains[$domainId] . '/getFile.py/access?confId=' . $confId . '' ;
  foreach(array_keys($url_args) as $key){
    $url = $url . '&' . $key . '=' . $url_args[$key] ;
  }
  if($debug) echo '<h1><a href="' , $url , '">' , $url , '</a></h1>' ;
  header('Location: ' . $url) ;
}

// Look for meeting with no contribution specification
else if(preg_match_all($regex_meeting, $args, $matches)){
  print_r($matches) ;
  $confId = $matches[1][0] ;
  $domainId = ($matches[2][0]!='') ? $matches[2][0] : 0 ;
  if($domainId>=count($domains)){
    $errors[] = 'Error: cannot find domain with index ' . $domainId ;
    error_page() ;
  }
  $url = $domains[$domainId] . '/conferenceDisplay.py?confId=' . $confId . '' ;
  if($debug) echo '<h1><a href="' , $url , '">' , $url , '</a></h1>' ;
  header('Location: ' . $url) ;
}

function error_page(){
  global $errors ;
  echo '<ul>' , PHP_EOL ;
  foreach($errors as $e){
    echo '  <li>' , $e , '</li>' , PHP_EOL ;
  }
  echo '</ul>' , PHP_EOL ;
  exit() ;
}

?>
