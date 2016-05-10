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
if ($_SESSION['tab2_read'] == "checked") {
	$_SESSION['ct'] = "Gl9dW3jck";
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

	if ($_POST['section'] == "addto") {
		$sql = "INSERT INTO `DesignConsultantContact` (`ProjectID`,`DesignConsultant`,`ContactName`,`Email`,`Phone`,`Fax`) VALUES 
		('$_POST[ProjectID]','$_POST[DesignConsultant2]','$_POST[ContactName]','$_POST[Email]','$_POST[Phone]','$_POST[Fax]')";
		$result = $admin->new_mysql($sql);
		if ($result == "TRUE") {
                        $smarty->assign('status','<font color=green>The contact was added.</font>');
		} else {
                        $smarty->assign('status','<font color=red>The contact failed to add.</font>');
		}
	}


	if ($_POST['section'] == "addto2") {
                $sql = "INSERT INTO `DesignConsultantContact` (`ProjectID`,`DesignConsultant`,`ContactName`,`Email`,`Phone`,`Fax`) VALUES
                ('$_POST[ProjectID]','$_POST[DesignConsultant2]','$_POST[ContactName]','$_POST[Email]','$_POST[Phone]','$_POST[Fax]')";
                $result = $admin->new_mysql($sql);
                if ($result == "TRUE") {
                        $smarty->assign('status','<font color=green>The contact was added.</font>');
                } else {
                        $smarty->assign('status','<font color=red>The contact failed to add.</font>');
                }
	}

	if ($_POST['section'] == "addto3") {
		$sql = "INSERT INTO `PlanReviewContact` (`ProjectID`,`ContactName`,`Phone`,`Email`,`Fax`) VALUES ('$_POST[ProjectID]','$_POST[ContactName2]','$_POST[Phone]','$_POST[Email]','$_POST[Fax]')";
                $result = $admin->new_mysql($sql);
                if ($result == "TRUE") {
                        $smarty->assign('status','<font color=green>The contact was added.</font>');
                } else {
                        $smarty->assign('status','<font color=red>The contact failed to add.</font>');
                }

	}

	// save new form
	if ($_POST['section'] == "save") {
		$status = $admin->save_contact($_POST['part']);
		if ($status == "TRUE") {
			$smarty->assign('status','<font color=green>The '.$_POST['part'].' contact was saved.</font>');
		} else {
			$smarty->assign('status','<font color=red>The '.$_POST['part'].' contact failed to save.</font>');
		}
	}

	// update
        if ($_POST['section'] == "update") {
		if ($_POST['delete'] == "checked") {
			$status = $admin->delete_contact($_POST['part']);
                        if ($status == "TRUE") {
                                $smarty->assign('status','<font color=green>The '.$_POST['part'].' contact was deleted.</font>');
                        } else {
                                $smarty->assign('status','<font color=red>The '.$_POST['part'].' contact failed to deleted.</font>');
                        }

		}

		if ($_POST['delete'] == "") {
	                $status = $admin->update_contact($_POST['part']);
        	        if ($status == "TRUE") {
                	        $smarty->assign('status','<font color=green>The '.$_POST['part'].' contact was updated.</font>');
	                } else {
        	                $smarty->assign('status','<font color=red>The '.$_POST['part'].' contact failed to update.</font>');
	                }
		}
        }


	switch ($type) {
		case "load":

		// load design contacts
		$sql = "SELECT * FROM `DesignConsultantContact` WHERE `ProjectID` = '$ProjectID'";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html1 .= "<tr><td>$row[DesignConsultant]</td><td>$row[ContactName]</td>
				<td>
				<form action=\"index.php\" method=\"get\" style=\"display:inline\">
				<input type=\"hidden\" name=\"action\" value=\"contacts\">
				<input type=\"hidden\" name=\"type\" value=\"load\">
				<input type=\"hidden\" name=\"ProjectID\" value=\"$ProjectID\">
				<input type=\"hidden\" name=\"id\" value=\"$row[ConsultantID]\">
				<input type=\"submit\" value=\"View\">
				</form></td></tr>";
		}
		$smarty->assign('html1',$html1);

		// load review
		$sql = "SELECT * FROM `PlanReviewContact` WHERE `ProjectID` = '$ProjectID'";
                $result = $admin->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $html2 .= "<tr><td>$row[ContactName]</td>
                                <td>
                                <form action=\"index.php\" method=\"get\" style=\"display:inline\">
                                <input type=\"hidden\" name=\"action\" value=\"contacts\">
                                <input type=\"hidden\" name=\"type\" value=\"load\">
                                <input type=\"hidden\" name=\"ProjectID\" value=\"$ProjectID\">
                                <input type=\"hidden\" name=\"id2\" value=\"$row[ContactID]\">
                                <input type=\"submit\" value=\"View\">
                                </form></td></tr>";
                }
                $smarty->assign('html2',$html2);


                $smarty->assign('show_form','Yes');
		if (($_GET['id'] == "") && ($_GET['id2'] == "")) {
			$smarty->assign('new','Yes');

		} else {
			// Load Design Contact
			if ($_GET['id'] != "") {
				$smarty->assign('form','top');
				$smarty->assign('id',$_GET['id']);
				$sql = "SELECT * FROM `DesignConsultantContact` WHERE `ConsultantID` = '$_GET[id]'";
				$result = $admin->new_mysql($sql);
				while ($row = $result->fetch_assoc()) {
					foreach ($row as $key=>$value) {
						$smarty->assign($key,$value);
					}
				}
			}

			// Load Review
			if ($_GET['id2'] != "") {
	                        $smarty->assign('form','bot');
        	                $smarty->assign('id2',$_GET['id2']);
				$sql = "SELECT * FROM `PlanReviewContact` WHERE `ContactID` = '$_GET[id2]'";
                        	$result = $admin->new_mysql($sql);
	                        while ($row = $result->fetch_assoc()) {
        	                        foreach ($row as $key=>$value) {
                	                        $smarty->assign($key,$value);
                        	        }
	                        }
			}
		}
		$smarty->assign('ProjectID',$ProjectID);
		break;
	}








        $smarty->display('contacts.tpl');
} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>

