<?php
$title = 'i: short for indico' ;
$heading = '<h1><span id="i_name">i </span> for indico</h1>' ;
include('head_1.php') ;
?>
    <script type="text/javascript">
      var xmlhttp = 0 ;
      var clip = 0 ;
      
      var prefix = 'cern.ch/i/' ;
      var long_prefix = 'http://www.cern.ch/i/' ;
      var dir = '<?=$_SERVER['HTTP_PREFIX'];?>/i/' ;
      
      prefix = 'aidansean.com/indigo/' ;
      long_prefix = 'http://www.aidansean.com/indigo/' ;
      dir = '' ;
    </script>
    <script type="text/javascript" src="ZeroClipboard.js"></script>
  </head>
  <body lang="en" onload="start()">
<?php include('head_2.php') ;?>
          <p class="description">This is a simple service that allows you to shorten indico urls.  Simply enter the indico url in the box below and click on 'Shorten url' to get a cleaner, shorter url.</p>
  
          <table>
            <tbody>
              <tr>
                <th class="urls">Indico url:</th>
                <td class="input"><input id="input_indico_url" class="input_url" value="" name="indico_url"/></td>
                <td class="button"><input class="button" type="submit" value="Shorten url" onclick="getShortUrl()"/></td>
              </tr>
              <tr>
                <th class="urls">Short url:</th>
                <td class="input"><input id="input_short_url" class="input_url" value="" name="short_url"/></td>
                <td class="button"><input class="button" type="submit" value="Copy url" id="copy_button" onclick="alert('You need to enable flash to use this feature.')"/></td>
              </tr>
            </tbody>
          </table>
<?php include('foot.php') ; ?>
