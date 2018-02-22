<?php
  $CONTENT = array();
  $CONTENT['HEAD'] = "<link rel='stylesheet' href='./plan/css/iframe.css'></link>";
  $CONTENT['HEAD'] .= "<script src='./plan/js/iframe.js'></script>";
  $CONTENT['BODY'] = file_get_contents(__DIR__."/html/body.html");
?>