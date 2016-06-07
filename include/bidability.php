<?php
/*
Project Entry Tab
Version 2.0


*/

// TBA
// check if you are allowed to write data
//if ($_SESSION['tab5_write'] == "checked") {
//        $write = "Yes";
//}

// check if you are allowed to read
//if ($_SESSION['tab5_read'] == "checked") {
	$_SESSION['bt'] = "Hlo0G432lth9dW3jck";
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



	$smarty->assign('showform','yes');
	$smarty->display('bidability.tpl');

//} else {
//        $smarty->assign('error','You do not have access to read this section');
//        $smarty->display('general_error.tpl');
//}
?>