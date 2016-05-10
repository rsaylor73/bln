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

			$sql = "SELECT * FROM `DesignConsultantContact` GROUP BY `ContactName` ORDER BY `ContactName` ASC";
			$result = $admin->new_mysql($sql);
			$options = "<option value=\"\">--Select--</option>";
			while ($row = $result->fetch_assoc()) {
				if ($_GET['DesignConsultant'] == $row['ConsultantID']) {
					$hidden = "<input type=\"hidden\" name=\"DesignConsultant2\" value=\"$row[DesignConsultant]\">";
					$hidden2 = "<input type=\"hidden\" name=\"ContactName\" value=\"$row[ContactName]\">";
					$selected = "selected";
					$ContactName = $row['ContactName'];
					$DesignConsultant = $row['DesignConsultant'];
					$Email = $row['Email'];
					$Phone = $row['Phone'];
					$Fax = $row['Fax'];
					
				} else {
					$selected = "";
				}
				$options .= "<option $selected value=\"$row[ConsultantID]\">$row[ContactName]</option>";
			}

			?>

        <form name="newform" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="addto2">
        <input type="hidden" name="ProjectID" value="<?=$_GET['ProjectID'];?>">
        <input type="hidden" name="part" value="designer">


		        <table border=0 width=100%>
	        	<tr><td align=right>Organization</td><td><input type="text" name="DesignConsultant" value="<?=$DesignConsultant;?>"> 
			<button type="button" name="down" onclick="show_list1(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
	                </td></tr>

                        <tr><td align=right>Contact Person</td><td><select name="DesignConsultant" onchange="load_list1(this.form)"><?=$options;?></select>  <?=$hidden;?> <?=$hidden2;?>
                        </td></tr>


                	<tr><td align=right>Contact Person's Email</td><td><input type="text" name="Email" value="<?=$Email;?>" size=20></td></tr>
	                <tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" value="<?=$Phone;?>" size=20></td></tr>
        	        <tr><td align=right>Fax # (10 digits)</td><td><input type="Text" name="Fax" value="<?=$Fax;?>" size=20></td></tr>
			<tr><td><input type="submit" value="Add Contact"></td></tr>
	        	</table>
	</form>

			<script>
		        function load_list1(myform2) {
		                $.get('show_list3.php',
		                $(myform2).serialize(),
		                function(php_msg) {
		                        $("#list1").html(php_msg);
		                });
		        }
			</script>


			<?php
	}
}
?>
