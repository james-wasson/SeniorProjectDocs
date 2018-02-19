<?php
  $CONTENT = array();
  $CONTENT['HEAD'] = file_get_contents(__DIR__."/html/includes.html");
  $CONTENT['HEAD'] .= "<script src='./wasson/js/pdf.js'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./wasson/css/dropdown.css'></link>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./wasson/css/dropContent.css'></link>";
  $CONTENT['BODY'] = file_get_contents(__DIR__."/html/body.html");
  $CONTENT['EMAIL'] = "jameswasson1@gmail.com"
?>