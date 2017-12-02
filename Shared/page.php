<?php
  include  __DIR__ . "/html/sidebar.php";
  include  __DIR__ . "/js/email.js.php";
  $SHARED = array();
  $SHARED['HTML_includes'] = file_get_contents(__DIR__ . "/html/includes.html");
  $SHARED['HTML_topbar'] = file_get_contents(__DIR__ . "/html/topbar.html");
  $SHARED['CSS'] = "<link rel='stylesheet' href='./Shared/css/topbar.css'>";
  $SHARED['JS'] = "<script src='./Shared/js/topbar.js'></script>";
  $SHARED['CSS'] .= "<link rel='stylesheet' href='./Shared/css/sidebar.css'>";
  $SHARED['JS'] .= "<script src='./Shared/js/sidebar.js'></script>";
  $SHARED['JS'] .= "<script src='./Shared/js/dropdown.js'></script>";
  $SHARED['JS'] .= "<script src='./Shared/js/scrollToPageId.js'></script>";
  $SHARED['JS'] .= $emailJS;
?>