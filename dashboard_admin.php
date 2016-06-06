<?php
if ($temp != "") {

	$sql = "SELECT * FROM `security_table` WHERE `userID` = '$_SESSION[id]'";
	$result = $this->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		switch ($row['tab']) {
			case "1":
			if ($row['read'] == "checked") {
				$read1 = "ok";
			}
			break;
                        case "2":
                        if ($row['read'] == "checked") {
                                $read2 = "ok";
                        }
			break;
                        case "3":
                        if ($row['read'] == "checked") {
                                $read3 = "ok";
                        }
			break;
                        case "4":
                        if ($row['read'] == "checked") {
                                $read4 = "ok";
                        }
                        case "5":
                        if ($row['read'] == "checked") {
                                $read5 = "ok";
                        }
			break;
		}
	}

	//print "<table border=1 width=100%>
	//<tr>
	//";
	$sql2 = "
	SELECT
		`state`.`state_abbr`
	FROM
		`state`,`users`
	WHERE
		`users`.`id` = '$_SESSION[id]'
		AND `users`.`default_state` = `state`.`state_id`
	";

	print '
	<nav class="navbar navbar-dark bg-primary">
  	<div class="container-fluid">
    <div class="navbar-header">
	';

	// find active
	if (($_GET['action'] == "") && ($_POST['action'] == "")) {
		$t0 = "class=\"active\"";
	}
	if (($_GET['action'] == "pe") or ($_POST['action'] == "pe")) {
		$t1 = "class=\"active\"";
	}
	if (($_GET['action'] == "contacts") or ($_POST['action'] == "contacts")) {
		$t2 = "class=\"active\"";
	}
	if (($_GET['action'] == "milestones") or ($_POST['action'] == "milestones")) {
		$t3 = "class=\"active\"";
	}
	if (($_GET['action'] == "deficiencies") or ($_POST['action'] == "deficiencies")) {
		$t4 = "class=\"active\"";
	}
	if (($_GET['action'] == "ratings") or ($_POST['action'] == "ratings")) {
		$t5 = "class=\"active\"";
	}
	if (($_GET['action'] == "constructability") or ($_POST['action'] == "constructability")) {
		$t6 = "class=\"active\"";
	}

	$result2 = $this->new_mysql($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		//print "<td width=20%><b>Default State: <font color=green>$row2[state_abbr]</font></b> (<a href=\"index.php?action=change_state\">Change</a>)</td>";
		print "<a class=\"navbar-brand\" href=\"#\">Default State: $row2[state_abbr]</a>";
		$found_state = "1";
	}
	if ($found_state == "") {
		print "<a class=\"navbar-brand\" href=\"#\">Default State: None</a>";
	}
	print '</div>';

	print '<ul class="nav navbar-nav">
      <li '.$t0.'><a href="index.php">Home</a></li>';

	if ($found_state == "1") {
		if ($_SESSION['ProjectID'] != "") {
			$type_load = "&type=load";
		}
		if ($read1 == "ok") {
			//print "<td><b><a href=\"index.php?action=pe$type_load&ProjectID=$_SESSION[ProjectID]\">Project Entry</a></b></td>";
			print "<li $t1><a href=\"index.php?action=pe$type_load&ProjectID=$_SESSION[ProjectID]\">Project Entry</a></li>";
		}
       	if ($read3 == "ok") {
            //print "<td><b><a href=\"index.php?action=contacts$type_load&ProjectID=$_SESSION[ProjectID]\">Contacts</a></b></td>";
       		print "<li $t2><a href=\"index.php?action=contacts$type_load&ProjectID=$_SESSION[ProjectID]\">Contacts</a></li>";
       	}
		if ($read2 == "ok") {
			//print "<td><b><a href=\"index.php?action=milestones$type_load&ProjectID=$_SESSION[ProjectID]\">Milestones</a></b></td>";
			print "<li $t3><a href=\"index.php?action=milestones$type_load&ProjectID=$_SESSION[ProjectID]\">Milestones</a></li>";
		}
		if ($read4 == "ok") {
			//print "<td><b><a href=\"index.php?action=deficiencies&ProjectID=$_SESSION[ProjectID]\">Design Deficiencies</a></b></td>";
			print "<li $t4><a href=\"index.php?action=deficiencies&ProjectID=$_SESSION[ProjectID]\">Design Deficiencies</a></li>";
		}
		if ($read5 == "ok") {
			//print "<td><b><a href=\"index.php?action=ratings&ProjectID=$_SESSION[ProjectID]\">Ratings</a></b>";
			print "<li $t5><a href=\"index.php?action=ratings&ProjectID=$_SESSION[ProjectID]\">Ratings</a></li>";
		}

		//print "<td width=20%><b><a href=\"index.php?action=constructability&ProjectID=$_SESSION[ProjectID]\">Constructability</a></b></td>";
		print "<li $t6><a href=\"index.php?action=constructability&ProjectID=$_SESSION[ProjectID]\">Constructability</a></li>";
		//print "<td width=20%><b>Tab 7 TBD</b></td>";
		print "<li $t7><a href=\"#\">Tab 7 TBD</a></li>";

	} else {
		//print "<td colspan=6>You currently do not have a default state set. Please click <a href=\"index.php?action=change_state\">here</a> to set a state.</td>";
		print "<li><a href=\"#\">You currently do not have a default state set</a></li>";
	}
	//print "
	//</tr>
	//</table><br>";
	print '</ul></div></nav>';

	print "<br><input type=\"button\" class=\"btn btn-success\" onclick=\"document.location.href='index.php?action=change_state'\" value=\"Change State\">";

	if (($_GET['action'] == "") && ($_POST['action'] == "")) {
	print "<hr>
	<ul>
		<li><a href=\"index.php?action=profile\">Manage Profile</a></li>";
		if ($_SESSION['userType'] == "admin") {
			print "<li><a href=\"index.php?action=reports\">Reports</a></li>";
			print "<li><a href=\"index.php?action=manage_users\">Manage Users</a></li>";
			print "<li><a href=\"index.php?action=c_tabs\">Constructability Tabs</a></li>";
			print "<li><a href=\"index.php?action=c_categories\">Constructability Categories</a></li>";
			print "<li><a href=\"index.php?action=c_questions\">Constructability Questions</a></li>";
		}
		print "
		<li><a href=\"index.php?action=logout\">Logout</a></li>

	</ul>";
	}

}
?>
