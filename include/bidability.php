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


	if ($ProjectID != "") {
		$smarty->assign('showform','yes');
	}

	// insert data
	if ($_POST['id'] != "") {
		// test if insert or update
		$found = "0";
		$sql = "SELECT `id` FROM `Bidability` WHERE `id` = '$_POST[id]'";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
		}
		$p = $_POST;

		switch ($found) {
			case "0":
			// insert
			$sql = "INSERT INTO `Bidability` (`ProjectID`,`q1a`,`q1b`,`q1c`,`q2a`,`q2b`,`q2c`,`q3a`,`q3b`,`q4a`,`q4b`,`q5a`,`q5b`,`q6a`,`q6b`,`q7a`,`q7b`,`q7c`,`q7d`,`q8a`,`q8b`,`q9a`,`q9b`,`q10a`,`q10b`,
			`q11a`,`q11b`,`q12a`,`q13a`,`q14a`,`q15a`,`q16a`,`q17a`) VALUES

			('$p[ProjectID]','$p[q1a]','$p[q1b]','$p[q1c]','$p[q2a]','$p[q2b]','$p[q2c]','$p[q3a]','$p[q3b]','$p[q4a]','$p[q4b]','$p[q5a]','$p[q5b]','$p[q6a]','$p[q6b]','$p[q7a]','$p[q7b]','$p[q7c]',
			'$p[q7d]','$p[q8a]','$p[q8b]','$p[q9a]','$p[q9b]','$p[q10a]','$p[q10b]','$p[q11a]','$p[q11b]','$p[q12a]','$p[q13a]','$p[q14a]','$p[q15a]','$p[q16a]','$p[q17a]')

			";

			break;

			case "1":
			// update
			$sql = "UPDATE `Bidability` SET 
			`q1a` = '$p[q1a]',
			`q1b` = '$p[q1b]', 
			`q1c` = '$p[q1c]', 
			`q2a` = '$p[q2a]', 
			`q2b` = '$p[q2b]', 
			`q2c` = '$p[q2c]', 
			`q3a` = '$p[q3a]', 
			`q3b` = '$p[q3b]', 
			`q4a` = '$p[q4a]', 
			`q4b` = '$p[q4b]', 
			`q5a` = '$p[q5a]', 
			`q5b` = '$p[q5b]', 
			`q6a` = '$p[q6a]', 
			`q6b` = '$p[q6b]', 
			`q7a` = '$p[q7a]', 
			`q7b` = '$p[q7b]', 
			`q7c` = '$p[q7c]', 
			`q7d` = '$p[q7d]', 
			`q8a` = '$p[q8a]', 
			`q8b` = '$p[q8b]', 
			`q9a` = '$p[q9a]', 
			`q9b` = '$p[q9b]', 
			`q10a` = '$p[q10a]', 
			`q10b` = '$p[q10b]', 
			`q11a` = '$p[q11a]', 
			`q11b` = '$p[q11b]', 
			`q12a` = '$p[q12a]', 
			`q13a` = '$p[q13a]', 
			`q14a` = '$p[q14a]', 
			`q15a` = '$p[q15a]', 
			`q16a` = '$p[q16a]', 
			`q17a` = '$p[q17a]'

			WHERE `ProjectID` = '$ProjectID'
			";

			break;
		}
		$result = $admin->new_mysql($sql);
		if ($result == "TRUE") {
			$smarty->assign('msg','<div class="alert alert-success" role="alert"><strong>Success</strong> The record was updated.</div>');
		} else {
			$smarty->assign('msg','<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> There was a MySQL error!</div>');
		}


	}
	$smarty->assign('default','<option value="">Select</option>');
	// load data
	if ($ProjectID != "") {
		$sql = "SELECT * FROM `Bidability` WHERE `ProjectID` = '$ProjectID'";
		$result = $admin->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$smarty->assign('q1a',"<option selected>$row[q1a]</option>");
			$smarty->assign('q1b',"$row[q1b]");
			$smarty->assign('q1c',"$row[q1c]");

			$smarty->assign('q2a',"<option selected>$row[q2a]</option>");
			$smarty->assign('q2b',"$row[q2b]");
			$smarty->assign('q2c',"$row[q2c]");

			$smarty->assign('q3a',"<option selected>$row[q3a]</option>");
			$smarty->assign('q3b',"$row[q3b]");

			$smarty->assign('q4a',"<option selected>$row[q4a]</option>");
			$smarty->assign('q4b',"$row[q4b]");

			$smarty->assign('q5a',"<option selected>$row[q5a]</option>");
			$smarty->assign('q5b',"$row[q5b]");

			$smarty->assign('q6a',"<option selected>$row[q6a]</option>");
			$smarty->assign('q6b',"$row[q6b]");

			$smarty->assign('q7a',"<option selected>$row[q7a]</option>");
			$smarty->assign('q7b',"<option selected>$row[q7b]</option>");
			$smarty->assign('q7c',"<option selected>$row[q7c]</option>");
			$smarty->assign('q7d',"$row[q7d]");

			$smarty->assign('q8a',"<option selected>$row[q8a]</option>");
			$smarty->assign('q8b',"$row[q8b]");

			$smarty->assign('q9a',"<option selected>$row[q9a]</option>");
			$smarty->assign('q9b',"$row[q9b]");

			$smarty->assign('q10a',"<option selected>$row[q10a]</option>");
			$smarty->assign('q10b',"$row[q10b]");

			$smarty->assign('q11a',"<option selected>$row[q11a]</option>");
			$smarty->assign('q11b',"$row[q11b]");

			$smarty->assign('q12a',"<option selected>$row[q12a]</option>");

			$smarty->assign('q13a',"<option selected>$row[q13a]</option>");

			$smarty->assign('q14a',"<option selected>$row[q14a]</option>");

			$smarty->assign('q15a',"<option selected>$row[q15a]</option>");

			$smarty->assign('q16a',"<option selected>$row[q16a]</option>");

			$smarty->assign('q17a',"<option selected>$row[q17a]</option>");

		}
	}

	// test
	//$smarty->assign('q1a',"<option selected>No</option>");


	$smarty->display('bidability.tpl');

//} else {
//        $smarty->assign('error','You do not have access to read this section');
//        $smarty->display('general_error.tpl');
//}
?>