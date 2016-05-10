<div id="contacts">
<form name="myform">

<br>

<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_co(this.form)"><option value="">Select to Load</option>{$ProjectList}</select></td>
        </tr>
</table>
</form>

<div id="const">

{$html}

</div>


<script>
        function load_co(myform) {
                $.get('load_co.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#const").html(php_msg);
                });
        }
</script>
