<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="Bidability">
<input type="hidden" name="ProjectID" value="{$ProjectID}">
<input type="hidden" name="id" value="{$id}">

<div id="Bidability">

<br>
{$msg}
<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_rt(this.form)"><option value="">Select to Load</option>
                {$ProjectList}</select></td>
        </tr>
</table>

<br>

<table class="table">

<!-- q1 -->
<tr bgcolor="#E3F2FD">
	<td>The Index of Sheets on the Title Sheet is complete:</td>
	<td><select name="q1a">{if $q1a ne ""}<option selected>{$q1a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD"><td># of sheets missing from Index of Sheets:</td><td><input type="text" name="q1b" value="{$q1b}" size="20"></td></tr>
<tr bgcolor="#E3F2FD"><td>Total # of sheets in plan set:</td><td><input type="text" name="q1c" value="{$q1c}" size="20"></td></tr>

<!-- q2 -->
<tr><td>Plan Notes are consistent with Specifications and Special Provisions:</td>
	<td><select name="q2a">{if $q2a ne ""}<option selected>{$q2a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr><td># of Notes in conflict with Specifications:</td><td><input type="text" name="q2b" value="{$q2b}" size="20"></td></tr>
<tr><td># of Notes in conflict with Special Provisions:</td><td><input type="text" name="q2c" value="{$q2c}" size="20"></td></tr>

<!-- q3 -->
<tr bgcolor="#E3F2FD">
	<td>Quantities are correctly carried forward from Plan Sheets to individual tabulations:</td>
	<td><select name="q3a">{if $q3a ne ""}<option selected>{$q3a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD">
	<td># of times Quantities are not correctly carried forward from Plan Sheets to individual tabulations:</td><td><input type="text" name="q3b" value="{$q3b}" size="20"></td></tr>


<!-- q4 -->
<tr>
	<td>Estimated Quantities are correctly carried forward from General Notes to the Summary of Quantities (SOQ):</td>
	<td><select name="q4a">{if $q4a ne ""}<option selected>{$q4a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr>
	<td># of estimated quantities not carried forward from General Notes to the SOQ:</td><td><input type="text" name="q4b" value="{$q4b}" size="20"></td></tr>

<!-- q5 -->
<tr bgcolor="#E3F2FD">
	<td>All Items in the SOQ are acounted for in Tabulations, Notes or Specifications:</td>
	<td><select name="q5a">{if $q5a ne ""}<option selected>{$q5a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD">
	<td># of Items in SOQ not accounted for in Tabulations, Notes, or Specifications:</td><td><input type="text" name="q5b" value="{$q5b}" size="20"></td></tr>

<!-- q6 -->
<tr>
	<td>All Bid Items shown on the Plans and Special Provisions are included in the SOQ:</td>
	<td><select name="q6a">{if $q6a ne ""}<option selected>{$q6a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr><td># of Bid Items shown in Plans or Special Provisions which are not included in SOQ:</td><td><input type="text" name="q6b" value="{$q6b}" size="20"></td></tr>

<!-- q7 -->
<tr bgcolor="#E3F2FD">
	<td>Required Pay Items in the Standard Specifications are all Included in the SOQ:</td>
	<td><select name="q7a">{if $q7a ne ""}<option selected>{$q7a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD">
	<td>All required Pay Items in the Standard Specifications, not included in the SOQ, are Included In the Bid Item Description:</td>
	<td><select name="q7b">{if $q7b ne ""}<option selected>{$q7b}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD">
	<td>All required Pay Items in the Standard Specifications, not included in the SOQ or Bid Item Descriptions, are called out as Incidental to an included Item:</td>
	<td><select name="q7c">{if $q7c ne ""}<option selected>{$q7c}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>
<tr bgcolor="#E3F2FD">
	<td># of required Pay Items in the Standard Specifications which are not included in the SOQ:</td><td><input type="text" name="q7d" value="{$q7d}" size="20"></td></tr>

</table>

</div>
</form>