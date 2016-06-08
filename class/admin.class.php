<?php

if( !class_exists( 'Admin')) {
class Admin {
        public $linkID;


        function __construct($linkID){ $this->linkID = $linkID; }

        /*
        The function is set to only allow mysql calls to be driven
        from inside this class.
        */

        public function new_mysql($sql) {
                $result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
                return $result;
        }


        // check login system
        public function check_login() {
                $sql = "SELECT `users`.`id` FROM `users` WHERE `users`.`uuname` = '$_SESSION[uuname]' AND `users`.`uupass` = '$_SESSION[uupass]' AND `users`.`active` = 'Yes'";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $found = "1";
                }
                if ($found == "1") {
                        return "TRUE";
                } else {
                        return "FALSE";
                }
        }

	public function load_smarty($vars,$template) {
		require_once('libs/Smarty.class.php');
			$smarty=new Smarty();
			$smarty->setTemplateDir('templates/');
			$smarty->setCompileDir('templates_c/');
			$smarty->setConfigDir('configs/');
			$smarty->setCacheDir('cache/');
		if (is_array($vars)) {
			foreach ($vars as $key=>$value) {
				$smarty->assign($key,$value);
			}
		}
		$smarty->display($template);

	}

	public function logout() {
		session_destroy();
                $this->login('<font color=green><br>You have been logged out.</font>');
	}


	public function save_contact($type) {

		switch ($type) {
			case "designer":
				$sql = "INSERT INTO `DesignConsultantContact` (`ProjectID`,`DesignConsultant`,`ContactName`,`Email`,`Phone`,`Fax`) VALUES
				('$_POST[ProjectID]','$_POST[DesignConsultant]','$_POST[ContactName]','$_POST[Email]','$_POST[Phone]','$_POST[Fax]')";
				$result = $this->new_mysql($sql);
				if ($result == "TRUE") {
					return "TRUE";
				} else {
					return "FALSE";
				}
			break;

			case "review":
				$sql = "INSERT INTO `PlanReviewContact` (`ProjectID`,`ContactName`,`Phone`,`Email`,`Fax`) VALUES ('$_POST[ProjectID]','$_POST[ContactName]','$_POST[Phone]','$_POST[Email]','$_POST[Fax]')";
                                $result = $this->new_mysql($sql);
                                if ($result == "TRUE") {
                                        return "TRUE";
                                } else {
                                        return "FALSE";
                                }
			break;

			default:
			return "FALSE";
			break;

		}


	}

	public function update_contact($type) {
		switch ($type) {
			case "designer":
				$sql = "UPDATE `DesignConsultantContact` SET `DesignConsultant` = '$_POST[DesignConsultant]', `ContactName` = '$_POST[ContactName]', `Email` = '$_POST[Email]', `Phone` = '$_POST[Phone]', `Fax` = '$_POST[Fax]'
				WHERE `ConsultantID` = '$_POST[id]'";
                                $result = $this->new_mysql($sql);
                                if ($result == "TRUE") {
                                        return "TRUE";
                                } else {
                                        return "FALSE";
                                }
			break;

			case "review":
				$sql = "UPDATE `PlanReviewContact` SET `ContactName` = '$_POST[ContactName]', `Phone` = '$_POST[Phone]', `Email` = '$_POST[Email]', `Fax` = '$_POST[Fax]' WHERE `ContactID` = '$_POST[id2]'";
                                $result = $this->new_mysql($sql);
                                if ($result == "TRUE") {
                                        return "TRUE";
                                } else {
                                        return "FALSE";
                                }
			break;

                        default:
                        return "FALSE";
                        break;

		}
	}

	public function delete_contact($type) {
                switch ($type) {
                        case "designer":
				$sql = "DELETE FROM `DesignConsultantContact` WHERE `ConsultantID` = '$_POST[id]'";
                                $result = $this->new_mysql($sql);
                                if ($result == "TRUE") {
                                        return "TRUE";
                                } else {
                                        return "FALSE";
                                }

                        break;

			case "review":
				$sql = "DELETE FROM `PlanReviewContact` WHERE `ContactID` = '$_POST[id2]'";
                                $result = $this->new_mysql($sql);
                                if ($result == "TRUE") {
                                        return "TRUE";
                                } else {
                                        return "FALSE";
                                }
			break;

                        default:
                        return "FALSE";
                        break;
		}
	}

	public function reports() {
                if ($_SESSION['userType'] == "admin") {

			print "<h2>Reports</h2>";

			print "<form action=\"reports.php\" method=\"post\" target=_blank>
			<table class=\"table\">
			<tr><td>Report Type:</td><td><select name=\"report_type\">
				<option value=\"1\">Anticipated Projects</option>
				<option value=\"2\">Average Time of Review - Summary Report</option>
				<option value=\"3\">Design Deficiency Summary</option>
				<option value=\"4\">Design Deficiency Summary By Project Owner</option>
				<option value=\"5\">Reviews Pending</option>
				<option value=\"6\">Time of Review - Detail Report</option>
				<option value=\"7\">Ratings Report</option>
				</select></td></tr>
			<tr><td>Project Owner:</td><td><select name=\"project_owner\"><option value=\"dot\">DOT</option><option value=\"local\">Local Agency</option><option value=\"all\" selected>All</option></td></tr>
			<tr><td>Start Date:</td><td><input type=\"text\" id=\"date1\" name=\"date1\"></td></tr>
			<tr><td>End Date:</td><td><input type=\"text\" id=\"date2\" name=\"date2\"></td></tr>
                        <tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Generate Report\"></td></tr>
			</table>
			</form>
			";

                } else {
                        $this->access_deny();
                }
	}

        // Login form
        public function login($msg) {

		$data = array();
                if ($msg != "") {
			$data['msg'] = "$msg";	
                } else {
			$data['msg'] = "0";
		}
		$template = "login.tpl";
		$this->load_smarty($data,$template);
        }




        // User Dashboard
        public function dashboard() {
		// The same dashboard is used and the dashboard loads based on the member type.
                switch ($_SESSION['userType']) {
                        case "admin":
			case "member":
                        $this->dashboard_admin();
                        break;
                }
        }

        // Admin Dashboard
        private function dashboard_admin() {
                $temp = rand(50,50000);
                include "dashboard_admin.php";
        }


	public function change_state() {
		$sql = "
		SELECT
			`state`.`state_id`,
			`state`.`state`
		FROM
			`state_access`,`state`
		WHERE
			`state_access`.`userID` = '$_SESSION[id]'
			AND `state_access`.`stateID` = `state`.`state_id`
		ORDER BY `state`.`state` ASC
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[state_id]\">$row[state]</option>";
		}
		if ($options == "") {
			print "<br><font color=red>ERROR: Please ask an administrator to assign one or more states to your account.</font><br>";
			die;
		}
		print "
		<h2>Please select your default state to work with:</h2>
		<form action=\"index.php\" method=\"post\">
		<input type=\"hidden\" name=\"action\" value=\"change_state\">
		Select Default State: <select name=\"default_state\">$options</select> <input type=\"submit\" value=\"Save\" class=\"btn btn-primary\"></form><br>
		";
		
	}

	public function save_change_state() {
		$sql = "UPDATE `users` SET `default_state` = '$_POST[default_state]' WHERE `id` = '$_SESSION[id]'";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			print "<br><font color=green>State was updated. Loading...</font><br>";
			print "<br><br>If the screen does not refresh please click <a href=\"index.php\">here</a><br>";
			print '<meta http-equiv="refresh" content="2; url=index.php">';
		} else {
			print "<br><font color=red>There was a MySQL error updating your default state.</font><br>";
		}

	}

	public function load_project() {
                $sql = "SELECT `default_state` FROM `users` WHERE `id` = '$_SESSION[id]'";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $default_state = $row['default_state'];
                }
                if ($default_state == "") {
                        print "<br><font color=red>ERROR: you do not have a default state set.</font>";
                        die;
                }


		$sql = "
		SELECT 
			d.`id`,
			d.`ProjectName` 

		FROM 
			`DOT_Project_Names` d,
			`projects` p

		WHERE
			d.`id` = `p`.`DOT_Project_Names`
			AND p.`stateID` = '$default_state'

		GROUP BY d.`id`

		ORDER BY d.`ProjectName` ASC

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[id]\">$row[ProjectName]</option>";
		}
		return $options;

	}

        public function get_settings() {
                // settings
                $sql = "SELECT * FROM `settings` WHERE `id` = '1'";
                $result = $this->new_mysql($sql);
                $row = $result->fetch_assoc();

                $sitename = $row['sitename'];
                $siteurl = $row['siteurl'];
                $site_email = $row['site_email'];
                $base_path = $row['base_path'];
                
                // email headers - This is fine tuned, please do not modify
                $header = "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $header .= "From: $sitename <$site_email>\r\n";
                $header .= "Reply-To: $sitename <$site_email>\r\n";
                $header .= "X-Priority: 3\r\n";
                $header .= "X-Mailer: PHP/" . phpversion()."\r\n";

                $data = array();
                $data[] = $sitename;
                $data[] = $siteurl;
                $data[] = $site_email;
                $data[] = $header;
                $data[] = $base_path;

                return $data;
        }


	public function new_user() {
		if ($_SESSION['userType'] == "admin") {
                        print "
                        <br><h2>New User</h2>
                        <form action=\"index.php\" method=\"post\">
                        <input type=\"hidden\" name=\"action\" value=\"save_user\">
                        <table class=\"table\">
                        <tr><td>First Name:</td><td><input type=\"text\" name=\"first\" value=\"$row[first]\" size=40></td></tr>
                        <tr><td>Last Name:</td><td><input type=\"text\" name=\"last\" value=\"$row[last]\" size=40></td></tr>
                        <tr><td>Email:</td><td><input type=\"text\" name=\"email\" value=\"$row[email]\" size=40></td></tr>
                        <tr><td>Username:</td><td><input type=\"text\" name=\"uuname\" placeholder=\"Must be unique\" size=40></td></tr>
                        <tr><td>Password:</td><td><input type=\"text\" name=\"uupass\" value=\"$row[uupass]\" size=40></td></tr>
                        <tr><td>Member Type:</td><td><select name=\"userType\"><option selected>$row[userType]</option><option>member</option><option>admin</option></select></td></tr>
                        <tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Save User\"></td></tr>
                        </table>
                        </form>
                        ";
                } else {
                        $this->access_deny();
                }

	}
	public function get_c_tabs($id) {
		if ($id == "") {
			$opt .= "<option selected value=\"\">--Select--</option>";
		}
		$sql = "SELECT * FROM `construction_tabs`";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($id == $row['id']) {
				$opt .= "<option selected value=\"$row[id]\">$row[name]</option>";
			} else {
				$opt .= "<option value=\"$row[id]\">$row[name]</option>";
			}
		}
		return $opt;
	}

	public function c_questions_add() {
		$sql = "INSERT INTO `construction_questions` (`tabID`,`categoryID`,`question`) VALUES ('$_POST[tabID]','$_POST[category]','$_POST[question]')";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			print "Question was added. Loading...<br>";
                        print '<meta http-equiv="refresh" content="2; url=index.php?action=c_questions">';
		} else {
			print "<br><font color=red>Sorry, there was an error saving your question.</font><br>";
		}
	}

	public function c_questions() {

		if ($_POST['section'] == "update") {
	                $sql = "
        	        SELECT 
                	        `ct`.`name`,
                        	`cc`.`category`,
	                        `cq`.`question`,
        	                `cq`.`id`
                	FROM
                        	`construction_questions` cq, `construction_tabs` ct, `construction_categories` cc
	                WHERE
        	                `cq`.`tabID` = `ct`.`id`
                	        AND `cq`.`categoryID` = `cc`.`id`
	                ";
	                $result = $this->new_mysql($sql);
	                while ($row = $result->fetch_assoc()) {
				$i = "delete_";
				$i .= $row['id'];
				$delete = $_POST[$i];

				if ($delete == "checked") {
					$sql2 = "DELETE FROM `construction_questions` WHERE `id` = '$row[id]'";
					$result2 = $this->new_mysql($sql2);
				} else {
					$i = "question_";
					$i .= $row['id'];
					$question = $_POST[$i];
					$sql2 = "UPDATE `construction_questions` SET `question` = '$question' WHERE `id` = '$row[id]'";
					$result2 = $this->new_mysql($sql2);
				}
			}
		}


		$tabs = $this->get_c_tabs($null);

                print "<br><h2>Manage Constructability Questions</h2>
		<b>Add New:</b>
		<form name=\"myform\" method=\"post\">
                <input type=\"hidden\" name=\"action\" value=\"c_questions_add\"> 
		<table class=\"table\">
		<tr>
			<td width=200>Select Tab:</td><td><select name=\"tabID\" onchange=\"get_c_cats(this.form)\">$tabs</select></td>
		</tr>
		</table>
		<div id=\"c_cat\">
		</div>
		</form>
		";


		?>
		<script>
                                function get_c_cats(myform) {
                                        $.get('get_cats.php',
                                        $(myform).serialize(),
                                        function(php_msg) {
                                                $("#c_cat").html(php_msg);
                                        });
                                 }
		</script>
		<?php


		print "<h2>Existing Questions</h2>
		<form action=\"index.php\" method=\"post\">
		<input type=\"hidden\" name=\"action\" value=\"c_questions\">
		<input type=\"hidden\" name=\"section\" value=\"update\">
		<table class=\"table\">
		<tr><td><b>Tab</b></td><td><b>Category</b></td><td><b>Question</b></td></tr>
		";
		$sql = "
		SELECT
			`ct`.`name`,
			`cc`.`category`,
			`cq`.`question`,
			`cq`.`id`
		FROM
			`construction_questions` cq, `construction_tabs` ct, `construction_categories` cc
		WHERE
			`cq`.`tabID` = `ct`.`id`
			AND `cq`.`categoryID` = `cc`.`id`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			print "<tr><td>$row[name]</td><td>$row[category]</td><td><input type=\"text\" name=\"question_$row[id]\" value=\"$row[question]\" size=40> 
			<input type=\"checkbox\" name=\"delete_$row[id]\" value=\"checked\" onclick=\"return confirm('You are about to delete question $row[question]. Click Ok to confirm.')\"> Delete</td></tr>";
			$found = "1";
		}
		if ($found != "1") {
			print "</tr><td colspan=4>Sorry, you do not have any questions. Please add some.</td></tr>";
		} else {
			print "<tr><td colspan=4><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\"></td></tr>";
		}
		print "</table></form>";
	
	}

	public function c_categories() {

                $sql = "SELECT * FROM `construction_categories`";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
			$i = "delete";
			$i .= $row['id'];
			$delete = $_POST[$i];
			if ($delete == "checked") {
				$sql2 = "DELETE FROM `construction_categories` WHERE `id` = '$row[id]'";
				$result2 = $this->new_mysql($sql2);
			} else {
				$i = "category";
				$i .= $row['id'];
				$category = $_POST[$i];

				$i = "tabID";
				$i .= $row['id'];
				$tab = $_POST[$i];

				if (($category != "") && ($tab != "")) {
					$sql2 = "UPDATE `construction_categories` SET `category` = '$category', `tabID` = '$tab' WHERE `id` = '$row[id]'";
        	                        $result2 = $this->new_mysql($sql2);
				}
			}
		}

		if (($_POST['category'] != "") && ($_POST['tab'] != "")) {
			$sql = "INSERT INTO `construction_categories` (`category`,`tabID`) VALUES ('$_POST[category]','$_POST[tab]')";
			$result = $this->new_mysql($sql);
		}



		$tabs = $this->get_c_tabs($null);

		print "<br><h2>Manage Constructability Categories</h2>
	
		<form action=\"index.php\" method=\"post\">
		<input type=\"hidden\" name=\"action\" value=\"c_categories\">
		<table class=\"table\">
		<tr><td>Select Constructability Tab: <select name=\"tab\">$tabs</select></td>
		<td><input type=\"text\" name=\"category\" size=40 placeholder=\"Type in category name\"> <input type=\"submit\" value=\"Add Category\" class=\"btn btn-primary\"></td></tr>

		
		<tr><td colspan=2><hr><h2>Existing Categories</h2></td></tr>
		";

		$sql = "SELECT * FROM `construction_categories`";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$opt2 = $this->get_c_tabs($row['tabID']);
			print "<tr><td><select name=\"tabID$row[id]\">$opt2</select></td><td><input type=\"text\" name=\"category$row[id]\" value=\"$row[category]\" size=40> 
			<input type=\"checkbox\" name=\"delete$row[id]\" value=\"checked\" onclick=\"return confirm('This will delete the category $row[category]. click Ok to confirm.')\"> Delete</td></tr>";	
		}


		print "	
		<tr><td colspan=2><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\"></td></tr>
		</table>
		</form>
		";	
	}


	public function c_tabs() {
                if ($_SESSION['userType'] == "admin") {

			// update
                        $sql3 = "SELECT * FROM `construction_tabs`";
                        $result3 = $this->new_mysql($sql3);
                        while ($row3 = $result3->fetch_assoc()) {
				$i = "delete_";
				$i .= $row3['id'];
				$delete = $_POST[$i];
				if ($delete == "checked") {
					$sql2 = "DELETE FROM `construction_tabs` WHERE `id` = '$row3[id]'";
					$result2 = $this->new_mysql($sql2);
				} else {
					$i = "name_";
					$i .= $row3['id'];
					$name = $_POST[$i];
					if ($name != "") {
						$sql2 = "UPDATE `construction_tabs` SET `name` = '$name' WHERE `id` = '$row3[id]'";
						$result2 = $this->new_mysql($sql2);
					}
				}
			}

			// insert
			if ($_POST['name'] != "") {
				$sql = "INSERT INTO `construction_tabs` (`name`) VALUES ('$_POST[name]')";
				$result = $this->new_mysql($sql);
			}

			print "<br><h2>Manage Constructability Tabs</h2><br>
			<form action=\"index.php\" method=\"post\">
			<input type=\"hidden\" name=\"action\" value=\"c_tabs\"> 
			<input type=\"text\" name=\"name\" size=40> 
			<input type=\"submit\" class=\"btn btn-primary\" value=\"Add\">
			<hr>";
			print "<hr><b>Existing Tabs</b><br>";
			$sql = "SELECT * FROM `construction_tabs`";
			$result = $this->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				print "<input type=\"text\" name=\"name_$row[id]\" value=\"$row[name]\" size=40> 
				<input type=\"checkbox\" name=\"delete_$row[id]\" value=\"checked\" onclick=\"return confirm('Only delete tabs that contain no data. Click Ok to delete.')\"> Delete?<br>";
				$found = "1";
			}
			if ($found == "1") {
				print "<br><input type=\"submit\" value=\"Update\" class=\"btn btn-primary\">";
			} else {
				print "<br><font color=blue>There are no tabs.</font><br>";
			}
			print "</form>";	


		}
	}

	public function generate_construction($projectID) {
		// test if data exists
		$sql = "SELECT `id` FROM `Constructability` WHERE `projectID` = '$projectID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
		}
		

		if ($found != "1") {
			$sql = "SELECT * FROM `construction_questions`";
			$result = $this->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				$sql2 = "INSERT INTO `Constructability` (`projectID`,`tabID`,`categoryID`,`question`) VALUES ('$projectID','$row[tabID]','$row[categoryID]','$row[question]')";
				$result2 = $this->new_mysql($sql2);
			}
		}

	}


	public function manage_users() {
		if ($_SESSION['userType'] == "admin") {
			print "<br><h2>Manage Users</h2>
			<input type=\"button\" value=\"Add New User\" onclick=\"document.location.href='index.php?action=new_user'\">
			<table class=\"table\">
			<tr>
				<td><b>Name</b></td>
				<td><b>User Type</b></td>
				<td colspan=4><b>Actions</b></td>
			</tr>";
			$sql = "SELECT * FROM `users` ORDER BY `last` ASC, `first` ASC";
	                $result = $this->new_mysql($sql);
        	        while ($row = $result->fetch_assoc()) {
				print "<tr>
					<td>$row[first] $row[last]</td>
					<td>$row[userType]</td>
					<td><a href=\"index.php?action=security_tab&id=$row[id]\">Manage Security</a></td>
					<td><a href=\"index.php?action=user_states&id=$row[id]\">Manage States</a></td>
					<td><a href=\"index.php?action=edit_user&id=$row[id]\">Edit</a></td>
					";
					if ($row['uuname'] != "admin") {
						print "<td><a href=\"index.php?action=delete_user&id=$row[id]\" onclick=\"return confirm('Click OK to delete $row[first] $row[last]')\">Delete</a></td>";
					} else {
						print "<td>&nbsp;</td>";
					}
				print "
				</tr>";
			}
			print "</table>";


		} else {
			$this->access_deny();
		}		
	}

	public function user_states() {
                if ($_SESSION['userType'] == "admin") {
                        $sql = "SELECT * FROM `users` WHERE `id` = '$_GET[id]'";
                        $result = $this->new_mysql($sql);
                        $row = $result->fetch_assoc();
                        print "<h2><a href=\"index.php?action=manage_users\">Users</a> : State Access : $row[first] $row[last]</h2>
                        <form action=\"index.php\" method=\"post\">
                        <input type=\"hidden\" name=\"id\" value=\"$_GET[id]\">
                        <input type=\"hidden\" name=\"action\" value=\"state_access\">
			<table class=\"table\">
			<tr>
				<td><b>State</b></td><td><b>Enabled</b></td>
                                <td><b>State</b></td><td><b>Enabled</b></td>
			</tr>";

			$sql2 = "SELECT * FROM `state` ORDER BY `state` ASC";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {

				if ($counter == "0") {
					$x++;
                                	if ($x % 2) {
	                                        $bgcolor="bgcolor=#C0C0C0";
        	                        } else {
                	                        $bgcolor="bgcolor=#FFFFFF";
                        	        }


					print "<tr $bgcolor>";
				}
				$counter++;


				print "<td>$row2[state]</td>";
				$sql3 = "SELECT `access` FROM `state_access` WHERE `state_access`.`stateID` = '$row2[state_id]' AND `state_access`.`userID` = '$_SESSION[id]'";
				$result3 = $this->new_mysql($sql3);
				$checked = "";
				while ($row3 = $result3->fetch_assoc()) {
					if ($row3['access'] == "Yes") {
						$checked = "checked";
					}
				}
				print "<td><input type=\"checkbox\" name=\"state_$row2[state_id]\" value=\"checked\" $checked></td>"; 

				if ($counter == "2") {
					print "</tr>";
					$counter = "0";
				}
			}

			print "<tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Save\"></td></tr>";
			print "</table></form>";

                } else {
                        $this->access_deny();
                }
	}

	public function state_access() {
                        $sql = "DELETE FROM `state_access` WHERE `userID` = '$_POST[id]'";
                        $result = $this->new_mysql($sql);

                        $sql2 = "SELECT * FROM `state` ORDER BY `state` ASC";
                        $result2 = $this->new_mysql($sql2);


                        while ($row2 = $result2->fetch_assoc()) {
				$i = "state_";
				$i .= $row2['state_id'];
				$check = $_POST[$i];
				if ($check == "checked") {
					$sql3 = "INSERT INTO `state_access` (`userID`,`stateID`,`access`) VALUES ('$_POST[id]','$row2[state_id]','Yes')";
					$result3 = $this->new_mysql($sql3);
				}
			}
			print "<br><font color=green>State access has been updated.</font><br>";
			$_GET['id'] = $_POST['id'];
			$this->user_states();
	}

	public function security_tab() {
                if ($_SESSION['userType'] == "admin") {

			$sql = "SELECT * FROM `users` WHERE `id` = '$_GET[id]'";
			$result = $this->new_mysql($sql);
			$row = $result->fetch_assoc();

			$sql2 = "SELECT * FROM `security_table` WHERE `userID` = '$_GET[id]'";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
				switch ($row2['tab']) {
					case "1":
					$read1 = $row2['read'];
					$write1 = $row2['write'];
					break;

                                        case "2":
                                        $read2 = $row2['read'];
                                        $write2 = $row2['write'];
                                        break;

                                        case "3":
                                        $read3 = $row2['read'];
                                        $write3 = $row2['write'];
                                        break;

                                        case "4":
                                        $read4 = $row2['read'];
                                        $write4 = $row2['write'];
                                        break;

                                        case "5":
                                        $read5 = $row2['read'];
                                        $write5 = $row2['write'];
                                        break;

                                        case "6":
                                        $read6 = $row2['read'];
                                        $write6 = $row2['write'];
                                        break;                                   

                                        case "7":
                                        $read7 = $row2['read'];
                                        $write7 = $row2['write'];
                                        break;

				}
			}

			print "<h2><a href=\"index.php?action=manage_users\">Users</a> : Security Access : $row[first] $row[last]</h2>
			<form action=\"index.php\" method=\"post\">
			<input type=\"hidden\" name=\"id\" value=\"$_GET[id]\">
			<input type=\"hidden\" name=\"action\" value=\"security_tab\">
			Tip: <i>If you enable write access you must also enable read access</i><br>
			<table class=\"table\">
			<tr><td><b>Tab</b></td><td>Read Access</td><td>Write Access</td></tr>
			<tr><td>Project Entry</td><td><input type=\"checkbox\" name=\"read1\" 	$read1 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write1\" $write1 value=\"checked\"></td></tr>
			<tr><td>Milestones</td><td><input type=\"checkbox\" name=\"read2\"	$read2 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write2\" $write2 value=\"checked\"></td></tr>
            <tr><td>Contacts</td><td><input type=\"checkbox\" name=\"read3\" 	$read3 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write3\" $write3 value=\"checked\"></td></tr>
            <tr><td>Design Deficiencies</td><td><input type=\"checkbox\" name=\"read4\" $read4 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write4\" $write4 value=\"checked\"></td></tr>
            <tr><td>Ratings</td><td><input type=\"checkbox\" name=\"read5\" 	$read5 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write5\" $write5 value=\"checked\"></td></tr>
            <tr><td>Constructability</td><td><input type=\"checkbox\" name=\"read6\" 	$read6 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write6\" $write6 value=\"checked\"></td></tr>
            <tr><td>Bidability</td><td><input type=\"checkbox\" name=\"read7\" 	$read7 value=\"checked\"></td><td><input type=\"checkbox\" name=\"write7\" $write7 value=\"checked\"></td></tr>
			


			<tr><td colspan=3><input type=\"submit\" class=\"btn btn-primary\" value=\"Update\"></td></tr>
			</table>
			</form>";
                  } else {
                        $this->access_deny();
                  }
	}

	public function security_tab2() {
                if ($_SESSION['userType'] == "admin") {

			$sql = "DELETE FROM `security_table` WHERE `userID` = '$_POST[id]'";
			$result = $this->new_mysql($sql);

			if ($_POST['read1'] != "") {
				$sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('1','$_POST[id]','$_POST[read1]','$_POST[write1]')";
				$result = $this->new_mysql($sql);
			} 

                        if ($_POST['read2'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('2','$_POST[id]','$_POST[read2]','$_POST[write2]')";
                                $result = $this->new_mysql($sql);
                        }
                        if ($_POST['read3'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('3','$_POST[id]','$_POST[read3]','$_POST[write3]')";
                                $result = $this->new_mysql($sql);
                        }
                        if ($_POST['read4'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('4','$_POST[id]','$_POST[read4]','$_POST[write4]')";
                                $result = $this->new_mysql($sql);
                        }
                        if ($_POST['read5'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('5','$_POST[id]','$_POST[read5]','$_POST[write5]')";
                                $result = $this->new_mysql($sql);
                        }
                        if ($_POST['read6'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('6','$_POST[id]','$_POST[read6]','$_POST[write6]')";
                                $result = $this->new_mysql($sql);
                        }
                        if ($_POST['read7'] != "") {
                                $sql = "INSERT INTO `security_table` (`tab`,`userID`,`read`,`write`) VALUES ('7','$_POST[id]','$_POST[read7]','$_POST[write7]')";
                                $result = $this->new_mysql($sql);
                        }

                                print "<font color=green>The security settings was updated.</font>";
                                $this->manage_users();

                  } else {
                        $this->access_deny();
                  }
        }


	public function delete_user() {
                if ($_SESSION['userType'] == "admin") {

			$sql = "DELETE FROM `users` WHERE `id` = '$_GET[id]'";
                        $result = $this->new_mysql($sql);
                        if ($result == "TRUE") {
                                print "<font color=green>The user was deleted.</font>";
                                $this->manage_users();
                        } else {
                                print "<font color=red>There was an error deleting the user.</font><br>";
                        }


                } else {
                        $this->access_deny();
                }

	}

	public function access_deny() {
		print "<br><br><font color=red>Sorry, you do not have access to this module.</font><br><bR>";
	}

	public function edit_user() {
                if ($_SESSION['userType'] == "admin") {

                        $sql = "SELECT * FROM `users` WHERE `id` = '$_GET[id]'";
                        $result = $this->new_mysql($sql);
                        while ($row = $result->fetch_assoc()) {

				$sql2 = "
				SELECT
					`state`.`state_id`,
					`state`.`state`

				FROM
					`state_access`,`state`

				WHERE
					`state_access`.`userID` = '$_GET[id]'
					AND `state_access`.`stateID` = `state`.`state_id`

				ORDER BY `state`.`state` ASC

				";
				$result2 = $this->new_mysql($sql2);
				while ($row2 = $result2->fetch_assoc()) {
					if ($row['default_state'] == $row2['state_id']) {
						$options .= "<option selected value=\"$row2[state_id]\">$row2[state]</option>";
					} else {
						$options .= "<option value=\"$row2[state_id]\">$row2[state]</option>";
					}
				}
				if ($options == "") {
					$options = "<option value=\"0\">ERROR: Please assign a state to the user</option>";
				}
                                print "
                                <br><h2><a href=\"index.php?action=manage_users\">Users</a> : Edit User</h2>
                                <form action=\"index.php\" method=\"post\">
				<input type=\"hidden\" name=\"id\" value=\"$_GET[id]\">
                                <input type=\"hidden\" name=\"action\" value=\"update_user\">
                                <table class=\"table\">
                                <tr><td>First Name:</td><td><input type=\"text\" name=\"first\" value=\"$row[first]\" size=40></td></tr>
                                <tr><td>Last Name:</td><td><input type=\"text\" name=\"last\" value=\"$row[last]\" size=40></td></tr>
                                <tr><td>Email:</td><td><input type=\"text\" name=\"email\" value=\"$row[email]\" size=40></td></tr>
                                <tr><td>Username:</td><td>$row[uuname]</td></tr>
                                <tr><td>Password:</td><td><input type=\"text\" name=\"uupass\" value=\"$row[uupass]\" size=40></td></tr>
                                <tr><td>Member Type:</td><td><select name=\"userType\"><option selected>$row[userType]</option><option>member</option><option>admin</option></select></td></tr>
				<tr><td>Access To Reports?</td><td><select name=\"reports_access\"><option selected>$row[reports_access]</option><option>No</option><option>Yes</option></select></td></tr>
				<tr><td>Default State:</td><td><select name=\"default_state\">$options</select></td></tr>
                                <tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Update User\"></td></tr>
                                </table>
                                </form>
                                ";
                        }


                } else {
                        $this->access_deny();
                }

	}

	public function update_user() {
                if ($_SESSION['userType'] == "admin") {

	                $sql = "UPDATE `users` SET
        	        `uupass` = '$_POST[uupass]',
                	`first` = '$_POST[first]',
	                `last` = '$_POST[last]',
        	        `email` = '$_POST[email]',
                	`userType` = '$_POST[userType]',
			`reports_access` = '$_POST[reports_access]',
			`default_state` = '$_POST[default_state]'

	                WHERE `id` = '$_POST[id]'";
        	        $result = $this->new_mysql($sql);
                	if ($result == "TRUE") {
	                        print "<font color=green>The user was updated.</font>";
				$this->manage_users();
        	        } else {
                	        print "<font color=red>There was an error saving your profile.</font><br>";
	                }

                } else {
                        $this->access_deny();
                }

	}

	public function profile() {
			$sql = "SELECT * FROM `users` WHERE `id` = '$_SESSION[id]'";
			$result = $this->new_mysql($sql);
			while ($row = $result->fetch_assoc()) {
				print "
				<br><h2>Profile</h2>
				<form action=\"index.php\" method=\"post\">
				<input type=\"hidden\" name=\"action\" value=\"save_profile\">
				<table class=\"table\">
				<tr><td>First Name:</td><td><input type=\"text\" name=\"first\" value=\"$row[first]\" size=40></td></tr>
				<tr><td>Last Name:</td><td><input type=\"text\" name=\"last\" value=\"$row[last]\" size=40></td></tr>
				<tr><td>Email:</td><td><input type=\"text\" name=\"email\" value=\"$row[email]\" size=40></td></tr>
				<tr><td>Username:</td><td>$_SESSION[uuname]</td></tr>
				<tr><td>Password:</td><td><input type=\"text\" name=\"uupass\" value=\"$row[uupass]\" size=40></td></tr>
				<tr><td>Member Type:</td><td><select name=\"userType\"><option selected>$row[userType]</option><option>member</option><option>admin</option></select></td></tr>
				<tr><td colspan=2><input type=\"submit\" class=\"btn btn-primary\" value=\"Update Profile\"></td></tr>
				</table>
				</form>
				";
			}

	}

	public function save_user() {
                if ($_SESSION['userType'] == "admin") {
			$today = date("Ymd");
			$sql = "INSERT INTO `users` (`first`,`last`,`email`,`uuname`,`uupass`,`userType`,`active`,`date_created`) VALUES
			('$_POST[first]','$_POST[last]','$_POST[email]' ,'$_POST[uuname]','$_POST[uupass]','$_POST[userType]','Yes','$today')";
			$result = $this->new_mysql($sql);
			if ($result == "TRUE") {
				print "<br>The user $_POST[first] $_POST[last] has been created. Click <a href=\"index.php?action=manage_users\">here</a> to continue.<br>";
			} else {
				print "<br><font color=red>There was a mysql error processing our result.</font><br>";
			}

                } else {
                        $this->access_deny();
                }

	}

	public function save_profile() {
		$sql = "UPDATE `users` SET 
		`uupass` = '$_POST[uupass]',
		`first` = '$_POST[first]',
		`last` = '$_POST[last]',
		`email` = '$_POST[email]',
		`userType` = '$_POST[userType]'

		WHERE `id` = '$_SESSION[id]'";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			print "<font color=green>Your profile was saved. The system might force you to log back in.</font><bR>";
		} else {
			print "<font color=red>There was an error saving your profile.</font><br>";
		}
		$this->profile();
	}



}
}
?>
