<?php
/*
Project Entry Tab
Version 2.0


*/

// check if you are allowed to write data
if ($_SESSION['tab1_write'] == "checked") {
	$write = "Yes";
}

// check if you are allowed to read
if ($_SESSION['tab1_read'] == "checked") {
	$_SESSION['pt'] = "k4do3wxjt";

	$sql = "SELECT * FROM `TypeofImprovement`";
        $result = $admin->new_mysql($sql);
        while ($row = $result->fetch_assoc()) {
        	if ($row['ImprovementType'] == $_GET['ImprovementType']) {
                	$options1 .= "<option selected>$row[ImprovementType]</option>";
                } else {
 		        $options1 .= "<option>$row[ImprovementType]</option>";
                }
        }
	$smarty->assign('ImprovementTypeOptions',$options1);

        $sql = "SELECT * FROM `FunctionalClassification`";
        $result = $admin->new_mysql($sql);
        while ($row = $result->fetch_assoc()) {
	        if ($row['Classification'] == $_GET['Classification']) {
        	        $options2 .= "<option selected>$row[Classification]</option>";
                } else {
                	$options2 .= "<option>$row[Classification]</option>";
                }
        }
	$smarty->assign('ClassificationOptions',$options2);

	// load projects
	$project_list = $admin->load_project();
	$smarty->assign('ProjectList',$project_list);


	if ($_GET['type'] == "new") {
		$smarty->assign('type','new');
		$smarty->assign('show_form','Yes');
	}

	if ($_SESSION['ProjectID'] != "") {
		$_GET['type'] = "load";
		$_GET['ProjectID'] = $_SESSION['ProjectID'];
	}

	if ($_GET['type'] == "load") {
                        $sql2 = "
                        SELECT
                                p.*,
                                d.`ProjectName`,
                                b.`BLN_Project_Name`

                        FROM `projects` p, `DOT_Project_Names` d, `BLN_Project_Names` b

                        WHERE
                                p.`ProjectID` = '$_GET[ProjectID]'
                                AND `p`.`DOT_Project_Names` = `d`.`id`
                                AND `p`.`BLN_Project_Names` = `b`.`id`
                        ";

                        $result2 = $admin->new_mysql($sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                                foreach ($row2 as $key=>$value) {
                                        $smarty->assign($key,$value);
                                }
                        }

                        $smarty->assign('type','update');
                        $smarty->assign('show_form','Yes');
	}
	
	if ($_POST['type'] == "update") {
                // find BLN number
                $sql = "SELECT * FROM `BLN_Project_Names` WHERE `BLN_Project_Name` = '$_POST[DescriptionCode]'";
                $result = $admin->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $BLN_Project_Name = $row['id'];
                }
                if ($BLN_Project_Name == "") {
                        $sql = "INSERT INTO `BLN_Project_Names` (`BLN_Project_Name`) VALUES ('$_POST[DescriptionCode]')";
                        $result = $admin->new_mysql($sql);
                        $BLN_Project_Name = $admin->linkID->insert_id;
                }

                // find DOT number
                $sql = "SELECT * FROM `DOT_Project_Names` WHERE `ProjectName` = '$_POST[customerNumber]'";
                $result = $admin->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $DOT_Project_Names = $row['id'];
                }
                if ($DOT_Project_Names == "") {
                        $sql = "INSERT INTO `DOT_Project_Names` (`ProjectName`) VALUES ('$_POST[customerNumber]')";
                        $result = $admin->new_mysql($sql);
                        $DOT_Project_Names = $admin->linkID->insert_id;
                }

		// update form
		$sql = "UPDATE `projects` SET `DOT_Project_Names` = '$DOT_Project_Names', `BLN_Project_Names` = '$BLN_Project_Name', `PayItem` = '$_POST[PayItem]', `RouteNum` = '$_POST[RouteNum]', `Location` = '$_POST[Location]',
		`LocFrom` = '$_POST[LocFrom]', `LocTo` = '$_POST[LocTo]', `Length` = '$_POST[Length]', `ImprovementType` = '$_POST[ImprovementType]', `Urban_or_Rural` = '$_POST[Urban_or_Rural]', `Classification` = '$_POST[Classification]',
		`ContractNum` = '$_POST[ContractNum]', `ProjectType` = '$_POST[ProjectType]' WHERE `ProjectID` = '$_POST[ProjectID]'";

		$result = $admin->new_mysql($sql);
		if ($result == "TRUE") {
                        $sql2 = "
                        SELECT
                                p.*,
                                d.`ProjectName`,
                                b.`BLN_Project_Name`

                        FROM `projects` p, `DOT_Project_Names` d, `BLN_Project_Names` b

                        WHERE
                                p.`ProjectID` = '$_POST[ProjectID]'
                                AND `p`.`DOT_Project_Names` = `d`.`id`
                                AND `p`.`BLN_Project_Names` = `b`.`id`
                        ";

                        $result2 = $admin->new_mysql($sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                                foreach ($row2 as $key=>$value) {
                                        $smarty->assign($key,$value);
                                }
                        }

                        $smarty->assign('type','update');
                        $smarty->assign('show_form','Yes');
		} else {
			print "<br><font color=red>There was an error saving the project.<br></font>";
			die;
		}
	}


	if ($_POST['type'] == "save") {
		// find BLN number
		$sql = "SELECT * FROM `BLN_Project_Names` WHERE `BLN_Project_Name` = '$_POST[DescriptionCode]'";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$BLN_Project_Name = $row['id'];
		}
		if ($BLN_Project_Name == "") {
			$sql = "INSERT INTO `BLN_Project_Names` (`BLN_Project_Name`) VALUES ('$_POST[DescriptionCode]')";
			$result = $admin->new_mysql($sql);
			$BLN_Project_Name = $admin->linkID->insert_id;
		}

		// find DOT number
		$sql = "SELECT * FROM `DOT_Project_Names` WHERE `ProjectName` = '$_POST[customerNumber]'";
                $result = $admin->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
			$DOT_Project_Names = $row['id'];
		}
		if ($DOT_Project_Names == "") {
			$sql = "INSERT INTO `DOT_Project_Names` (`ProjectName`) VALUES ('$_POST[customerNumber]')";
                        $result = $admin->new_mysql($sql);
			$DOT_Project_Names = $admin->linkID->insert_id;
		}

		// get state ID
		$sql = "SELECT `default_state` FROM `users` WHERE `id` = '$_SESSION[id]'";
                $result = $admin->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
			$state_id = $row['default_state'];
		}
		if ($state_id == "") {
			print "<br><font color=red>ERROR: You do not have a default state set. Program exit.</font><br>";
		}

		// insert new data
		$sql = "
		INSERT INTO `projects` (`DOT_Project_Names`,`BLN_Project_Names`,`stateID`,`PayItem`,`RouteNum`,`Location`,`LocFrom`,`LocTo`,`Length`,`ImprovementType`,`Urban_or_Rural`,`Classification`,`ContractNum`,`ProjectType`) VALUES
		('$DOT_Project_Names','$BLN_Project_Name','$state_id','$_POST[PayItem]','$_POST[RouteNum]','$_POST[Location]','$_POST[LocFrom]','$_POST[LocTo]','$_POST[Length]','$_POST[ImprovementType]','$_POST[Urban_or_Rural]','$_POST[Classification]',
		'$_POST[ContractNum]','$_POST[ProjectType]')
		";
		$result = $admin->new_mysql($sql);
		if ($result == "TRUE") {
			// load data
			// set form to update
			// show form

			$id = $admin->linkID->insert_id;
			$smarty->assign('id',$id);

			$sql2 = "
			SELECT 
				p.*,
				d.`ProjectName`,
				b.`BLN_Project_Name`

			FROM `projects` p, `DOT_Project_Names` d, `BLN_Project_Names` b

			WHERE 
				p.`ProjectID` = '$id'
				AND `p`.`DOT_Project_Names` = `d`.`id`
				AND `p`.`BLN_Project_Names` = `b`.`id`
			";

			$result2 = $admin->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
				foreach ($row2 as $key=>$value) {
					$smarty->assign($key,$value);
				}
			}

        	        $smarty->assign('type','update');
	                $smarty->assign('show_form','Yes');


		} else {
			print "<br><font color=red>There was an error saving your data. Please click back and try again. Be sure not to use any special charecters.</font><br>";
			die;
		}
	}

	$smarty->display('project_entry.tpl');
} else {
	$smarty->assign('error','You do not have access to read this section');
	$smarty->display('general_error.tpl');
}
?>
