<?php
  function getContentById($headings) {
    global $DOC_PAGE_CONTENT;
    $cont = array();
    foreach ($headings as $h) {
      if (!empty($DOC_PAGE_CONTENT[$h])) {
        $cont[$h]['content'] = $DOC_PAGE_CONTENT[$h];
        $cont[$h]['title'] = $h;
      } else {
        unset($cont[$h]);
      }
    }
    return formatDocsPageContent($cont);
  }

  function formatDocsPageContent($headings) {
    $returnStr = "<div class='container'>";
    foreach ($headings as  $h) {
      $content = $h['content'];
      $id = $h['title'];
      $title = $h['title'];
      $text = $h['content'][0]['text'];
      $version = $h['content'][0]['version'];
      $returnStr .= "<div class='row'>
      <div class='section center container' id='content-$title'>
          <div class='row'>
            <div class='heading col'>
              <span class='title'>$title</span>
              <span class='current-version'>Version: $version</span>
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
        </div>
        </div>";
      }
      // end if there are older versions
      $returnStr .="</div>
      </div>";
    }
    $returnStr .= "</div>";
    return $returnStr;
  }

  $DOC_PAGE_CONTENT = array(
  "h1"=> array(
    array(
    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend, tellus sit amet malesuada condimentum, enim eros vestibulum velit, sit amet venenatis quam nibh ut magna. Pellentesque nisi dolor, interdum vel lobortis quis, egestas et magna. In porta pharetra lacus hendrerit fringilla. Vivamus imperdiet nunc vel sem aliquam feugiat. Phasellus pulvinar ac dolor vitae interdum. Vivamus in arcu sed risus ultrices tempus id nec augue. Sed consequat odio neque, eu ullamcorper nisl pharetra non. In eget efficitur elit.",
    "version" => "1.0.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.1.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.0.1")
    ),
   "Hello Sunshine in the rain"=> array(
    array(
    "text" => "Quisque non tellus ac dolor tincidunt egestas egestas a ligula. Pellentesque dapibus porta turpis vitae consectetur. Pellentesque vitae lacus convallis, imperdiet dui quis, vehicula urna. Praesent lacinia libero sit amet congue fermentum. Nulla facilisi. Fusce lectus tellus, bibendum eget laoreet id, blandit vitae lorem. Morbi et leo ac ex semper dignissim.",
    "version" => "1.2.0"),
    array(
    "text" => "Mauris eu scelerisque turpis. Etiam vitae diam maximus odio posuere blandit ut nec elit. Fusce rutrum euismod purus, a posuere metus ultrices sed. Aenean venenatis dui augue, a porta justo sodales ut. In id fermentum purus. Proin velit ligula, pharetra vel tincidunt id, condimentum vitae sem. Etiam vel finibus nulla. Pellentesque lobortis aliquet euismod. Sed condimentum erat id quam varius gravida.",
    "version" => "0.1.0")
    ),
    "12345"=> array(
    array(
    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend, tellus sit amet malesuada condimentum, enim eros vestibulum velit, sit amet venenatis quam nibh ut magna. Pellentesque nisi dolor, interdum vel lobortis quis, egestas et magna. In porta pharetra lacus hendrerit fringilla. Vivamus imperdiet nunc vel sem aliquam feugiat. Phasellus pulvinar ac dolor vitae interdum. Vivamus in arcu sed risus ultrices tempus id nec augue. Sed consequat odio neque, eu ullamcorper nisl pharetra non. In eget efficitur elit.",
    "version" => "1.0.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.1.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.0.1")
    ),
    "Adam Test ##2"=> array(
    array(
    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eleifend, tellus sit amet malesuada condimentum, enim eros vestibulum velit, sit amet venenatis quam nibh ut magna. Pellentesque nisi dolor, interdum vel lobortis quis, egestas et magna. In porta pharetra lacus hendrerit fringilla. Vivamus imperdiet nunc vel sem aliquam feugiat. Phasellus pulvinar ac dolor vitae interdum. Vivamus in arcu sed risus ultrices tempus id nec augue. Sed consequat odio neque, eu ullamcorper nisl pharetra non. In eget efficitur elit.",
    "version" => "1.0.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.1.0"),
    array(
    "text" => "Curabitur sit amet dolor in augue bibendum dignissim. Nulla tortor velit, rutrum a auctor ut, cursus ac nisl. Ut ut ligula vel metus luctus vestibulum sit amet quis magna. Praesent finibus nisl vitae lacus ullamcorper suscipit. Fusce mattis a neque a fringilla. Praesent sed tincidunt sem, gravida porttitor enim. Mauris facilisis justo ex, vel molestie eros rhoncus vel. Praesent bibendum pretium condimentum. Sed porta ex ex, non semper metus posuere id. Fusce congue luctus enim ac bibendum. Fusce sit amet felis egestas, porttitor eros et, volutpat libero. Morbi gravida iaculis nunc quis rhoncus. Fusce fringilla volutpat ex consequat suscipit.",
    "version" => "0.0.1")
    ),
  );
?>