<?php /* Smarty version 3.1.27, created on 2016-03-05 19:09:35
         compiled from "templates/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:127920544856db753fdfa959_66761360%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a0270564c79ee7a1c4f40d2a5e8bcfac7e3570' => 
    array (
      0 => 'templates/login.tpl',
      1 => 1457222973,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127920544856db753fdfa959_66761360',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56db75401c3e38_68414476',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56db75401c3e38_68414476')) {
function content_56db75401c3e38_68414476 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '127920544856db753fdfa959_66761360';
?>

<?php if ($_smarty_tpl->tpl_vars['msg']->value != '0') {?>
<center><font color=red><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</font></center><br>
<?php }?>
                <br>
                <div align="center" id="login-scr">
                <form name="myform" id="myform">
                <table border=0 width=700>
                <tr><td>
                        <table border=0 width=700>
                                <tr><td>Username:</td><td><input type="text" name="uuname" size=20></td></tr>
                                <tr><td>Password:</td><td><input type="password" name="uupass" onkeypress="if(event.keyCode==13) { login(this.form); return false;}" size=20></td></tr>
                                <tr><td>&nbsp;</td><td><input type="button" value="Login" class="btn btn-primary" onclick="login(this.form)"></td></tr>
                                <tr><td><a href="javascript:void(0)" onclick="forgot_password(this.form)">Forgot Password?</a></td><td>

                                </td></tr>
                        </table>
                </td></tr>
                </table>
                </form>
                </div>
                <br>

               
                                <?php echo '<script'; ?>
>
                                 function forgot_password(myform) {
                                        $.get('forgot_password.php',
                                        $(myform).serialize(),
                                        function(php_msg) {
                                                $("#login-scr").html(php_msg);
                                        });
                                 }

                                function login(myform) {
                                        $.get('login.php',
                                        $(myform).serialize(),
                                        function(php_msg) {
                                          if (php_msg.substring(0,4) == "http") {
                                             $("#login-scr").html('<span class="details-description"><font color=green>Login successful. Loading please wait...</font><br></span>');
                                             setTimeout(function()
                                                {
                                                window.location.replace(php_msg)
                                                }
                                             ,2000);
                                          } else {
                                             $("#login-scr").html(php_msg);
                                          }
                                        });
                                }
                                <?php echo '</script'; ?>
>

<?php }
}
?>