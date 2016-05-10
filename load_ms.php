<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";
// Update security TBA
//if ($_SESSION['ct'] == "Gl9dW3jck") {
//        $check_login = $admin->check_login();
//        if ($check_login == "TRUE") {

		$sql = "SELECT `default_state` FROM `users` WHERE `id` = '$_SESSION[id]'";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$default_state = $row['default_state'];
		}
		if ($default_state == "") {
			print "<br><font color=red>ERROR: you do not have a default state set.</font>";
			die;
		}

		// check if DOT project number is direct match
		$found = "0";
		$sql = "
		SELECT
			`projects`.`ProjectID`,
			`projects`.`PayItem`,
			`DOT_Project_Names`.`ProjectName`

		FROM
			`projects`,`DOT_Project_Names`

		WHERE
			`projects`.`DOT_Project_Names` = '$_GET[load_project]'
			AND `projects`.`DOT_Project_Names` = `DOT_Project_Names`.`id`
			AND `projects`.`stateID` = '$default_state'
		";
		$html = "<tr><td><b>Project Number</b></td><td><b>Cost Code</b></td></tr>";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$ProjectID = $row['ProjectID'];
			$html .= "<tr><td><a href=\"index.php?action=constructability&type=load&ProjectID=$row[ProjectID]\">$row[ProjectName]</a></td><td>$row[PayItem]</td></tr>";
			$found++;
		}
		// show list

		if ($found > 1) {
			print "<h2>One or more records found. Please click the record you would like to view.</h2>";
			print "<table class=\"table\">
			$html
			</table>";

		}

		if ($found == "1") {
			print "<br>Loading...<br>";
			?>
			<script>
				document.location.href='index.php?action=milestones&type=load&ProjectID=<?=$ProjectID;?>';
			</script>
			<?
			//print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?action=pe&type=load&ProjectID=$ProjectID\">";
		}
		if ($found == "0") {
			print "<br><font color=red>I was unable to locate any projects matching your selection.</font><br>";
		}

//	} else {
//		print "<br><font color=red>Error: your session has timmed out. Please click <a href=\"index.php\">here</a> to log in.</font><br><br>";
//	}
//}
?>
