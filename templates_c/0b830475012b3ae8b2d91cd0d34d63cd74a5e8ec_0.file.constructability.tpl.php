<?php /* Smarty version 3.1.27, created on 2016-03-07 22:48:25
         compiled from "templates/constructability.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:34016599856de4b89a7ba29_19623758%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b830475012b3ae8b2d91cd0d34d63cd74a5e8ec' => 
    array (
      0 => 'templates/constructability.tpl',
      1 => 1457408854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34016599856de4b89a7ba29_19623758',
  'variables' => 
  array (
    'ProjectList' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56de4b89aaa611_41020388',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56de4b89aaa611_41020388')) {
function content_56de4b89aaa611_41020388 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '34016599856de4b89a7ba29_19623758';
?>
<div id="contacts">
<form name="myform">

<br>

<table border=0 width=100<?php echo '%>';?>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_co(this.form)"><option value="">Select to Load</option><?php echo $_smarty_tpl->tpl_vars['ProjectList']->value;?>
</select></td>
        </tr>
</table>
</form>

<div id="const">

<?php echo $_smarty_tpl->tpl_vars['html']->value;?>


</div>


<?php echo '<script'; ?>
>
        function load_co(myform) {
                $.get('load_co.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#const").html(php_msg);
                });
        }
<?php echo '</script'; ?>
>
<?php }
}
?>