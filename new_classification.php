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
			print "<div id=\"cls2\">
			<form name=\"myform2\">
			<input type=\"hidden\" name=\"section\" value=\"s2\">
			";
			print "<input type=\"text\" name=\"Classification\" placeholder=\"Type in your new classification type here\" size=80> <input type=\"button\" value=\"Save\" onclick=\"save_cls(this.form)\">";
			print "</form></div>";


			?>
			<script>
		        function save_cls(myform2) {
		                $.get('new_classification.php',
		                $(myform2).serialize(),
		                function(php_msg) {
		                        $("#cls2").html(php_msg);
		                });
		        }

			</script>
			<?php
		}

		if ($_GET['section'] == "s2") {
			$sql = "INSERT INTO `FunctionalClassification` (`Classification`) VALUES ('$_GET[Classification]')";
			$result = $admin->new_mysql($sql);
			$sql = "SELECT * FROM `FunctionalClassification`";
                        $result = $admin->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				if ($row['Classification'] == $_GET['Classification']) {
					$options .= "<option selected>$row[Classification]</option>";
				} else {
                                        $options .= "<option>$row[Classification]</option>";
				}
			}
			print "<select name=\"Classification\">$options</select>";
		}




	}
}
?>
