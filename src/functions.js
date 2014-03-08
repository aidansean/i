function start(){
  Get('input_indico_url').value = '' ;
  Get('input_short_url' ).value = prefix + '' ;
  xmlhttp = GetXmlHttpObject() ;
  clip = new ZeroClipboard.Client() ;
  clip.glue( 'copy_button' ) ;
}

function hide_errors(){
  Get('errors').className = 'hidden' ;
}

function show_errors(text){
  Get('errors').className = '' ;
  if(text!='') Get('errors_text').innerHTML = text ;
  Get('errors_minimize').className = 'errors_box' ;
  Get('errors_maximize').className = 'errors_box hidden' ;
  Get('errors_close')   .className = 'errors_box' ;
}

function minimize_errors(){
  Get('errors_text').className = 'hidden' ;
  Get('errors_minimize').className = 'errors_box hidden' ;
  Get('errors_maximize').className = 'errors_box' ;
  Get('errors_close')   .className = 'errors_box' ;
}

function maximize_errors(){
  Get('errors_text').className = '' ;
  Get('errors_maximize').className = 'errors_box hidden' ;
  Get('errors_minimize').className = 'errors_box' ;
  Get('errors_close')   .className = 'errors_box' ;
}

function getShortUrl(){
  if(xmlhttp!=null){
    xmlhttp.onreadystatechange = updateShortUrl ;
    xmlhttp.open("GET", dir + "shorten.php?sid=" + Math.random() + "&url=" + Get('input_indico_url').value , true) ;
    xmlhttp.send(null) ;
  }
}

function updateShortUrl(){
  if(xmlhttp.readyState==4){
    if(xmlhttp.responseText.search('Error: ')!=-1){
       show_errors(xmlhttp.responseText) ;
    }
    else{
      Get('input_short_url').value = prefix + xmlhttp.responseText ;
      clip.setText(prefix + xmlhttp.responseText) ;
    }
  }
}

function make(){
  Get('input_short_url').value = prefix + '' ;
  var url = Get('input_indico_url').value ;
}

function GetXmlHttpObject(){
  if(window.XMLHttpRequest){
    // code for IE7+, Firefox, Chrome, Opera, Safari
    return new XMLHttpRequest() ;
  }
  if(window.ActiveXObject){
    // code for IE6, IE5
    return new ActiveXObject("Microsoft.XMLHTTP") ;
  }
  return null ;
}

function Get(id){ return document.getElementById(id) ; }
