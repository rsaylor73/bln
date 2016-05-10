<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";
if ($_SESSION['pt'] == "k4do3wxjt") {
        $check_login = $admin->check_login();
        if ($check_login == "TRUE") {

        $sql = "SELECT * FROM `security_table` WHERE `userID` = '$_SESSION[id]' AND `tab` = '1'";
        $result = $admin->new_mysql($sql);
        while ($row = $result->fetch_assoc()) {
                if ($row['write'] == "checked") {
                        $write = "1";
                }
        }
        if ($write != "1") {
                print "<br><br><font color=red>Sorry, you do not have write access.</font><br><br>";
                die;
        }


		if ($_GET['section'] == "") {
			print "<div id=\"imp2\">
			<form name=\"myform2\">
			<input type=\"hidden\" name=\"section\" value=\"s2\">
			";
			print "<input type=\"text\" name=\"ImprovementType\" placeholder=\"Type in your new improvement type here\" size=80> <input type=\"button\" value=\"Save\" onclick=\"save_imp(this.form)\">";
			print "</form></div>";


			?>
			<script>
		        function save_imp(myform2) {
		                $.get('new_improvement.php',
		                $(myform2).serialize(),
		                function(php_msg) {
		                        $("#imp2").html(php_msg);
		                });
		        }

			</script>
			<?php
		}

		if ($_GET['section'] == "s2") {
			$sql = "INSERT INTO `TypeofImprovement` (`ImprovementType`) VALUES ('$_GET[ImprovementType]')";
			$result = $admin->new_mysql($sql);
			$sql = "SELECT * FROM `TypeofImprovement`";
                        $result = $admin->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				if ($row['ImprovementType'] == $_GET['ImprovementType']) {
					$options .= "<option selected>$row[ImprovementType]</option>";
				} else {
                                        $options .= "<option>$row[ImprovementType]</option>";
				}
			}
			print "<select name=\"ImprovementType\">$options</select>";
		}




	}
}
?>
