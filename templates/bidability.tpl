<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="Bidability">
<input type="hidden" name="ProjectID" value="{$ProjectID}">
<input type="hidden" name="id" value="{$id}">


<br>
{$msg}
<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_bt(this.form)"><option value="">Select to Load</option>
                {$ProjectList}</select></td>
        </tr>
</table>

<br>

<div id="Bidability" {if $showform ne 'yes'}style="display:none"{/if}>

{$msg}
<table class="table">

<!-- q1 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 1</b></td></tr>
<tr bgcolor="#E3F2FD">
	<td>The Index of Sheets on the Title Sheet is complete:</td>
	<td><select name="q1a" id="q1a" required onchange="q1()">

	{if $q1a ne ""}{$q1a}{elseif $q1a eq ""}{$default}{/if}
	
	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq1b" bgcolor="#E3F2FD"><td># of sheets missing from Index of Sheets:</td><td><input type="text" name="q1b" value="{$q1b}" size="20"></td></tr>
<tr style="display:none" id="Tq1c" bgcolor="#E3F2FD"><td>Total # of sheets in plan set:</td><td><input type="text" name="q1c" value="{$q1c}" size="20"></td></tr>

<script>
function q1() {
	var e = document.getElementById("q1a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq1b').style.display='table-row';
		document.getElementById('Tq1c').style.display='table-row';
	} else {
		document.getElementById('Tq1b').style.display='none';
		document.getElementById('Tq1c').style.display='none';
	}
}
var test2 = "{$q1a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq1b').style.display='table-row';
	document.getElementById('Tq1c').style.display='table-row';
}
</script>

<!-- q2 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 2</b></td></tr>
<tr><td>Plan Notes are consistent with Specifications and Special Provisions:</td>
	<td><select name="q2a" id="q2a" required onchange="q2()">
	{if $q2a ne ""}{$q2a}{elseif $q2a eq ""}{$default}{/if}

	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq2b"><td># of Notes in conflict with Specifications:</td><td><input type="text" name="q2b" value="{$q2b}" size="20"></td></tr>
<tr style="display:none" id="Tq2c"><td># of Notes in conflict with Special Provisions:</td><td><input type="text" name="q2c" value="{$q2c}" size="20"></td></tr>

<script>
function q2() {
	var e = document.getElementById("q2a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq2b').style.display='table-row';
		document.getElementById('Tq2c').style.display='table-row';
	} else {
		document.getElementById('Tq2b').style.display='none';
		document.getElementById('Tq2c').style.display='none';
	}
}
var test2 = "{$q2a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq2b').style.display='table-row';
	document.getElementById('Tq2c').style.display='table-row';
}
</script>

<!-- q3 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 3</b></td></tr>
<tr bgcolor="#E3F2FD">
	<td>Quantities are correctly carried forward from Plan Sheets to individual tabulations:</td>
	<td><select name="q3a" id="q3a" required onchange="q3()">
	{if $q3a ne ""}{$q3a}{elseif $q3a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq3b" bgcolor="#E3F2FD">
	<td># of times Quantities are not correctly carried forward from Plan Sheets to individual tabulations:</td><td><input type="text" name="q3b" value="{$q3b}" size="20"></td></tr>

<script>
function q3() {
	var e = document.getElementById("q3a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq3b').style.display='table-row';
	} else {
		document.getElementById('Tq3b').style.display='none';
	}
}
var test2 = "{$q3a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq3b').style.display='table-row';
}
</script>

<!-- q4 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 4</b></td></tr>
<tr>
	<td>Estimated Quantities are correctly carried forward from General Notes to the Summary of Quantities (SOQ):</td>
	<td><select name="q4a" id="q4a" required onchange="q4()">
	{if $q4a ne ""}{$q4a}{elseif $q4a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq4b">
	<td># of estimated quantities not carried forward from General Notes to the SOQ:</td><td><input type="text" name="q4b" value="{$q4b}" size="20"></td></tr>

<script>
function q4() {
	var e = document.getElementById("q4a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq4b').style.display='table-row';
	} else {
		document.getElementById('Tq4b').style.display='none';
	}
}
var test2 = "{$q4a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq4b').style.display='table-row';
}
</script>

<!-- q5 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 5</b></td></tr>
<tr bgcolor="#E3F2FD">
	<td>All Items in the SOQ are acounted for in Tabulations, Notes or Specifications:</td>
	<td><select name="q5a" id="q5a" required onchange="q5()">
	{if $q5a ne ""}{$q5a}{elseif $q5a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq5b" bgcolor="#E3F2FD">
	<td># of Items in SOQ not accounted for in Tabulations, Notes, or Specifications:</td><td><input type="text" name="q5b" value="{$q5b}" size="20"></td></tr>

<script>
function q5() {
	var e = document.getElementById("q5a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq5b').style.display='table-row';
	} else {
		document.getElementById('Tq5b').style.display='none';
	}
}
var test2 = "{$q5a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq5b').style.display='table-row';
}
</script>

<!-- q6 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 6</b></td></tr>
<tr>
	<td>All Bid Items shown on the Plans and Special Provisions are included in the SOQ:</td>
	<td><select name="q6a" id="q6a" required onchange="q6()">
	{if $q6a ne ""}{$q6a}{elseif $q6a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>
<tr style="display:none" id="Tq6b"><td># of Bid Items shown in Plans or Special Provisions which are not included in SOQ:</td><td><input type="text" name="q6b" value="{$q6b}" size="20"></td></tr>

<script>
function q6() {
	var e = document.getElementById("q6a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq6b').style.display='table-row';
	} else {
		document.getElementById('Tq6b').style.display='none';
	}
}
var test2 = "{$q6a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq6b').style.display='table-row';
}
</script>

<!-- q7 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 7</b></td></tr>
<tr bgcolor="#E3F2FD">
	<td>Required Pay Items in the Standard Specifications are all Included in the SOQ:</td>
	<td><select name="q7a" id="q7a" required onchange="q7_1()">
	{if $q7a ne ""}{$q7a}{elseif $q7a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq7b" bgcolor="#E3F2FD">
	<td>All required Pay Items in the Standard Specifications, not included in the SOQ, are Included In the Bid Item Description:</td>
	<td><select name="q7b" id="q7b" onchange="q7_2()">
	{if $q7b ne ""}{$q7b}{elseif $q7b eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq7c" bgcolor="#E3F2FD">
	<td>All required Pay Items in the Standard Specifications, not included in the SOQ or Bid Item Descriptions, are called out as Incidental to an included Item:</td>
	<td><select name="q7c" id="q7c" onchange="q7_3()">
	{if $q7c ne ""}{$q7c}{elseif $q7c eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq7d" bgcolor="#E3F2FD">
	<td># of required Pay Items in the Standard Specifications which are not included in the SOQ:</td><td><input type="text" name="q7d" value="{$q7d}" size="20"></td></tr>

<script>
function q7_1() {
	var e = document.getElementById("q7a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq7b').style.display='table-row';
	} else {
		document.getElementById('Tq7b').style.display='none';
	}
}
var test2 = "{$q7a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq7b').style.display='table-row';
}

function q7_2() {
	var e = document.getElementById("q7b");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq7c').style.display='table-row';
	} else {
		document.getElementById('Tq7c').style.display='none';
	}
}
var test2 = "{$q7b}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq7c').style.display='table-row';
}

function q7_3() {
	var e = document.getElementById("q7c");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq7d').style.display='table-row';
	} else {
		document.getElementById('Tq7d').style.display='none';
	}
}
var test2 = "{$q7c}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq7d').style.display='table-row';
}
</script>

<!-- q8 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 8</b></td></tr>
<tr><td>Items in the SOQ are consistent with Payment sections of the specifications in Title and Unit of Measure:</td>
	<td><select name="q8a" id="q8a" required onchange="q8()">
	{if $q8a ne ""}{$q8a}{elseif $q8a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq8b"><td># of Items in SOQ which are not consistent with Payment sections of the specifications in Title and Unit of Measure:</td><td><input type="text" name="q8b" value="{$q8b}" size="20"></td></tr>

<script>
function q8() {
	var e = document.getElementById("q8a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq8b').style.display='table-row';
	} else {
		document.getElementById('Tq8b').style.display='none';
	}
}
var test2 = "{$q8a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq8b').style.display='table-row';
}
</script>

<!-- q9 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 9</b></td></tr>
<tr bgcolor="#E3F2FD">
	<td>Items in the SOQ are consistent with current Bid Item List in Number, Title and Unit of Measure:</td>
	<td><select name="q9a" id="q9a" required onchange="q9()">
	{if $q9a ne ""}{$q9a}{elseif $q9a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq9b"><td># of Items in the SOQ which are not consistent with current Bid Item List in Number, Title or Unit of Measure:</td><td><input type="text" name="q9b" value="{$q9b}" size="20"></td></tr>

<script>
function q9() {
	var e = document.getElementById("q9a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq9b').style.display='table-row';
	} else {
		document.getElementById('Tq9b').style.display='none';
	}
}
var test2 = "{$q9a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq9b').style.display='table-row';
}
</script>

<!-- q10 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 10</b></td></tr>
<tr><td>Quantities appear reasonable for the size and scope of the project:</td>
	<td><select name="q10a" id="q10a" required onchange="q10()">
	{if $q9a ne ""}{$q9a}{elseif $q9a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq10b"><td># of qunatities which do not apear reasonable for the size and scope of the project:</td><td><input type="text" name="q10b" value="{$q10b}" size="20"></td></tr>

<script>
function q10() {
	var e = document.getElementById("q10a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq10b').style.display='table-row';
	} else {
		document.getElementById('Tq10b').style.display='none';
	}
}
var test2 = "{$q10a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq10b').style.display='table-row';
}
</script>

<!-- q11 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 11</b></td></tr>
<tr bgcolor="#E3F2FD"><td>All Project Special Provisions have the necessary measurement and payment clauses:</td>
	<td><select name="q11a" id="q11a" required onchange="q11()">
	{if $q10a ne ""}{$q10a}{elseif $q10a eq ""}{$default}{/if}
	<option>Yes</option><option>No</option></select></td></tr>

<tr style="display:none" id="Tq10b" bgcolor="#E3F2FD"><td># of Project Special Provisions missing measurement and payment cluases:</td><td><input type="text" name="q11b" value="{$q11b}" size="20"></td></tr>

<script>
function q11() {
	var e = document.getElementById("q11a");
	var test1 = e.options[e.selectedIndex].value;
	if (test1 == "No") {
		document.getElementById('Tq11b').style.display='table-row';
	} else {
		document.getElementById('Tq11b').style.display='none';
	}
}
var test2 = "{$q11a}";
if (test2 == "<option selected>No</option>") {
	document.getElementById('Tq11b').style.display='table-row';
}
</script>

<!-- q12 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 12</b></td></tr>
<tr><td>The most current revisions of CDOT's Standard Special Provisions are included:</td>
	<td><select name="q12a">{if $q12a ne ""}<option selected>{$q12a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>

<!-- q13 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 13</b></td></tr>
<tr bgcolor="#E3F2FD"><td>The limits of construction and the limits of demolition are shown and noted on the plan sheets:</td>
	<td><select name="q13a">{if $q13a ne ""}<option selected>{$q13a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>

<!-- q14 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 14</b></td></tr>
<tr><td>Required permits are listed in the Project Special Provisions (e.g., SWPP, 404, NPDES, Dewatering):</td>
	<td><select name="q14a">{if $q14a ne ""}<option selected>{$q14a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>

<!-- q15 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 15</b></td></tr>
<tr bgcolor="#E3F2FD"><td>A list of utility owners and contact numbers is included in the Project Special Provisions for the utilities shown on the plan sheets:</td>
	<td><select name="q15a">{if $q15a ne ""}<option selected>{$q15a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>

<!-- q16 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 16</b></td></tr>
<tr><td>The log of test borings is included, if applicable:</td>
	<td><select name="q16a">{if $q16a ne ""}<option selected>{$q16a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>

<!-- q17 -->
<tr bgcolor="#BFC8D4"><td colspan="2"><b>Question 17</b></td></tr>
<tr bgcolor="#E3F2FD"><td>Prepared reports for the project are listed in the Project Special Provisions (e.g. Geotechnical, Drainage, Environmental)</td>
	<td><select name="q17a">{if $q17a ne ""}<option selected>{$q17a}</option>{/if}<option>Yes</option><option>No</option></select></td></tr>


</table>

</div>
</form>

{literal}
<script>
        function load_bt(myform) {
                $.get('load_bt.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#Bidability").html(php_msg);
                });
        }
</script>
{/literal}