<?php
$title = 'develop i' ;
$heading = '<h1>Develop <span id="i_name">i</span></h1>' ;
include('data.php') ;
include('head_1.php') ;
?>

  </head>
  <body lang="en">
<?php include('head_2.php') ;?>
          <p>If you would like to help develop <span class="i">i</span>, or host your own <span class="i">i</span> service then this page will show you how!</p>
          
          <h2>How to get the code</h2>
          <p>The code is written in PHP, and it is available on the CERN SVN repositories (link to be added soon!)  You can check it out and see the inner workings to better understand how <span class="i">i</span> works.  urls are rewritten using <tt>web.config</tt> on the CERN DFS servers (running Windows), and using <tt>.htaccess</tt> on apache servers.  It has been tested in both these environments.</p>
          
          <h2>Files in the package</h2>
          <p>The package contains a variety of different files.  Most of the work is done with PHP scripts.  Since PHP has a reputation for security vulnerabilities, <span class="i">i</span> does not use any databases, and it does not write anything to disk.  Developers wishing to use databases or write access to disk are strongly recommended to pay special attention to prevent hacking and SQL injection attacks.</p>
          
          <p>When the user types in a long url to be shortened the page sends a request via AJAX.  This ensures that the processing the url is the same for all users, so it is performed server side.  This also allows to use the service directly, without using the webpage.  The package includes a copy of <a href="http://code.google.com/p/zeroclipboard/">ZeroClipboard</a> to make the copying of the shortened url easier.  ZeroClipboard uses a flash object to achieve single click copying, but it is not necessary for the user to enable flash.</p>
          
          <p>The <tt>web.config</tt> and <tt>.htaccess</tt> files are included, and they match three different regex strings.</p>
          
          <p>The rest of the files include javascript source files, the CSS style sheet, some small graphics and PHP pages for the frontend.</p>
          
          <h2>Parsing short urls</h2>
          <p>The full regex for matching the short urls (in order of precedence) in <tt>web.config</tt> or <tt>.htaccess</tt> are given below:
          <table id="url_table">
            <thead>
              <tr>
                <th class="url_table_4">Type of url</th>
                <th class="url_table_5">regex</th>
              </tr>
            </thead>
            <tbody>
              <tr class="A">
                <td class="url_table_1">Category of meetings</td>
                <td class="url_table_2"><tt>web.config</tt>: <tt>^[C]([0-9]*)(?:[D]([0-9]*))?$</tt><br /><tt>.htaccess</tt>: <tt>(^[cC]([0-9]*))</tt></td>
              </tr>
              <tr class="B">
                <td class="url_table_1">Meeting contribution</td>
                <td class="url_table_2"><tt>web.config</tt>: <tt>^([0-9]*)(?:[D]([0-9]*))?([CMRS][A-Z0-9]*)([CMRS][A-Z0-9]*)?([CMRS][A-Z0-9]*)?([CMRS][A-Z0-9]*)?$</tt><br /><tt>.htaccess</tt>: <tt>(^([0-9]+))</tt></td>
              </tr>
              <tr class="A">
                <td class="url_table_1">Single meeting</td>
                <td class="url_table_2"><tt>web.config</tt>: <tt>^([0-9]*)(?:[D]([0-9]*))?$<br /><tt>.htaccess</tt>: <tt>(^([0-9]+))</tt></td>
              </tr>
            </tbody>
          </table>
          
          <p>In <tt>web.config</tt> the matches are case insensitive.</p>
          
          <p>The short relative url is then passed as a string to <tt>process.php</tt> (via the <tt>$_GET</tt> variable) where it gets parsed.  The first step is to convert the string to upper case to make matching simpler.  The string is first matched against the regular expressions <tt>/^[C]([0-9]+)(?:[D]([0-9]*))?$/</tt> (category page), <tt>'/^([0-9]*)(?:[D]([0-9]*))?$/'</tt> (meeting page), and <tt>/^([0-9]*)(?:[D]([0-9]*))?([CMRS])/</tt> (meeting contribution), in order of precedence.  If the string is successfully parsed the client gets redirected to the relevant indico page.  If the string is not successfully parsed the client receives an error message, and then the scripts calls <tt>exit()</tt>.</p>
          
          <h3>Domain argument</h3>
          <p><span class="i">i</span> supports multiple domains, and the domain is specified using the domain argument, <tt>([dD][0-9]*)?</tt>.  If no domain is specified then <span class="i">i</span> chooses the first domain, <tt><?php echo $domains[0] ; ?></tt>.  The domain argument is an optional argument that can specified in any of the short url forms.</p>
          
          <h3>Short category urls</h3>
          <p>The short url for a meeting category starts with the letter "c", followed by the category number.  This is an unfortunate choice of letter, but it is one which is easier for users to remember.  The domain argument may be added to the end of the short url.</p>
          
          <h3>Short meeting urls</h3>
          <p>The short url for a meeting is simply the meeting id.  It is expected that this will be the most used part of the service.  The domain argument may be added to the end of the short url.</p>
          
          <h3>Short meeting contribution urls</h3>
          <p>The short url for a meeting contribution is the most complex string to match.  It consists of the meeting id, followed by arguments specifying the material id, the resource id, the domain id (if needed), and the contribution or session id, as appropriate.  With the exception of the material id, each parameter is specified with a number.  The domain argument may be added at any point in the short url, as long as it follows the meeting id.</p>
          
          <p>The following regular expressions are used to match the various parameters:</p>
          
          <table id="parameter_table">
            <thead>
              <tr>
                <th class="parameter_table_1">Short url parameter</th>
                <th class="parameter_table_2">Regular expression</th>
              </tr>
            </thead>
            <tbody>
              <tr class="A">
                <td class="parameter_table_1"><tt>contribId</tt> (contribution id)</td>
                <td class="parameter_table_2"><tt>'/[C]([0-9]*)/'</tt></td>
              </tr>
              <tr class="B">
                <td class="parameter_table_1">domainId (Not an indico argument)</td>
                <td class="parameter_table_2"><tt>'/[D]([0-9]*)/'</tt></td>
              </tr>
              <tr class="A">
                <td class="parameter_table_1"><tt>materialId</tt> (material id)</td>
                <td class="parameter_table_2"><tt>/[M]([A-Z]|[0-9]*)/</tt></td>
              </tr>
              <tr class="B">
                <td class="parameter_table_1"><tt>resId</tt> (resource id)</th>
                <td class="parameter_table_2"><tt>'/[R]([0-9]*)/'</tt></th>
              </tr>
              <tr class="A">
                <td class="parameter_table_1"><tt>sessionId</tt> (session id)</td>
                <td class="parameter_table_2"><tt>'/[S]([0-9]*)/'</tt></td>
              </tr>
            </tbody>
          </table>
          
          <p>If more than one instance of a parameter is specified (which should not happen!) the first successful match is used.  If a parameter is not specified it gets the value <tt>-1</tt> and is not used when constructing the indico url.</p>
          
          <p>The material id needs special attention because in an indico meeting page it can be referred to by a string or a number, and in some cases it is impossible to match a number to a string.  To overcome this problem each of the strings is matched to a single letter code.  The letters C, D, M, R, S are excluded from the list to prevent collisions with parameter names in the short url.  This leaves eight spaces for future material ids.  If the indico page specifies a numerical material id then this gets specified in the short url.</p>
          
          <p>The material id lookup table is:</p>
          <table id="material_table">
            <thead>
              <tr>
                <th class="material_table_1">Key</th>
                <th class="material_table_2">Material id string</th>
              </tr>
            </thead>
            <tbody>
<?php
$keys = array_keys($materials) ;
for($i=0 ; $i<count($keys) ; $i++){
  $AorB = ($i%2==0) ? 'A' : 'B' ;
  echo '              <tr class="' , $AorB , '">' , PHP_EOL ;
  echo '                <td class="material_table_1">' , $keys[$i] , '</td>' , PHP_EOL ;
  echo '                <td class="material_table_2"><tt>' , $materials[$keys[$i]] , '</tt></td>' , PHP_EOL ;
  echo '              </tr>' , PHP_EOL ;
}
?>
            </tbody>
          </table>
          
<?php include('foot.php') ; ?>
