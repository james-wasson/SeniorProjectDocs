<?php
  $filepath = realpath(dirname(__FILE__));
  array_push($BODY, file_get_contents("$filepath/html/body.html"));
?>