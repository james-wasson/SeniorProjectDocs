<?php
$BODY = "";
$HEAD = "";
require "Shared/page.php";
$pageName = "./index";
require "$pageName/page.php";
echo 
"<html>
  <head>";
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