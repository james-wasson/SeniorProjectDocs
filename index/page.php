<?php
  
  $HEAD = file_get_contents("./html/head.html");
  $BODY = file_get_contents("./html/body.html");
if (empty($BODY)) {
  $BODY = realpath(dirname(__FILE__));
}
?>