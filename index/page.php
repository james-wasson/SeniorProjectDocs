<?php
  $filepath = realpath(dirname(__FILE__));
  $CONTENT = array();
  $CONTENT['BODY'] = file_get_contents("$filepath/html/body.html");
  $CONTENT['HEAD'] = file_get_contents("$filepath/html/includes.html");
  $CONTENT['HEAD'] .= "<script src='./index/js/github.js'></script>";
  $CONTENT['HEAD'] .= "<script src='./index/js/tree.js'></script>";
  $CONTENT['HEAD'] .= "<script src='./index/js/takeRoom.js'></script>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./index/css/github.css'>";
  $CONTENT['HEAD'] .= "<link rel='stylesheet' href='./index/css/content.css'>";
?>