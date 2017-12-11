<?php
  function getSidebarLinks($headings) {
    $returnString = "";
    foreach ($headings as $majorH => $minorHeadings) {
      $majorIndex = array_search($majorH ,array_keys($headings));
      // display the major heading
      $returnString .= getMajorSidebarItem($majorH, $majorIndex);
      // display the inner content for the major heading
      foreach ($minorHeadings as $minorIndex => $minorH) {
        $returnString .= getMinorSidebarItem($minorH, $majorIndex .'-'. $minorIndex);
      }
    }
    return $returnString;
  }

  function getMinorSidebarItem($title, $id) {
    return "<li class='list-group-item sidebar-minor-item' onclick=\"scrollToPageId('content-$id')\">
        <span class='sidebar-title'>$title</span> 
        <div class='sidebar-pointers'>
          <span class='fa fa-chevron-right'></span><span class='fa fa-chevron-right'></span>
        </div>
    </li>";
  }

  function getMajorSidebarItem($title, $id) {
    return "<li class='list-group-item sidebar-major-item' onclick=\"scrollToPageId('content-$id')\">
        <span class='sidebar-title'>$title</span> 
        <div class='sidebar-pointers'>
          <span class='fa fa-chevron-right'></span><span class='fa fa-chevron-right'></span>
        </div>
    </li>";
  }
?>