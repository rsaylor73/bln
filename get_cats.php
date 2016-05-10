<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";

$sql = "SELECT `category`,`id` FROM `construction_categories` WHERE `tabID` = '$_GET[tabID]'";
$result = $admin->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	$opt .= "<option value=\"$row[id]\">$row[category]</option>";
}

print "<table class=\"table\">
<tr><td width=200>Select Category:</td><td><select name=\"category\">$opt</select></td></tr>
<tr><td>Question:</td><td><input type=\"text\" name=\"question\" size=40></td></tr>
<tr><td colspan=2><input type=\"submit\" value=\"Save\" class=\"btn btn-primary\"></td></tr>
</table>";

?>
