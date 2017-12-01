<?php
  $topicHeadings = array(
    "h1",
    "Hello Sunshine in the rain",
    "12345",
    "Adam Test ##2",
  );
  include __DIR__."/html/sidebar.php";
  include __DIR__."/html/content.php";
  $CONTENT = array();
  $CONTENT['HEAD'] = "<link rel='stylesheet' href='./docs/css/content.css'>";
  // this function sets the content as well as cleans the id list and returns a formatted string
  // always run this before running getSidebarLinks
  $CONTENT['BODY'] = getContentById($topicHeadings);
  $CONTENT['HTML_sidebar'] = getSidebarLinks($topicHeadings);
?>