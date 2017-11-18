<?php
  $filepath = realpath(dirname(__FILE__));
  $SHARED = array(); 
  $SHARED['includes.html'] = file_get_contents("$filepath/html/includes.html");
?>