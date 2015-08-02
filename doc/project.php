<?php
include_once($_SERVER['FILE_PREFIX']."/project_list/project_object.php") ;
$github_uri   = "https://github.com/aidansean/indigo" ;
$blogpost_uri = "http://aidansean.com/projects/?tag=indigo" ;
$project = new project_object("indigo", "i, short for indico", "https://github.com/aidansean/indigo", "http://aidansean.com/projects/?tag=indigo", "indigo/images/project.jpg", "indigo/images/project_bw.jpg", "At CERN we used a meeting orgnisation system called indico.  Each meeting had a unique ID that was used to identify the resourcs associated with it.  In many instances there were times when a person had to access a meeting page when they only knew the unique id, and not the full uri.  I made this tool to obtain the full uri, given only the meeting id.  Since this project shortens the uri for indico it is called \"\(i\)\", which leads to all kinds of puns.", "Physics,Tools", "AJAX,CSS,HTML,JavaScript,PHP,ZeroClipboard") ;
?>