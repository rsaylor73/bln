<?php
/*
Project Entry Tab
Version 2.0


*/

// check if you are allowed to write data
if ($_SESSION['tab5_write'] == "checked") {
        $write = "Yes";
}

// check if you are allowed to read
if ($_SESSION['tab5_read'] == "checked") {
	$_SESSION['rt'] = "Hlo0Glth9dW3jck";
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

	// save rating
	if ($_POST['id'] != "") {
		$sql = "UPDATE `ratings` SET 
		`design_concept` = '$_POST[design_concept]',
		`controlling_criteria` = '$_POST[controlling_criteria]',
		`computations_reports` = '$_POST[computations_reports]',
		`plans_quality` = '$_POST[plans_quality]',
		`engineering_judgement` = '$_POST[engineering_judgement]',
		`documentation` = '$_POST[documentation]',
		`qa` = '$_POST[qa]'

		WHERE `id` = '$_POST[id]' AND `ProjectID` = '$ProjectID'
		";
		$result = $admin->new_mysql($sql);
		if ($result == "TRUE") {
			$smarty->assign('msg','<div class="alert alert-success" role="alert"><strong>Success</strong> The record was updated.</div>');
		} else {
			$smarty->assign('msg','<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> There was a MySQL error!</div>');
		}
	}

	// load data
	$sql = "
	SELECT 
		`s`.`Description`,
		`r`.*

	FROM
		`ratings` r, `SubmittalTypes` s

	WHERE
		`r`.`SubmittalTypeID` = `s`.`id`
		AND `r`.`ProjectID` = '$ProjectID'
	";
	$result = $admin->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$html .= "
		<tr>
			<td><a href=\"index.php?action=ratings&ProjectID=$ProjectID&id=$row[id]\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>&nbsp;&nbsp;$row[Description]</td>
			<td>$row[design_concept]</td>
			<td>$row[controlling_criteria]</td>
			<td>$row[computations_reports]</td>
			<td>$row[plans_quality]</td>
			<td>$row[engineering_judgement]</td>
			<td>$row[documentation]</td>
			<td>$row[qa]</td>
		</tr>
		";
	}
	$smarty->assign('data',$html);

	// load rating
	if ($_GET['id'] != "") {
		$sql = "
		SELECT 
			`s`.`Description`,
			`r`.*

		FROM
			`ratings` r, `SubmittalTypes` s

		WHERE
			`r`.`SubmittalTypeID` = `s`.`id`
			AND `r`.`ProjectID` = '$ProjectID'
			AND `r`.`id` = '$_GET[id]'
		";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$smarty->assign($key,$value);
			}
			$smarty->assign('Description',"<option selected>$row[Description]</option>");
		}
	}

	$smarty->display('ratings.tpl');

} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>