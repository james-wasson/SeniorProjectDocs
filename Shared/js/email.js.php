<?php
include_once "./$pageName/page.php";
$emailJS = "<script type='text/javascript'>
  $().ready(function() {
    $('#sendEmail').submit(function(e) {
      e.preventDefault()
      var msg = $('#emailBody').val();
      var sbj = $('#emailSubject').val();\n";
if (!empty($CONTENT) && !empty($CONTENT['EMAIL']))
  $emailJS .= "var email = '" . $CONTENT['EMAIL'] . "'\n";
else
  $emailJS .= "var email = ''\n";
$emailJS .= "var mailto_link = 'mailto:' + email + '?subject=' + encodeURIComponent(sbj) + '&body=' + encodeURIComponent(msg);
      document.location.href = mailto_link;
    });
  });
</script>";
?>