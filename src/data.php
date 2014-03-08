<?php

// This file contains common data for all the various scripts

$prefix = 'http://www.aidansean.com/indigo/' ;

// Exhaustive list of supported domain names
$default_domain_index = 0 ;
$domains = array() ;
$domains[0] = 'https://indico.cern.ch' ;
$domains[1] = 'http://indico.cern.ch'  ;

// Exhaustive list of supported material types
// In some meetings they are referred to by number
// This tool supports both
$materials = array() ;
$materials['A'] = 'agenda'           ;
$materials['B'] = 'document'         ;
$materials['E'] = 'drawings'         ;
$materials['F'] = 'list of actions'  ;
$materials['G'] = 'live broadcast'   ;
$materials['H'] = 'minutes'          ;
$materials['I'] = 'more information' ;
$materials['J'] = 'paper'            ;
$materials['K'] = 'pictures'         ;
$materials['L'] = 'poster'           ;
$materials['N'] = 'proceedings'      ;
$materials['O'] = 'slides'           ;
$materials['P'] = 'text'             ;
$materials['Q'] = 'video'            ;

?>