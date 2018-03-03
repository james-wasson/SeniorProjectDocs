<?php
  $CONTENT = array();
  $CONTENT['HEAD'] = "<link rel='stylesheet' href='./design/css/iframe.css'></link>";
  $CONTENT['HEAD'] .= "<script src='./design/js/iframe.js'></script>";
  $CONTENT['BODY'] = file_get_contents(__DIR__."/html/body.html");
?>