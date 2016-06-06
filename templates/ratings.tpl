<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="ratings">
<input type="hidden" name="ProjectID" value="{$ProjectID}">
<input type="hidden" name="id" value="{$ID}">

<div id="ratings">

<br>

<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_rt(this.form)"><option value="">Select to Load</option>
                {$ProjectList}</select></td>
        </tr>
</table>

<br>

<table border=0 width=80%>
<tr>
        <td width=200>Submittal Type:</td><td><select name="submission" style="width:200px">
        {$tbd}

        </select></td>
</tr>
<tr>
        <td>Design Concept:</td><td><select name="design_concept" style="width:200px">
        
        {if $design_concept ne ""}
        <option selected>{$design_concept}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>4.5</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part1').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part1" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td width=20>5</td><td>complies w/Recon Report AND cost effective</td></tr>
<tr><td>4.5</td><td>complies w/Recon Report</td></tr>
<tr><td>4</td><td>minor undisclosed deviation from Recon Report </td></tr>
<tr><td>3</td><td>major undisclosed deviation from Recon Report </td></tr>
<tr><td>2</td><td>two or three major undisclosed deviations from Recon Report </td></tr>
<tr><td>1</td><td>does not comply with Recon Report.</td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part1').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>


<tr>
        <td>Controlling Criteria:</td><td><select name="controlling_criteria" style="width:200px">

        {if $controlling_criteria ne ""}
        <option selected>{$controlling_criteria}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part2').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part2" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>All criteria are satisfactory OR deviation is noted</td></tr>
<tr><td>4</td><td>Not an option.</td></tr>
<tr><td>3</td><td>one substandard, unnoted deviation </td></tr>
<tr><td>2</td><td>two substandard, unnoted deviations</td></tr>
<tr><td>1</td><td>three or more substandard, unnoted deviations</td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part2').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>


<tr>
        <td>Computations & Reports:</td><td><select name="computations_reports" style="width:200px">
        {if $computations_reports ne ""}
        <option selected>{$computations_reports}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part3').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part3" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>Clear and complete; all initialed by designer and reviewer </td></tr>
<tr><td>4</td><td>Minor clarifications req’d; all initialed by designer and reviewer</td></tr>
<tr><td>3</td><td>Minor errors, no review initials on one or more calculations</td></tr>
<tr><td>2</td><td>Missing some calculations and reports</td></tr>
<tr><td>1</td><td>No calculations included </td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part3').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>

<tr>
        <td>Plans Quality:</td><td><select name="plans_quality" style="width:200px">
        {if $plans_quality ne ""}
        <option selected>{$plans_quality}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>4.5</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part4').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part4" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>No markups, proper sequence, initialed by checker</td></tr>
<tr><td>4.5</td><td>minor mark-ups and comments</td></tr>
<tr><td>4</td><td>need minor improvement, ex: print size</td></tr>
<tr><td>3</td><td>need significant improvement </td></tr>
<tr><td>2</td><td>not acceptable, resubmission is required</td></tr>
<tr><td>1</td><td>not acceptable, total disarray</td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part4').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>


<tr>
        <td>Engineering Judgement:</td><td><select name="engineering_judgement" style="width:200px">
        {if $engineering_judgement ne ""}
        <option selected>{$engineering_judgement}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part5').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part5" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>design alternative w/additional benefits</td></tr>
<tr><td>4</td><td>meet all design stds. and complies w/Recon Report</td></tr>
<tr><td>3</td><td>plans do not provide the best solution to the proposed scope</td></tr>
<tr><td>2</td><td>plans do not address scope; can be corrected</td></tr>
<tr><td>1</td><td>plans do not address scope; resubmittal is req’d</td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part5').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>

<tr>
        <td>Documentation:</td><td><select name="documentation" style="width:200px">
        {if $documentation ne ""}
        <option selected>{$documentation}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part6').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part6" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>Clear and understandable documentation </td></tr>
<tr><td>4</td><td>Minor clarification required </td></tr>
<tr><td>3</td><td>Minor errors in the documentation </td></tr>
<tr><td>2</td><td>Failure to provide some documentation </td></tr>
<tr><td>1</td><td>Failure to provide any documentation </td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part6').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>

<tr>
        <td>Quality Assurance:</td><td><select name="qa" style="width:200px">
        {if $qa ne ""}
        <option selected>{$qa}</option>
        {/if}
                <option>N/A</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
        </select>&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('part7').style.display='table-row';">Explain</a></td>
</tr>

<tr id="part7" style="display:none">
<td width=200>&nbsp;</td><td>
<table border=0 width=500>
<tr><td>5</td><td>All computations initialed by Designer and Reviewer</td></tr>
<tr><td>4</td><td>One or two computations not initialed by Designer and Reviewer</td></tr>
<tr><td>3</td><td>Several computations not initialed by Designer and Reviewer</td></tr>
<tr><td>2</td><td>All computations not initialed by the Designer or Reviewer</td></tr>
<tr><td>1</td><td>No activities associated with the submittal have been completed</td></tr>
<tr><td colspan=2><a href="javascript:void(0)" onclick="document.getElementById('part7').style.display='none'">Close</a><br><hr></td></tr>
</table>
</td></tr>


</table>

<table border=0 width=100% class="table">
<tr bgcolor="#F0F0F0">
        <td width=250>Submission</td>
        <td width=100>Design Concept</td>
        <td width=100>Controlling<br>Criteria</td>
        <td width=100>Computations <br>& Reports</td>
        <td width=100>Plans<br>Quality</td>
        <td width=100>Engineering<br>Judgement</td>
        <td width=100>Documentation</td>
        <td width=100>Quality<br>Assurance</td>
</tr>

{$data}

</table>
</div>
</form>

{literal}
<script>
        function load_rt(myform) {
                $.get('load_rt.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#ratings").html(php_msg);
                });
        }
</script>
{/literal}

