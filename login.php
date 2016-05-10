<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";


$sql = "SELECT * FROM `users` WHERE `uuname` = '$_GET[uuname]' AND `uupass` = '$_GET[uupass]' AND `active` = 'Yes'";
$result = $admin->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	foreach ($row as $key=>$value) {
		$_SESSION[$key] = $value;
	}
	$found = "1";
}


if ($found == "1") {
	$settings = $admin->get_settings();
	// load security settings
	$sql2 = "SELECT * FROM `security_table` WHERE `userID` = '$_SESSION[id]'";
	$result2 = $admin->new_mysql($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		switch ($row2['tab']) {
			case "1":
				$_SESSION['tab1_read'] = $row2['read'];
				$_SESSION['tab1_write'] = $row2['write'];
			break;

			case "2":
                                $_SESSION['tab2_read'] = $row2['read'];
                                $_SESSION['tab2_write'] = $row2['write'];
			break;

			case "3":
                                $_SESSION['tab3_read'] = $row2['read'];
                                $_SESSION['tab3_write'] = $row2['write'];
			break;

			case "4":
                                $_SESSION['tab4_read'] = $row2['read'];
                                $_SESSION['tab4_write'] = $row2['write'];
			break;

			case "5":
                                $_SESSION['tab5_read'] = $row2['read'];
                                $_SESSION['tab5_write'] = $row2['write'];
			break;
		}
	}

	//bypass landing page -kjg
	echo '<script>
		window.location = "index.php";
	</script>';
	//print "You have been logged in. Click <a href=\"index.php\">here</a> to continue.<br>";
} else {
	$admin->login('<font color=red>The username and or password was incorrect.</font>');
}
?>
