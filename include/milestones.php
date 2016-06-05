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
	$smarty->assign('ProjectID',$ProjectID);
	
	// Insert new data
    if (($write == "Yes") && ($_POST['section'] == "new")) {
    	$sql = "INSERT INTO `Milestones` (`ProjectID`,`SubmittalTypeID`,`TargetDate`,`DateIn`,`TargetDateOut`,`DateOut`,`organization`,`contact_person`,`Comments`) VALUES
    	('$ProjectID','$_POST[SubmittalTypeID]','$_POST[TargetDate]','$_POST[DateIn]','$_POST[TargetDateOut]','$_POST[DateOut]','$_POST[organization]','$_POST[contact_person]','$_POST[Comments]')";
    	$result = $admin->new_mysql($sql);
    	if ($result == "TRUE") {
    		print '
			<div class="alert alert-success" role="alert">
  				<strong>Success</strong> You successfully added a milestone.
			</div>
    		';
    	} else {
    		print '
			<div class="alert alert-danger" role="alert">
  				<strong>Oh snap!</strong> There was a MySQL error!
			</div>
    		';
    	}
    
    	// TBD - Insert into the other 2 tabs to the right

    }

    if (($write == "Yes") && ($_POST['id'] != "")) {
    	$_GET['id'] = $_POST['id'];
    	$sql = "UPDATE `Milestones` SET 
    		`SubmittalTypeID` = '$_POST[SubmittalTypeID]',
    		`TargetDate` = '$_POST[TargetDate]',
    		`DateIn` = '$_POST[DateIn]',
    		`TargetDateOut` = '$_POST[TargetDateOut]',
    		`DateOut` = '$_POST[DateOut]',
    		`organization` = '$_POST[organization]',
    		`contact_person` = '$_POST[contact_person]',
    		`Comments` = '$_POST[Comments]'
    		WHERE `ProjectID` = '$_POST[ProjectID]' AND `MilestoneID` = '$_POST[id]'
    	";
    	$result = $admin->new_mysql($sql);
    	if ($result == "TRUE") {
    		print '
			<div class="alert alert-success" role="alert">
  				<strong>Success</strong> You successfully updated a milestone.
			</div>
    		';
    	} else {
    		print '
			<div class="alert alert-danger" role="alert">
  				<strong>Oh snap!</strong> There was a MySQL error!
			</div>
    		';
    	}
    }

    // load data
    $sql = "
    SELECT
    	`s`.`Description`,
    	`m`.`MilestoneID`,
    	`m`.`ProjectID`,
    	`m`.`TargetDate`,
    	`m`.`DateIn`,
    	`m`.`TargetDateOut`,
    	`m`.`DateOut`,
    	`m`.`organization`,
    	`m`.`contact_person`,
    	`m`.`Comments`

    FROM
    	`Milestones` m,
    	`SubmittalTypes` s

    WHERE
    	`m`.`SubmittalTypeID` = `s`.`id`
    	AND `m`.`ProjectID` = '$ProjectID'

    ORDER BY `s`.`Description` DESC
    ";
    $result = $admin->new_mysql($sql);
    while ($row = $result->fetch_assoc()) {
    	$html .= "<tr>
    	<td><input type=\"button\" value=\"Edit\" class=\"btn btn-primary\" onclick=\"document.location.href='index.php?action=milestones&type=load&ProjectID=$ProjectID&id=$row[MilestoneID]'\"></td>
    	<td>$row[Description]</td>
    	<td>$row[TargetDate]</td>
    	<td>$row[DateIn]</td>
    	<td>$row[TargetDateOut]</td>
    	<td>$row[DateOut]</td>
    	<td>$row[contact_person]</td>
    	</tr>
    	";
    }
    $smarty->assign('milestone_data',$html);

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
			} else {
				$sql = "
				SELECT
					`s`.`Description`,
					`s`.`id` AS 'sid',
					`m`.`TargetDate`,
					`m`.`DateIn`,
					`m`.`DateOut`,
					`m`.`TargetDateOut`,
					`m`.`Comments`,
					`m`.`contact_person`,
					`m`.`organization`,
					`m`.`MilestoneID`

				FROM
					`Milestones` m,
					`SubmittalTypes` s
				
				WHERE
					`m`.`MilestoneID` = '$_GET[id]'
					AND `m`.`SubmittalTypeID` = `s`.`id`
				";
				$result = $admin->new_mysql($sql);
				while ($row = $result->fetch_assoc()) {
					foreach ($row as $key=>$value) {
						$smarty->assign($key,$value);
					}
					$smarty->assign('SubmittalTypes_default',"<option selected value=\"$row[sid]\">$row[Description]</option>");
					$smarty->assign('contact_person_default',"<option selected>$row[contact_person]</option>");
					$smarty->assign('organization_default',"<option selected>$row[organization]</option>");
				}
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

