<?php
$BODY = array();
$HEAD = array();
include "Shared/page.php";
$pageName = "./index";
include "$pageName/page.php";
echo 
"<html>
  <head>";
foreach $HEAD as $h{
  echo $h;
}
" </head>
  <body>";
foreach $BODY as $b{
  echo $b;
}
echo
" </body>
</html>";
?>