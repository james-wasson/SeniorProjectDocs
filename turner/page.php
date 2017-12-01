<?php
  $CONTENT = array();
  $CONTENT['HEAD'] = file_get_contents(__DIR__."/html/includes.html");
  $CONTENT['HEAD'] .= "<script src='./turner/js/pdf.js'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./turner/css/dropdown.css'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./turner/css/dropContent.css'></script>";
  $CONTENT['BODY'] = file_get_contents(__DIR__."/html/body.html");
  $CONTENT['EMAIL'] = "geturner@siu.edu"
?>