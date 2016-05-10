<?php /* Smarty version 3.1.27, created on 2015-11-28 11:11:07
         compiled from "templates/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:16769713405659d21babf645_66617185%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be439f82a4dbec61746f62a0df07c19a7eecd966' => 
    array (
      0 => 'templates/header.tpl',
      1 => 1448726933,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16769713405659d21babf645_66617185',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5659d21bae7ce1_16579501',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5659d21bae7ce1_16579501')) {
function content_5659d21bae7ce1_16579501 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '16769713405659d21babf645_66617185';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BLN | DOT Tracker</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/desktop.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <!--<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>-->

   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/jquery-1.9.1.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.core.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
>
  $(function() {
    var availableTags = [
	// results here
    ];
    $( "#project_number" ).autocomplete({
      source: availableTags,
      appendTo: "#container",
      position: { my : "right bottom", at: "right bottom" },
      //<!-- Added SELECT event -kjg //-->
      select: function (event, ui) {
        $( "#project_number" ).val(ui.item.label);
                document.getElementById('project_number').value = ui.item.label;
        redirect_page()
        },
      //<!-- END //-->
      minLength: 1
    });
  });
  <?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(function() {
$( "#TargetDate" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#TargetDateOut" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#ActualDate" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#DateIn"     ).datepicker({dateFormat: "yy-mm-dd"});
$( "#DateOut"    ).datepicker({dateFormat: "yy-mm-dd"});
$( "#date1"      ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
});
$( "#date2"      ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
});
});
<?php echo '</script'; ?>
>


<style>
tr.noBorder td {border: 0; }
</style>


</head>
<?php }
}
?>