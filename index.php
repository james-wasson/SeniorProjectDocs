<?php
// this sets the inclues path to here
$pageName = "index";
include_once __DIR__ . "/Shared/page.php";
include_once __DIR__ . "/$pageName/page.php";
echo 
"<html>
  <head>";
if (!empty($SHARED['CSS_topbar']))
  echo $SHARED['CSS_topbar'];
if (!empty($SHARED['HTML_includes']))
  echo $SHARED['HTML_includes'];
if (!empty($CONTENT['HEAD']))
  echo $CONTENT['HEAD'];
echo 
" </head>
  <body>";
if (!empty($SHARED['HTML_topbar']))
  echo $SHARED['HTML_topbar'];
if(!empty($CONTENT['BODY']))
  echo $CONTENT['BODY'];
echo
" </body>
</html>";
?>