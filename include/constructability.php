<?php

// setup security TBD with tab 7

	// check data
	if ($_GET['ProjectID'] != "") {
		$ProjectID = $_GET['ProjectID'];
	}
	if ($_POST['ProjectID'] != "") {
		$ProjectID = $_POST['ProjectID'];
	}

	if ($_GET['ProjectID'] != "") {
		$admin->generate_construction($ProjectID);
	}

	// update data
	if ($_POST['sub'] == "update") {
	        $sql = "
        	SELECT
	                `c`.`id`,
        	        `ct`.`name` AS 'tab_name',
                	`cc`.`category`,
	                `c`.`question`,
        	        `c`.`answer`

	        FROM
        	        `Constructability` c, `construction_tabs` ct, `construction_categories` cc

	        WHERE
        	        `c`.`projectID` = '$ProjectID'
                	AND `c`.`tabID` = `ct`.`id`
	                AND `c`.`categoryID` = `cc`.`id`

	        ORDER BY `ct`.`id` ASC, `cc`.`id` ASC
        	";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$i = "answer_";
			$i .= $row['id'];
			$answer = $_POST[$i];
			$sql2 = "UPDATE `Constructability` SET `answer` = '$answer' WHERE `projectID` = '$ProjectID' AND `id` = '$row[id]'";
			$result2 = $admin->new_mysql($sql2);
		}

	}



        $project_list = $admin->load_project();
        $smarty->assign('ProjectList',$project_list);

	$sql = "
	SELECT
		`c`.`id`,
		`ct`.`name` AS 'tab_name',
		`cc`.`category`,
		`c`.`question`,
		`c`.`answer`

	FROM
		`Constructability` c, `construction_tabs` ct, `construction_categories` cc

	WHERE
		`c`.`projectID` = '$ProjectID'
		AND `c`.`tabID` = `ct`.`id`
		AND `c`.`categoryID` = `cc`.`id`

	ORDER BY `ct`.`id` ASC, `cc`.`id` ASC
	";


	$html = "<form action=\"index.php\" method=\"post\">
		<input type=\"hidden\" name=\"action\" value=\"constructability\">
		<input type=\"hidden\" name=\"type\" value=\"load\">
		<input type=\"hidden\" name=\"sub\" value=\"update\">
		<input type=\"hidden\" name=\"ProjectID\" value=\"$ProjectID\">";

	$html .= "<table class=\"table\">";
	$result = $admin->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		// Tab
		if ($this_tab != $row['tab_name']) {
			$html .= "<tr><td colspan=2><br><h4><i class=\"fa fa-folder text-primary\">&nbsp;&nbsp;<b>$row[tab_name]</b></i></h4></td></tr>";
		        $html .= "<tr><td colspan=2><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\"></td></tr>";
			$this_tab = $row['tab_name'];
		}

		// Category
		if ($this_cat != $row['category']) {
			$html .= "<tr><td colspan=2><h5><i class=\"fa fa-folder-open-o text-default\">&nbsp;&nbsp;<b>$row[category]</b></i></h5></td></tr>";
			$this_cat = $row['category'];
		}
		$html .= "<tr><td width=550>$row[question]</td><td><select name=\"answer_$row[id]\">";
			if ($row['answer'] == "") {
				$html .= "<option selected value=\"\">--Select--</option>";
			}
			if ($row['answer'] != "") {
				$html .= "<option selected value=\"$row[answer]\">$row[answer]</option>";
			}

		$html .= "<option>Yes</option><option>No</option><option>N/A</option></select></td></tr>";
	}
	if ($ProjectID != "") {
		$html .= "<tr><td colspan=2><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\"></td></tr>";
	}
	$html .= "</table>";
	$html .= "</form>";
	$smarty->assign('html',$html);

        $smarty->display('constructability.tpl');


?>
