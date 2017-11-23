<?php
  function dispSidebar($CONTENT){
      echo "<nav class='sidebar'>
      <div class='sidebar-container'>
        <a href='index.php?pageName=index' class='navbar-brand sidebar-brand'>
          <div class='navbar-brand-main'>AlphaNow</div>
          <div class='navbar-brand-secondary'>Software Soltions</div>
        </a> 
        <div class='container top-sidebar sidebar-content'>
          <ul class='list-group'>";
    if (!empty($CONTENT['HTML_sidebar']))
      echo $CONTENT['HTML_sidebar'];
    echo "</ul>
        </div>
        <div class='container bottom-sidebar'>
          <a href='index.php?pageName=index'><h4><span class='fa fa-home' aria-hidden='true'></span> Home</h4></a>
          <a onclick='scrollToPageId(\"topbar\")' style='cursor:pointer;'><h4><span class='fa fa-arrow-up' aria-hidden='true'></span> Back to the Top</h4></a>
        </div>
      </div>
    </nav>";
  }
?>