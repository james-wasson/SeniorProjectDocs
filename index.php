<?php
// start the session if not already
if (!session_id()){
  session_start();
}
// gets the page name from the url
$pageName = "";
if (is_null($_GET["pageName"]))
  $pageName = "index";
else
  $pageName = $_GET["pageName"];
$_SESSION['CURR_PAGE'] = $pageName;
// this sets the inclues path to here
include_once __DIR__ . "/Shared/page.php";
include_once __DIR__ . "/$pageName/page.php";
echo 
"<html>
  <head>";
if (!empty($SHARED['HTML_includes']))
  echo $SHARED['HTML_includes'];
if (!empty($SHARED['JS']))
  echo $SHARED['JS'];
if (!empty($SHARED['CSS']))
  echo $SHARED['CSS'];
if (!empty($CONTENT['HEAD']))
  echo $CONTENT['HEAD'];
echo 
"</head>
  <body>";
if (!empty($SHARED['HTML_topbar']))
  echo $SHARED['HTML_topbar'];
echo "<div id='content' class='container'>";
if(!empty($CONTENT['BODY']))
  echo $CONTENT['BODY'];
echo "</div>";
echo dispSidebar($CONTENT);
echo
" </body>
</html>";
?>