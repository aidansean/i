<?php

include('data.php') ;

$raw_url = $_GET['url'] ;
$url = $raw_url ;
$errors = array() ;

// Check for https:// or http:// at start of string
if(!preg_match('/[http][s]?\:\/\//', $url)){
  $success = false ;
  foreach($domains as $d){
    if(starts_with($d, 'https://' . $url)){
      $url = 'https://' . $url ;
      $success = true ;
      break ;
    }
    else if(starts_with($d, 'http://' . $url)){
      $url = 'http://' . $url ;
      $success = true ;
      break ;
    }
  }
  if($success==false){
    $errors[] = 'Sorry, i could not match the domain you entered.' ;
    $errors[] = 'i tried really hard to match it!' ;
    $errors[] = 'The following domains are currently supported:' ;
    foreach($domains as $d){
      $errors[] = '<tt>  ' . $d . '</tt>' ;
    }
    $errors[] = 'You entered the url: <tt>' . $raw_url . '</tt>' ;
    error_page() ;
  } 
}

// Get the domain
$domainId = -1 ;
for($i=0 ; $i<count($domains) ; $i++){
  if(starts_with($domains[$i], $url)){
    $domainId = $i ;
    break ;
  }
}
//echo $domainId ;

// Look for the easy and most used option first, a single meeting page
// https://indico.cern.ch/conferenceDisplay.py?confId=199304
if(substr_count($url, 'conferenceDisplay.py')){
  preg_match('/confId=([0-9]*)/', $url, $matches) ;
  $confId = $matches[1] ;
  $output = $confId ;
  if($domainId!=0) $output = $output . 'd' . $domainId ;
  echo $output ;
}

// Next look for a category page
// https://indico.cern.ch/categoryDisplay.py?categId=664
if(substr_count($url, 'categoryDisplay.py')){
  preg_match('/categId=([0-9]*)/', $url, $matches) ;
  $categId = $matches[1] ;
  $output = 'c' . $categId ;
  if($domainId!=0) $output = $output . 'd' . $domainId ;
  echo $output ;
}

// Okay, so now we have a contribution.  This could get tricky
// https://indico.cern.ch/getFile.py/access?contribId=1&resId=0&materialId=slides&confId=199297
if(substr_count($url, 'getFile.py')){
  // We can use the magic of $_GET to neatly separate out all these arguments for us!
  $var_names = array('confId' , 'contribId' , 'sessionId' , 'resId' , 'materialId') ;
  foreach($var_names as $name){
    $url_vars[$name] = (isset($_GET[$name]) ) ? $_GET[$name] : -1 ;
  }
  
  // Now we need to catch the variable that sits after the ? in $url
  preg_match('/\?([A-Za-z]*)=([0-9]*)/', $url, $matches) ;
  if(count($matches)>0) $url_vars[$matches[1]] = $matches[2] ;
  
  // materialId needs some special attention
  if(!is_numeric($url_vars['materialId'])){
    $materialType = strtolower($url_vars['materialId']) ;
    foreach(array_keys($materials) as $key){
      if($materials[$key]==$materialType){
        $url_vars['materialId'] = $key ;
        break ;
      }
    }
  }
  
  // Check confId!
  if($url_vars['confId']==-1){
    $errors[] = 'Sorry, i could not find a confId in that url!' ;
    $errors[] = 'You tried the url: <tt>' . $url . '</tt>' ;
    error_page() ;
  }
  
  $output = $url_vars['confId'] ;
  foreach(array_keys($url_vars) as $key){
    if($key=='confId') continue ;
    if($url_vars[$key]!=-1) $output = $output . substr($key, 0, 1) . $url_vars[$key] ;
  }
  echo $output ;
}

function starts_with($start, $string){ return substr($string, 0, strlen($start))==$start ; }

function error_page(){
  global $errors ;
  $text = 'Error: ' ;
  for($i=0 ; $i<count($errors) ; $i++){
    if($i!=0) $text = $text . '<br />' . PHP_EOL ;
    $text = $text . $errors[$i] ;
  }
  echo $text ;
  exit() ;
}

?>
