<?php
  $SHARED = array(); 
  $SHARED['HTML_includes'] = file_get_contents(__DIR__ . "/html/includes.html");
  $SHARED['HTML_topbar'] = file_get_contents(__DIR__ . "/html/topbar.html");
  $SHARED['CSS_topbar'] = "<link rel='stylesheet' href='./Shared/css/topbar.css'>";
?>