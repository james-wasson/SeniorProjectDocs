<?php
  session_start();
  $pageName = $_SESSION['CURR_PAGE'];
  if (is_null($pageName)) {
    echo "Could Not Fetch Email";
    return http_response_code(400);
  }
  include_once __DIR__ . "/$pageName/page.php";
  if (!is_null($_GET["emailMsg"]) && !is_null($CONTENT) && !is_null($CONTENT['EMAIL']) && $_GET["emailMsg"] != "") {
    $msg = wordwrap($_GET["emailMsg"],70);
    
    $subject = "";
    if (!is_null($_GET["emailSubject"]))
      $subject = $_GET["emailSubject"];
    $subject .= "\t" . date("Y-m-d h:i:sa");
    
    $headers = 'From: noreply@page.com' . "\n" .
    'Reply-To: noreply@page.com' . "\n" .
    'X-Mailer: PHP/' . phpversion();
      
    if(mail($CONTENT['EMAIL'], $subject, $msg, $headers)) { // mail sent
      echo "Mail Sent!";
      return http_response_code(200);
    } else { // failed sending mail
      echo "Error, Mail Sent But Not Delivered.";
      return http_response_code(400);
    }
      
  } else { // form not filled correctly
    if (is_null($_GET["emailMsg"]) || $_GET["emailMsg"] == "")
      echo "Error, Please Provide A Message.";
    else if (is_null($CONTENT['EMAIL']) || is_null($CONTENT)) 
      echo "Error, No Email Was Set.";
    else
      echo "Error, Mail Not Sent.";
    return http_response_code(400);
  }
?>
