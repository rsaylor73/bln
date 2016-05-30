<?php
/*
Project Entry Tab
Version 2.0


*/

// check if you are allowed to write data
if ($_SESSION['tab2_write'] == "checked") {
        $write = "Yes";
}

// check if you are allowed to read
if ($_SESSION['tab3_read'] == "checked") {
	$_SESSION['ms'] = "Hlo0Glth9dW3jck";
        // load projects
        $project_list = $admin->load_project();
        $smarty->assign('ProjectList',$project_list);

	if ($_GET['type'] != "") {
		$type = $_GET['type'];
	}
	if ($_POST['type'] != "") {
		$type = $_POST['type'];
	}
	if ($_GET['ProjectID'] != "") {
		$ProjectID = $_GET['ProjectID'];
	}
	if ($_POST['ProjectID'] != "") {
		$ProjectID = $_POST['ProjectID'];
	}

	// Submittal Types
	$SubmittalTypes = "<option value=\"\">--Select--</option>";
	$sql = "SELECT * FROM `SubmittalTypes` ORDER BY `id` ASC";
	$result = $admin->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$SubmittalTypes .= "<option value=\"$row[id]\">$row[Description]</option>";
	}
	$smarty->assign('SubmittalTypes',$SubmittalTypes);

	// Organizations
	$sql = "SELECT `DesignConsultant` FROM `DesignConsultantContact` WHERE `ProjectID` = '$ProjectID'";
	$organizations = "<option value=\"\">--Select--</option>";
	$result = $admin->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$organizations .= "<option>$row[DesignConsultant]</option>";
	}
	$smarty->assign('organizations',$organizations);

	// Contacts
	$sql = "SELECT `ContactName` FROM `PlanReviewContact` WHERE `ProjectID` = '$ProjectID'";
	$contacts = "<option value=\"\">--Select--</option>";
	$result = $admin->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$contacts .= "<option>$row[ContactName]</option>";
	}
	$smarty->assign('contacts',$contacts);

	switch ($type) {
		case "load":
	        $smarty->assign('show_form','Yes');
			if (($_GET['id'] == "") && ($_GET['id2'] == "")) {
				$smarty->assign('new','Yes');
			}
			$smarty->assign('ProjectID',$ProjectID);
		break;

		default:
			$smarty->assign('show_form','Yes');
			$smarty->assign('new','Yes');
		break;
	}

        $smarty->display('milestones.tpl');
} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>

