<?php
/*
Project Entry Tab
Version 2.0


*/

// check if you are allowed to write data
if ($_SESSION['tab4_write'] == "checked") {
        $write = "Yes";
}

// check if you are allowed to read
if ($_SESSION['tab4_read'] == "checked") {
	$_SESSION['dd'] = "Hlo0Glth9dW3jck";
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

	if ($ProjectID != "") {
		$sql = "
		SELECT
			`s`.`Description`,
			`m`.*

		FROM
			`Deficiencies` d,
			`SubmittalTypes` s

		WHERE
			`d`.`ProjectID` = '$ProjectID'
			AND `d`.`SubmittalTypeID` = `s`.`id`
		";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data .= "<tr>
			<td><input type=\"button\" class=\"btn btn-primary\" value=\"Edit\">&nbsp;&nbsp;$row[Description]</td>
			<td>$row[DesignSpeed]</td><td>$row[LaneWidths]</td><td>$row[ShdrWidth_CurbOffset]</td><td>$row[BridgeWidth]</td><td>$row[HorizontalCurves]</td>
			<td>$row[SuperElevationRate]</td><td>$row[VerticalCurves]</td><td>$row[SuperElevationTransitionLengths]</td><td>$row[MaximumGrade]</td>
			<td>$row[ObstructionFreeZone]</td><td>$row[TravelLaneCrossSlope]</td><td>$row[MinimumVerticalClearance]</td><td>$row[LateralOffsetToObstruction]</td>
			<td>$row[StructuralCapacity]</td><td>$row[BridgeSafety]</td><td>$row[AccessibilityRequirements]</td>
			<td>$row[GuardrailLength]</td><td>$row[GuardrailEndTreatment]</td><td>$row[IntersectionSightDistance]</td>
			</tr>
			";
		}
		$smarty->assign('data',$data);
	}


	$smarty->display('deficiencies.tpl');

} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>