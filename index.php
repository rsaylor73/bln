<?php
session_start();
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";

if ($_GET['ProjectID'] != "") {
	$_SESSION['ProjectID'] = $_GET['ProjectID'];
}

$sql = "SELECT `state`.`state_abbr` FROM `state`,`users` WHERE `users`.`id` = '$_SESSION[id]' AND `users`.`default_state` = `state`.`state_id`";
$result = $admin->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	$dot = "$row[state_abbr] DOT Tracker";
}

$smarty->display('header.tpl');
$smarty->assign('state_header',$dot);
$smarty->display('application_top.tpl');

$check_login = $admin->check_login();
if ($check_login == "TRUE") {

        if (($_GET['menu'] == "") && ($_POST['menu'] == "")) {
		// load permission node TBD

                $admin->dashboard();
        }

	// Tab 1
	if (($_GET['action'] == "pe") OR ($_POST['action'] == "pe")) {
		include "include/project_entry.php";
	}

	// Tab 2
	if (($_GET['action'] == "contacts") OR ($_POST['action'] == "contacts")) {
		include "include/contacts.php";
	}

	// Tab 3
	if (($_GET['action'] == "milestones") OR ($_POST['action'] == "milestones")) {
		include "include/milestones.php";
	}

	// Tab 6
	if (($_GET['action'] == "constructability") OR ($_POST['action'] == "constructability")) {
		include "include/constructability.php";
	}

        if ($_GET['action'] == "profile") {
                $admin->profile();
        }
        if ($_POST['action'] == "save_profile") {
                $admin->save_profile();
        }
        if ($_GET['action'] == "manage_users") {
                $admin->manage_users();
        }
        if ($_GET['action'] == "new_user") {
                $admin->new_user();
        }
        if ($_POST['action'] == "save_user") {
                $admin->save_user();
        }
        if ($_GET['action'] == "edit_user") {
                $admin->edit_user();
        }
        if ($_POST['action'] == "update_user") {
                $admin->update_user();
        }
        if ($_GET['action'] == "delete_user") {
                $admin->delete_user();
        }
        if ($_GET['action'] == "security_tab") {
                $admin->security_tab();
        }
        if ($_POST['action'] == "security_tab") {
                $admin->security_tab2();
        }
        if ($_GET['action'] == "reports") {
                $admin->reports();
        }
        if ($_GET['action'] == "logout") {
                $admin->logout();
        }
	if ($_GET['action'] == "user_states") {
		$admin->user_states();
	}
	if ($_POST['action'] == "state_access") {
		$admin->state_access();
	}
	if ($_GET['action'] == "change_state") {
		$admin->change_state();
	}
	if ($_POST['action'] == "change_state") {
		$admin->save_change_state();
	}
	if ($_GET['action'] == "c_tabs") {
		$admin->c_tabs();
	}
	if ($_POST['action'] == "c_tabs") {
		$admin->c_tabs();
	}
	if ($_GET['action'] == "c_categories") {
		$admin->c_categories();
	}
	if ($_POST['action'] == "c_categories") {
		$admin->c_categories();
	}
	if ($_POST['action'] == "c_questions") {
		$admin->c_questions();
	}
	if ($_GET['action'] == "c_questions") {
		$admin->c_questions();
	}
	if ($_POST['action'] == "c_questions_add") {
		$admin->c_questions_add();
	}

} else {
        $admin->login($null);
}





$smarty->display('application_bot.tpl');

?>
