<?php
$title = 'about i' ;
$heading = '<h1>About <span id="i_name">i</span></h1>' ;
include('data.php') ;
include('head_1.php') ;
?>

  </head>
  <body lang="en">
<?php include('head_2.php') ;?>
          <p>Have you ever been preparing for a meeting and had to load an indico page fast?  What if there's no time to log in to your E-mail and find the link?  Did you just mistype the complete url?  Well no more!  From now on <span class="i">i</span> can help you!</p>
          
          <h3>How does it work?</h3>
          <p><span class="i">i</span> takes an indico url and condenses it into a much shorter url, while still containing enough useful information to navigate to the page or resource quickly.  The shortened urls are written in such a way that they can be read by a human if they know how to interpret the url.  (See the <a href="develop.php">developer page</a> for more information.)</p>
          
          <h3>How do I change the indico domain?</h3>
          <p>At the moment <span class="i">i</span> can only support the following domains:</p>
          <table id="domain_table">
            <thead>
              <tr>
                <th class="domain_table_1">id</th>
                <th class="domain_table_2">Domain</th>
              </tr>
            </thead>
            <tbody>
<?php
for($i=0 ; $i<count($domains) ; $i++){
  $AorB = ($i%2==0) ? 'A' : 'B' ;
  echo '              <tr class="' , $AorB , '">' , PHP_EOL ;
  echo '                <td class="domain_table_1">d' , $i , '</td>' , PHP_EOL ;
  echo '                <td class="domain_table_2"><tt>' , $domains[$i] , '</tt></td>' , PHP_EOL ;
  echo '              </tr>' , PHP_EOL ;
}
?>
            </tbody>
          </table>
          <p>By default it picks the first domain, the CERN domain with a secure connection.  If you would like to see support for another domain, get in touch and it will be added so that <span class="i">i</span> can support it.  If the user specified the domain in the url then it wouldn't not shorten the url by much!</p>
          
          <h3>Do I have to enable Javascript?</h3>
          <p>No, you do not need to enable Javascript!  You can use the service directly by pass the url like this:</p>
          <p><tt><?php echo $prefix ;?>shorten.php?url=&lt;indico url&gt;</tt></p>
          <p>If you provide a valid indico url then you should receive a valid short url.</p>
          
          <h3>Do I have to use flash?</h3>
          <p>The front end uses a flash object called ZeroClipboard to allow you to copy the short url with a single click.  This is not necessary, it just saves you a second or so.</p>
          
          <h3>How did this all start?</h3>
          <p>One weekend in 2012 A<span class="i">i</span>dan decided it was time that indico had a url shortening service.  He doesn't have anything to do with the development of indico, and he is very grateful to the indico team and loves their services.  It's just that it was missing one obvious addition, so he wrote this page.</p>
          
          <h3>Something doesn't work!</h3>
          <p><span class="i">i</span> is currently in release alpha, meaning that it still needs some testing.  If you find a problem please contact <tt>aidan@cern.ch</tt> to report a bug.  He'll do his best to fix it when he gets time.  If you can think of any ways to improve the service or make it more user friendly, please get in touch.  There are no guarantees that the service will work properly at the moment.</p>
          
<?php include('foot.php') ; ?>
