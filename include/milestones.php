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


	switch ($type) {
		case "load":


                $smarty->assign('show_form','Yes');
		if (($_GET['id'] == "") && ($_GET['id2'] == "")) {
			$smarty->assign('new','Yes');
		}
		$smarty->assign('ProjectID',$ProjectID);
		break;
	}








        $smarty->display('milestones.tpl');
} else {
        $smarty->assign('error','You do not have access to read this section');
        $smarty->display('general_error.tpl');
}
?>

