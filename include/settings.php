<?php

//$GLOBAL['path'] = "/home/blneng5/www/dot";
$GLOBAL['path'] = "/home/bln/www/bln";

// email headers - This is fine tuned, please do not modify
$sitename = "TBD";
$site_email = "TBD";

$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: $sitename <$site_email>\r\n";
$header .= "Reply-To: $sitename <$site_email>\r\n";
$header .= "X-Priority: 3\r\n";
$header .= "X-Mailer: PHP/" . phpversion()."\r\n";

$GLOBAL['header'] = $header;
?>
