<div id="pe">
<br>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="pe">

<table border=0 width=100%>

	<tr bgcolor="#FFFFFF">

			{if $type eq ''}
                        <td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php?action=pe&type=new'">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <br>Add New
                        </button>
                        </td>
			{/if}

			{if $type eq 'update'}
			<td align="center" width="16.66%">
                                <input type="hidden" name="type" value="update">
				<input type="hidden" name="ProjectID" value="{$ProjectID}">
	                        <button type="submit" class="btn btn-default btn-lg" onclick="update_record(this.form)">
        	                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <br>Update
                	        </button>
                        </td>
			{/if}


			{if $type eq 'new'}
			<td align="center" width="16.66%">
				<input type="hidden" name="type" value="save">
                        	<button type="submit" class="btn btn-default btn-lg" onclick="save_record(this.form)">
	                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <br>Save
        	                </button>
                        </td>
			{/if}


                        <td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.getElementById('search_project').style.display='inline'">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> <br>Search
                        </button>
			</td>



		<td align="center" width="16.66%">
			<button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php?action=pe&load_project=0'">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <br>Clear
			</button>

		</td>


		<td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php'">
                          <span class="glyphicon glyphicon-off" aria-hidden="true"></span> <br>Exit
                        </button>
		</td>
	</tr>
</table>

<div id="search_project" style="display:<?=$display;?>">
<table border=0 widtd=100%>
<tr><td>
Enter Project Number:</td><td><input type="text" name="project_number" id="project_number" value="" size=40>

<input type="button" value="Search" onclick="redirect_page()">

</td></tr>
</table>
<div id="container">
</div>

</div>
<br>


<table border=0 width=100%>
	<tr bgcolor="#000000">
		<td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_pe(this.form)"><option value="">Select to Load</option>{$ProjectList}</select></td>
	</tr>
</table>
<div id="someElem"></div>


<br>

{if $show_form eq 'Yes'}
<table border=0 width=100%>

	{if $ProjectType eq "DOT"}
	{assign var=c1 value="checked"}
	{/if}

	{if $ProjectType eq "LPA"}
        {assign var=c2 value="checked"}
	{/if}

	{if $c1 eq "" and $c2 eq ""}
		{assign var=c1 value="checked"}
	{/if}
	<tr>
		<td width=200><b>Project Owner:</b></td><td><input type="radio" name="ProjectType" id="ProjectType" value="DOT" {$c1}> DOT &nbsp;&nbsp;<input type="radio" name="ProjectType" value="LPA" {$c2}>  Local Agency</td>
	</tr>
	<tr>
		<td><b>BLN Identifier:</b></td><td><input type="text" name="DescriptionCode" value="{$BLN_Project_Name}" size="40"></td>
	</tr>
	<tr>
		<td><b>DOT Project Number:</b></td><td><input type="text" name="customerNumber" value="{$ProjectName}" size="40"></td>
	</tr>
	<tr>
		<td><b>Cost Code:</b></td><td><input type="text" name="PayItem" value="{$PayItem}" size="40"></td>
	</tr>
	<tr>
		<td><b>Route No.</b></td><td><input type="text" name="RouteNum" value="{$RouteNum}" size="40"></td>
	</tr>
	<tr>
		<td><b>Project Location:</b></td><td><input type="text" name="Location" value="{$Location}" size="40"></td>
	</tr>
	<tr>
		<td><b>Contract Number:</b></td><td><input type="text" name="ContractNum" value="{$ContractNum}" size="40"></td>
	</tr>
	<tr>
		<td><b>Loc. From:</b></td><td><input type="text" name="LocFrom" value="{$LocFrom}" size="40"></td>
	</tr>
	<tr>
		<td><b>Loc. To:</b></td><td><input type="text" name="LocTo" value="{$LocTo}" size="40"></td>
	</tr>
	<tr>
		<td><b>Length:</b></td><td><input type="text" name="Length" value="{$Length}" size="40"></td>
	</tr>
	<tr>
		<td><b>Urban/Rural:</b></td><td><select name="Urban_or_Rural">
		<option>Urban</option><option>Rural</option>
		{if $Urban_or_Rural ne ""}
		<option selected>{$Urban_or_Rural}</option>
		{/if}
		</select></td>
	</tr>
	<tr>
		<td><b>Type of Improvement:</b></td><td><div id="imp" style="display:inline"><select name="ImprovementType">{$ImprovementTypeOptions}

		{if $ImprovementType ne ""}
		<option selected>{$ImprovementType}</option>
		{/if}

		</select> <input type="button" value="Add Improvement Type" onclick="new_improvement(this.form)"></div></td>
	</tr>
	<tr>
		<td><b>Functional Classification:</b></td><td><div id="cls" style="display:inline"><select name="Classification">{$ClassificationOptions}

		{if $Classification ne ""}
		<option selected>{$Classification}</option>
		{/if}

		</select> <input type="button" value="Add Classification" onclick="new_classification(this.form)"></div></td>
	</tr>
</table>
{/if}

{literal}
<script>
        function new_classification(myform) {
                $.get('new_classification.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#cls").html(php_msg);
                });
        }


        function new_improvement(myform) {
                $.get('new_improvement.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#imp").html(php_msg);
                });
        }


        function load_pe(myform) {
                $.get('load_pe.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#pe").html(php_msg);
                });
        }


</script>
{/literal}


</form>

</div>

