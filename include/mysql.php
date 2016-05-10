<?php

/*
$DB_NAME = 'blneng5_dot';
$DB_HOST = 'localhost';
$DB_USER = 'blneng5_dot';
$DB_PASS = 'Lz*M*_I%$?l1';
*/

$DB_NAME = 'bln_dot';
$DB_HOST = 'localhost';
$DB_USER = 'bln_dot';
$DB_PASS = 'tH1ih~;7ywHm';


$linkID = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}
?>
