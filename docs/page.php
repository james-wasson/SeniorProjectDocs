<?php
  $topicHeadings = array(
  array(
    "title" => "h1",
    "id" => "123"
  ),
  array(
    "title" => "Hello Sunshine in the rain",
    "id" => "1234"
  ),
  array(
    "title" => "12345",
    "id" => "12345"
  ),
  array(
    "title" => "Adam Test ##2",
    "id" => "123456"
  )
  );
  include __DIR__."/html/sidebar.php";
  include __DIR__."/html/content.php";
  $CONTENT = array();
  $CONTENT['HEAD'] = "<link rel='stylesheet' href='/docs/css/content.css'>";
  // this function sets the content as well as cleans the id list and returns a formatted string
  // always run this before running getSidebarLinks
  $CONTENT['BODY'] = getContentById($topicHeadings);
  $CONTENT['HTML_sidebar'] = getSidebarLinks($topicHeadings);
?>