<?php
$filepath = realpath(dirname(__FILE__));
global _SHARED_PATH_ = "$filepath/Shared/page.php";
require _SHARED_PATH_;
$pageName = "./index";
require "$filepath/$pageName/page.php";
echo 
"<html>
  <head>";
if (!empty($SHARED['includes.html']))
  echo $SHARED['includes.html'];
if (!empty($HEAD)) {
  echo $HEAD;
}
echo 
" </head>
  <body>";
if (!empty($BODY)) {
  echo $HEAD;
}
echo
" </body>
</html>";
?>