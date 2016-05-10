<div id="contacts">
<form name="myform">

<br>

<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_ct(this.form)"><option value="">Select to Load</option>{$ProjectList}</select></td>
        </tr>
</table>
</form>

<br>

<div id="contacts">
{if $show_form eq 'Yes'}


<div id="new_dc">

        {if $status ne ''}
        <center>{$status}</center>
        {/if}


<table border=1 width=100%>
<tr>
	<td width=50% valign=top><b>Designer Contact</b><br>

	<div id="top">

	{if $new eq 'Yes'}
	<form name="myform1" action="index.php" method="post">
	<input type="hidden" name="action" value="contacts">
	<input type="hidden" name="type" value="load">
	<input type="hidden" name="section" value="save">
	<input type="hidden" name="ProjectID" value="{$ProjectID}">
	<input type="hidden" name="part" value="designer">
	{/if}

	{if $form eq 'top'}
        <form name="myform1" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="update">
        <input type="hidden" name="ProjectID" value="{$ProjectID}">
        <input type="hidden" name="part" value="designer">
	<input type="hidden" name="id" value="{$id}">
	{/if}


	<div id="list1">
	<table border=0 width=100%>
		<tr><td align=right>Organization</td><td><input type="text" name="DesignConsultant" {if $form eq 'top'} value="{$DesignConsultant}"  {/if} size=20> 
			<button type="button" name="down" onclick="show_list1(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Contact Person</td><td><input type="text" name="ContactName" {if $form eq 'top'} value="{$ContactName}" {/if} size=20>
                        <button type="button" name="down" onclick="show_list3(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Contact Person's Email</td><td><input type="text" name="Email" {if $form eq 'top'} value="{$Email}" {/if} size=20></td></tr>
		<tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" {if $form eq 'top'} value="{$Phone}" {/if} size=20></td></tr>
		<tr><td align=right>Fax # (10 digits)</td><td><input type="Text" name="Fax" {if $form eq 'top'} value="{$Fax}" {/if} size=20></td></tr>

	        {if $new eq 'Yes'}
		<tr><td colspan=2><input type="submit" value="Save"></td></tr>
		{/if}
		{if $form eq 'top'}
		<tr><td colspan=2><input type="submit" value="Update"> <input type="checkbox" value="checked" name="delete" onclick="return confirm('You are about to delete this contact')"> Delete</td></tr>
		{/if}

	</table>
	</div>


	</form>
	</div>

	</td><td width=50% valign=top><br>
	<table border=0 width=100%>
		<tr><td><b>Consultant Firm</b></td><td><b>Contact Name</b></td><td>&nbsp;</td></tr>
		{$html1}
	</table>

	</td>
</tr>
</table>
</div>

<br><br>

<div id="new_prc">

<table border=1 width=100%>
<tr>
        <td width=50% valign=top><b>Plan Review Contact</b><br>
	<div id="bot">

        {if $new eq 'Yes'}
        <form name="myform2" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="save">
        <input type="hidden" name="ProjectID" value="{$ProjectID}">
        <input type="hidden" name="part" value="review">
        {/if}

        {if $form eq 'bot'}
        <form name="myform2" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="update">
        <input type="hidden" name="ProjectID" value="{$ProjectID}">
        <input type="hidden" name="part" value="review">
        <input type="hidden" name="id2" value="{$id2}">
        {/if}

        <div id="list2">
        <table border=0 width=100%>
		<tr><td align=right>Contact Name</td><td><input type="text" name="ContactName" {if $form eq 'bot'} value="{$ContactName}" {/if} size=20> 
                        <button type="button" name="down2" onclick="show_list2(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Email Address</td><td><input type="text" name="Email" {if $form eq 'bot'} value="{$Email}" {/if} size=20></td></tr>
                <tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" {if $form eq 'bot'} value="{$Phone}" {/if} size=20></td></tr>
                <tr><td align=right>Fax # (10 digits)</td><td><input type="text" name="Fax" {if $form eq 'bot'} value="{$Fax}" {/if} size=20></td></tr>

                {if $new eq 'Yes'}
                <tr><td colspan=2><input type="submit" value="Save"></td></tr>
                {/if}
                {if $form eq 'bot'}
                <tr><td colspan=2><input type="submit" value="Update"> <input type="checkbox" value="checked" name="delete" onclick="return confirm('You are about to delete this contact')"> Delete</td></tr>
                {/if}


	</table>
	</div>
	</form>
	</div>
        </td><td width=50% valign=top><br>
        <table border=0 width=100%>
		<tr><td><b>Plan Review Contact Name</b></td><td>&nbsp;</td></tr>
                {$html2}
	</table>
	</td>
</tr>
</table>
</div>

{/if}

</div>

{literal}
<script>
        function new_dc(myform1) {
                $.get('new_dc.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#new_dc").html(php_msg);
                });
        }

        function show_list1(myform1) {
                $.get('show_list1.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#list1").html(php_msg);
                });
        }


        function show_list2(myform2) {
                $.get('show_list2.php',
                $(myform2).serialize(),
                function(php_msg) {
                        $("#list2").html(php_msg);
                });
        }

        function show_list3(myform1) {
                $.get('show_list3.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#list1").html(php_msg);
                });
        }

        function new_prc(myform2) {
                $.get('new_prc.php',
                $(myform2).serialize(),
                function(php_msg) {
                        $("#new_prc").html(php_msg);
                });
        }


        function load_ct(myform) {
                $.get('load_ct.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#contacts").html(php_msg);
                });
        }
	function load_dp(myformA) {
                $.get('load_dp.php',
                $(myformA).serialize(),
                function(php_msg) {
                        $("#top").html(php_msg);
                });
		
	}
        function load_prc(myformB) {
                $.get('load_prc.php',
                $(myformB).serialize(),
                function(php_msg) {
                        $("#bot").html(php_msg);
                });

        }

</script>
{/literal}
