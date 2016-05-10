<?php /* Smarty version 3.1.27, created on 2016-03-08 11:59:17
         compiled from "templates/milestones.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:180358471656df04e50b0097_52665275%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfb5507ce3907dc86f181288267ba23899ba2725' => 
    array (
      0 => 'templates/milestones.tpl',
      1 => 1457456351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180358471656df04e50b0097_52665275',
  'variables' => 
  array (
    'ProjectList' => 0,
    'TargetDate' => 0,
    'DateIn' => 0,
    'TargetDateOut' => 0,
    'DateOut' => 0,
    'organization' => 0,
    'contact_person' => 0,
    'Comments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56df04e50e7e87_37151779',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56df04e50e7e87_37151779')) {
function content_56df04e50e7e87_37151779 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '180358471656df04e50b0097_52665275';
?>
<form name="myform">

<br>

<table border=0 width=100<?php echo '%>';?>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" id="load_project" onchange="load_ms(this.form)"><option value="">Select to Load</option><?php echo $_smarty_tpl->tpl_vars['ProjectList']->value;?>
</select></td>
        </tr>
</table>

</form>

<div id="milestone">
<br>
<table border=0 width=100<?php echo '%>';?>
<tr>
	<td width=200><b>Submittal Type:</b></td><td><select name="submittal_type">

	</select></td>
</tr>
<tr>
	<td><b>Scheduled Date In:</b></td>
	<td><input type="text" name="TargetDate" id="TargetDate" value="<?php echo $_smarty_tpl->tpl_vars['TargetDate']->value;?>
" size=40></td>
</tr>
<tr>
	<td><b>Actual Date In:</b></td>
        <td><input type="text" name="DateIn" id="DateIn" value="<?php echo $_smarty_tpl->tpl_vars['DateIn']->value;?>
" size=40></td>
</tr>
<tr>
        <td><b>Target Date Out:</b></td>
        <td><input type="text" name="TargetDateOut" id="TargetDateOut" value="<?php echo $_smarty_tpl->tpl_vars['TargetDateOut']->value;?>
" size=40></td>
</tr>


<tr>
        <td><b>Actual Date Out:</b></td>
        <td><input type="text" name="DateOut" id="DateOut" value="<?php echo $_smarty_tpl->tpl_vars['DateOut']->value;?>
" size=40></td>
</tr>

<tr>
	<td><b>Organization:</b></td>
	<td><select name="organization"><?php echo $_smarty_tpl->tpl_vars['organization']->value;?>


	</select></td>
</tr>
<tr>
	<td><b>Contact Person:</b></td>
	<td><select name="contact_person"><?php echo $_smarty_tpl->tpl_vars['contact_person']->value;?>


	</select></td>
</tr>
<tr>

	<td><b>Comments:</b></td>
	<td><textarea name="Comments" cols=40 rows=5><?php echo $_smarty_tpl->tpl_vars['Comments']->value;?>
</textarea>&nbsp;&nbsp;

	</td>
</tr>
</table>

<br>

<table border=1 width=100<?php echo '%>';?>
<tr bgcolor="#F0F0F0">
	<td>&nbsp;</td>
	<td>Milestone Description</td>
	<td>Scheduled Date In</td>
	<td>Actual Date In</td>
	<td>Target Date Out</td>
	<td>Actual Date Out</td>
	<td>By</td>
</tr>


</table>
<br><br>
</div>


<?php echo '<script'; ?>
>
        function load_ms(myform) {
                $.get('load_ms.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#milestones").html(php_msg);
                });
        }
<?php echo '</script'; ?>
>

<?php }
}
?>