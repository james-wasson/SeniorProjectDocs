<?php
  $filepath = realpath(dirname(__FILE__));
  $CONTENT = array();
  $CONTENT['BODY'] = file_get_contents("$filepath/html/body.html");
?>