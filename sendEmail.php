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
    
    $charset = 'utf-8';
    $mail     = 'no-reply@'.str_replace('www.', '', $_SERVER['SERVER_NAME']);
    $uniqid   = md5(uniqid(time()));
    $headers  = 'From: '.$mail."\n";
    $headers .= 'Reply-to: '.$mail."\n";
    $headers .= 'Return-Path: '.$mail."\n";
    $headers .= 'Message-ID: <'.$uniqid.'@'.$_SERVER['SERVER_NAME'].">\n";
    $headers .= 'MIME-Version: 1.0'."\n";
    $headers .= 'Date: '.gmdate('D, d M Y H:i:s', time())."\n";
    $headers .= 'X-Priority: 3'."\n";
    $headers .= 'X-MSMail-Priority: Normal'."\n";
    $headers .= 'Content-Type: multipart/mixed;boundary="----------'.$uniqid.'"'."\n\n";
    $headers .= '------------'.$uniqid."\n";
    $headers .= 'Content-type: text/'.$type.';charset='.$charset.''."\n";
    $headers .= 'Content-transfer-encoding: 7bit';
      
    if(mail($CONTENT['EMAIL'], $subject, $msg, $headers)) { // mail sent
      echo "Mail Sent!" . $CONTENT['EMAIL'];
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
