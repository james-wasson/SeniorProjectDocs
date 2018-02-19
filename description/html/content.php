<?php
  $DOC_PAGE_CONTENT;
  function getContentById(&$headings) {
    $displayedContent = "";
    foreach ($headings as $majorH => $minorHeadings) {
      $majorIndex = array_search($majorH ,array_keys($headings));
      if (!is_null($minorHeadings)) {
        // display the major heading
        $displayedContent .= "<div class='container'>";
        $majorContent = array();
        $majorContent['title'] = $majorH;
        $majorContent['id'] = $majorIndex;
        $displayedContent .= formatMajorContent($majorContent);
        // display the inner content for the major heading
        foreach ($minorHeadings as $minorIndex => $minorH) {
          $minorContent = array();
          $minorContent['content'] = getUnrefinedDocumentContent($minorH);
          if (!is_null($minorContent['content'])) {
            $minorContent['title'] = $minorH;
            $minorContent['id'] = $majorIndex . '-' . $minorIndex;
            $displayedContent .= formatMinorContent($minorContent);
          } else {
            unset($headings[$majorH][$minorIndex]);
          }
        }
        $displayedContent .= "</div>";
      } else {
        unset($headings[$majorH]);
      }
    }
    return $displayedContent;
  }

  function formatMajorContent($h) {
    $returnStr = "";
    $id = $h['id'];
    $title = $h['title'];
    return "<div class='row major-row'>
    <div class='section center container' id='content-$id'>
        <div class='row'>
          <div class='heading major-heading col'>
            <span class='major-title'>$title</span>
            <hr>
          </div>
        </div>
    </div>
    </div>";
  }

  function formatMinorContent($h) {
    $returnStr = "";
    $content = $h['content'];
    $id = $h['id'];
    $title = $h['title'];
    $text = $h['content'][0]['text'];
    $version = $h['content'][0]['version'];
    $returnStr .= "<div class='row minor-row'>
    <div class='section center container' id='content-$id'>
        <div class='row'>
          <div class='heading minor-heading col'>
            <div class='container'>
            <div class='row'>
              <div class='minor-title col-md-8'>$title</div>
              <div class='current-version col-md-4'>Version: $version</div>
            </div>
            </div>
          </div>
          <div class='info col'>
            $text
          </div>";
    // if there are older versions
    if (count($content) > 1) {
      $returnStr .= "<div class='view-older-versions dropdownButton' data-toggle='old-$id'>View Older Versions <span class='fa fa-caret-down' aria-hidden='true'></span></div>";
      $returnStr .= "<div id='old-$id' class='old-versions' style='display: none;'>
      <div class='container'>";
      foreach ($content as $key => $c) {
        if ($key != 0) {
          $version = $c['version'];
          $text= $c['text'];
          $returnStr .= "
          <div class='row'>
            <div class='col'>
              <div class='old-version-heading'>
                <span class='old-version-tag'>Version: $version</span>
              </div>
              <div class='info old-info'>
                $text
              </div>
            </div>
          </div>";
        }
      }
      $returnStr .= "</div>
      </div>";
    }
    // end if there are older versions
    $returnStr .="</div></div></div>";
    return $returnStr;
  }
  function getUnrefinedDocumentContent($heading) {
    global $DOC_PAGE_CONTENT;
    // load the content
    if (is_null($DOC_PAGE_CONTENT)) {
      $DOC_PAGE_CONTENT = json_decode(file_get_contents(__DIR__ . "/doc_content.json"), true);
    }
    if (!empty($DOC_PAGE_CONTENT[$heading]))
      return $DOC_PAGE_CONTENT[$heading];
    return NULL;
  }
?>