<?php
/* -----------------------------------------
// This file controls the actions of the template class
// Version 1.00
// Author: Robert Saylor
// robert@customphpdesign.com
// Jan 31, 2015
*/


require_once('libs/Smarty.class.php');
$smarty=new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setConfigDir('configs/');
$smarty->setCacheDir('cache/');

include $GLOBAL['path']."/class/admin.class.php";
$admin = new Admin($linkID);

if ($_GET['section'] == "logout") {
        $template->logout();
}

?>
