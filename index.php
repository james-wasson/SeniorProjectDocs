<?php
$pageName = "./index";
include "$pageName/page.php";
echo 
"<html>
  <head>";
if(!empty($HEAD))
  echo $HEAD;
echo 
" </head>
  <body>";
if(!empty($BODY))
  echo $BODY;
echo
" </body>
</html>";
?>