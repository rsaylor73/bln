<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";

if ($_SESSION['ct'] == "Gl9dW3jck") {
        $check_login = $admin->check_login();
        if ($check_login == "TRUE") {

			$sql = "SELECT * FROM `PlanReviewContact` GROUP BY `ContactName` ORDER BY `ContactName` ASC";
			$result = $admin->new_mysql($sql);
			$options = "<option value=\"\">--Select--</option>";
			while ($row = $result->fetch_assoc()) {
				if ($_GET['ContactName'] == $row['ContactID']) {
					$hidden = "<input type=\"hidden\" name=\"ContactName2\" value=\"$row[ContactName]\">";
					$selected = "selected";
					$ContactName = $row['ContactName'];
					$Email = $row['Email'];
					$Phone = $row['Phone'];
					$Fax = $row['Fax'];
					
				} else {
					$selected = "";
				}
				$options .= "<option $selected value=\"$row[ContactID]\">$row[ContactName]</option>";
			}

			?>
        <form name="myform2" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="addto3">
        <input type="hidden" name="ProjectID" value="<?=$_GET['ProjectID']?>">
        <input type="hidden" name="part" value="review">
        <input type="hidden" name="id2" value="<?=$_GET['id2']?>">

		        <table border=0 width=100%>
		                <tr><td align=right>Contact Name</td><td><select name="ContactName" onchange="load_list2(this.form)"><?=$options;?></select> <?=$hidden;?>
		                </td></tr>
		                <tr><td align=right>Email Address</td><td><input type="text" name="Email" value="<?=$Email;?>" size=20></td></tr>
	                	<tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" value="<?=$Phone;?>" size=20></td></tr>
		                <tr><td align=right>Fax # (10 digits)</td><td><input type="text" name="Fax" value="<?=$Fax;?>" size=20></td></tr>
				<tr><td><input type="submit" value="Add Contact"></td></tr>
		        </table>

			<script>
		        function load_list2(myform2) {
		                $.get('show_list2.php',
		                $(myform2).serialize(),
		                function(php_msg) {
		                        $("#list2").html(php_msg);
		                });
		        }
			</script>


			<?php
	}
}
?>
