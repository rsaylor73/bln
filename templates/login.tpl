
{if $msg ne '0'}
<center><font color=red>{$msg}</font></center><br>
{/if}
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

{literal}               
                                <script>
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
                                </script>
{/literal}
