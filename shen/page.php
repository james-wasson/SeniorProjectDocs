<?php
  $CONTENT = array();
  $CONTENT['HEAD'] = file_get_contents(__DIR__."/html/includes.html");
  $CONTENT['HEAD'] .= "<script src='./shen/js/pdf.js'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./shen/css/dropdown.css'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./shen/css/dropContent.css'></script>";
  $CONTENT['BODY'] = file_get_contents(__DIR__."/html/body.html");
  $CONTENT['EMAIL'] = "yaozong.shen@siu.edu"
?>