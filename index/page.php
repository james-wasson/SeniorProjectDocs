<?php
  $filepath = realpath(dirname(__FILE__));
  $HEAD = file_get_contents("$filepath/html/head.html");
  $BODY = file_get_contents("$filepath/html/body.html");
if (empty($BODY)) {
  $BODY = "AHHH";
}
?>