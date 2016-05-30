<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="milestones">
<input type="hidden" name="ProjectID" value="{$ProjectID}">

<br>

<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" id="load_project" onchange="load_ms(this.form)"><option value="">Select to Load</option>{$ProjectList}</select></td>
        </tr>
</table>

<div id="milestone">
<br>
<table border=0 width=100%>
<tr>
	<td width=200><b>Submittal Type:</b></td><td><select name="SubmittalTypeID" required>{$SubmittalTypes}

	</select></td>
</tr>
<tr>
	<td><b>Scheduled Date In:</b></td>
	<td><input type="text" name="TargetDate" id="TargetDate" value="{$TargetDate}" size=40></td>
</tr>
<tr>
	<td><b>Actual Date In:</b></td>
        <td><input type="text" name="DateIn" id="DateIn" value="{$DateIn}" size=40></td>
</tr>
<tr>
        <td><b>Target Date Out:</b></td>
        <td><input type="text" name="TargetDateOut" id="TargetDateOut" value="{$TargetDateOut}" size=40></td>
</tr>


<tr>
        <td><b>Actual Date Out:</b></td>
        <td><input type="text" name="DateOut" id="DateOut" value="{$DateOut}" size=40></td>
</tr>

<tr>
	<td><b>Organization:</b></td>
	<td><select name="organization">{$organizations}

	</select></td>
</tr>
<tr>
	<td><b>Contact Person:</b></td>
	<td><select name="contact_person">{$contacts}

	</select></td>
</tr>
<tr>

	<td><b>Comments:</b></td>
	<td><textarea name="Comments" cols=40 rows=5>{$Comments}</textarea>&nbsp;&nbsp;

	</td>
</tr>

{if $new eq "Yes"}
	<tr><td colspan="2"><input type="submit" value="Save" class="btn btn-primary"><input type="hidden" name="section" value="new"></td></tr>
{/if}

{if $new ne "Yes"}
	<tr><td colspan="2"><input type="submit" value="Update" class="btn btn-primary"><input type="hidden" name="section" value="update"><input type="hidden" name="id2" value="{$id2}"></td></tr>
{/if}

</table>
</form>

<br>

<table border=1 width=100%>
<tr bgcolor="#F0F0F0">
	<td>&nbsp;</td>
	<td>Milestone Description</td>
	<td>Scheduled Date In</td>
	<td>Actual Date In</td>
	<td>Target Date Out</td>
	<td>Actual Date Out</td>
	<td>By</td>
</tr>

{$milestone_data}

</table>
<br><br>
</div>

{literal}
<script>
        function load_ms(myform) {
                $.get('load_ms.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#milestone").html(php_msg);
                });
        }
</script>
{/literal}
