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

		// update
		if ($_POST['id'] != "") {
			$sql = "UPDATE `Deficiencies` SET

			`DesignSpeed` 			= '$_POST[DesignSpeed]',
			`LaneWidths` 			= '$_POST[LaneWidths]',
			`ShdrWidth_CurbOffset`	= '$_POST[ShdrWidth_CurbOffset]',
			`BridgeWidth`			= '$_POST[BridgeWidth]',
			`StructuralCapacity`	= '$_POST[StructuralCapacity]',
			`HorizontalCurvature`	= '$_POST[HorizontalCurvature]',
			`SuperElevationTransitionLengths`	= '$_POST[SuperElevationTransitionLengths]',
			`HorizontalCurves`		= '$_POST[HorizontalCurves]',
			`VerticalCurves`		= '$_POST[VerticalCurves]',
			`MaximumGrade`			= '$_POST[MaximumGrade]',
			`TravelLaneCrossSlope`	= '$_POST[TravelLaneCrossSlope]',
			`SuperElevationRate`	= '$_POST[SuperElevationRate]',
			`MinimumVerticalClearance` = '$_POST[MinimumVerticalClearance]',
			`AccessibilityRequirements` = '$_POST[AccessibilityRequirements]',
			`BridgeSafety`			= '$_POST[BridgeSafety]',
			`ObstructionFreeZone`	= '$_POST[ObstructionFreeZone]',
			`GuardrailLength`		= '$_POST[GuardrailLength]',
			`GuardrailEndTreatment`	= '$_POST[GuardrailEndTreatment]',
			`IntersectionSightDistance` = '$_POST[IntersectionSightDistance]',
			`LateralOffsetToObstruction` = '$_POST[LateralOffsetToObstruction]'

			WHERE `ID` = '$_POST[id]' AND `ProjectID` = '$ProjectID'
			";
			$result = $admin->new_mysql($sql);
			if ($result == "TRUE") {
				$smarty->assign('msg','<div class="alert alert-success" role="alert"><strong>Success</strong> The record was updated.</div>');
			} else {
				$smarty->assign('msg','<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> There was a MySQL error!</div>');
			}
		}

		$sql = "
		SELECT
			`s`.`Description`,
			`d`.*

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
			<td><input type=\"button\" class=\"btn btn-primary\" value=\"Edit\" onclick=\"document.location.href='index.php?action=deficiencies&ProjectID=$ProjectID&id=$row[ID]'\">
			&nbsp;&nbsp;$row[Description]</td>
			<td>$row[DesignSpeed]</td><td>$row[LaneWidths]</td><td>$row[ShdrWidth_CurbOffset]</td><td>$row[BridgeWidth]</td><td>$row[HorizontalCurves]</td>
			<td>$row[SuperElevationRate]</td><td>$row[VerticalCurves]</td><td>$row[SuperElevationTransitionLengths]</td><td>$row[MaximumGrade]</td>
			<td>$row[ObstructionFreeZone]</td><td>$row[TravelLaneCrossSlope]</td><td>$row[MinimumVerticalClearance]</td><td>$row[LateralOffsetToObstruction]</td>
			<td>$row[StructuralCapacity]</td><td>$row[BridgeSafety]</td><td>$row[AccessibilityRequirements]</td>
			<td>$row[GuardrailLength]</td><td>$row[GuardrailEndTreatment]</td><td>$row[IntersectionSightDistance]</td>
			</tr>
			";
		}



		if ($_GET['id'] != "") {
			$sql = "
			SELECT
				`s`.`Description`,
				`d`.*

			FROM
				`Deficiencies` d,
				`SubmittalTypes` s

			WHERE
				`d`.`ProjectID` = '$ProjectID'
				AND `d`.`ID` = '$_GET[id]'
				AND `d`.`SubmittalTypeID` = `s`.`id`

			";
			$result = $admin->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				foreach ($row as $key=>$value) {
					$smarty->assign($key,$value);
				}
			}
		}

		$smarty->assign('data',$data);
	}


	$smarty->display('deficiencies.tpl');

} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>