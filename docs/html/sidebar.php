<?php
  function getSidebarLinks($headings) {
    $returnString = "";
    foreach ($headings as $h) {
      $title = $h['title'];
      $id = $h['id'];
      $returnString .= "<li class='list-group-item' onclick=\"scrollToPageId('$id')\">
                            <span class='sidebar-title'>$title</span> 
                            <div class='sidebar-pointers'>
                              <span class='fa fa-chevron-right'></span><span class='fa fa-chevron-right'></span>
                            </div>
                        </li>";
    }
    return $returnString;
  }
?>