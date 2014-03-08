    <title><?php echo $title ;?></title>
    <div id="outer_container">
      <div id="container">
        <div id="navcontainer">
          <div id="modernbricksmenu">
            <ul>
              <li style="margin-left: 1px" <?php if($title=='i: short for indico') echo ' id="current"'?>><a href="index.php" title="Home">Home</a></li>
              <li<?php if($title=='about i') echo ' id="current"'?>><a href="about.php" title="About">About</a></li>
              <li<?php if($title=='develop i') echo ' id="current"'?>><a href="develop.php" title="Develop">Dev</a></li>
              <li><a href="mailto:aidan@cern.ch" title="Contact">Contact</a></li>
            </ul>
          </div>
          <div id="modernbricksmenuline">&nbsp;</div>
        </div>
  
        <div id="heading">
        <div id="errors">
            <div id="errors_close"    class="errors_box hidden" onclick="hide_errors()"    ></div>
            <div id="errors_minimize" class="errors_box hidden" onclick="minimize_errors()"></div>
            <div id="errors_maximize" class="errors_box hidden" onclick="maximize_errors()"></div>
            <p id="errors_text">Javascript must be enabled for this service to work.<br />Please enable Javascript on your browser.</p>
          </div>
          <script type="text/javascript">Get('errors').className = 'hidden' ;</script>
          <?=$heading;?>
        </div>
        <div id="content">