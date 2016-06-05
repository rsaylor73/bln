<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="deficiencies">
<input type="hidden" name="ProjectID" value="{$ProjectID}">
<input type="hidden" name="id" value="{$ID}">

<br>

<table border=0 width=100%>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" id="load_project" onchange="load_dd(this.form)"><option value="">Select to Load</option>{$ProjectList}</select></td>
        </tr>
</table>

<b>Number of U N I D E N T I F I E D Design Deficiencies</b><br><br>

<div name="deficiencies">
<table border=0 width=100%>
        <tr><td width=50% valign=top>
                <table border=0 width=100%>
                        <tr><td colspan=3 align="center"><b>Controlling Criteria:</b></td></tr>
                        <tr>
                        	<td align="right">Design Speed</td>
                        	<td>1&nbsp;&nbsp;</td>
                        	<td><input type="text" name="DesignSpeed" value="{$DesignSpeed}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Lane Widths</td>
                        	<td>2&nbsp;&nbsp;</td>
                        	<td><input type="text" name="LaneWidths" size="2" value="{$LaneWidths}"></td>
                        </tr>
                        <tr>
                        	<td align="right">Shdr Width</td>
                        	<td>3&nbsp;&nbsp;</td>
                        	<td><input type="text" name="ShdrWidth_CurbOffset" value="{$ShdrWidth_CurbOffset}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Bridge Width (Br Clr Rdwy)</td>
                        	<td>4&nbsp;&nbsp;</td>
                        	<td><input type="text" name="BridgeWidth" value="{$BridgeWidth}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Horizontal Alignment (Min Radius)</td>
                        	<td>5&nbsp;&nbsp;</td>
                        	<td><input type="text" name="HorizontalCurves" value="{$HorizontalCurves}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Superelevation Rate</td>
                        	<td>6a&nbsp;</td>
                        	<td><input type="text" name="SuperElevationRate" value="{$SuperElevationRate}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Transition Length (no DE req)</td>
                        	<td>6b&nbsp;</td>
                        	<td><input type="text" name="VerticalCurves" value="{$VerticalCurves}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Vertical Alignment (SSD)</td>
                        	<td>7&nbsp;&nbsp;</td>
                        	<td><input type="text" name="SuperElevationTransitionLengths" value="{$SuperElevationTransitionLengths}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Maximum Grade</td>
                        	<td>8&nbsp;&nbsp;</td>
                        	<td><input type="text" name="MaximumGrade" value="{$MaximumGrade}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Stopping Sight Distance (Horizontal)</td>
                        	<td>9&nbsp;&nbsp;</td>
                        	<td><input type="text" name="ObstructionFreeZone" value="{$ObstructionFreeZone}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Travel Lane Cross Slope</td>
                        	<td>10&nbsp;</td>
                        	<td><input type="text" name="TravelLaneCrossSlope" value="{$TravelLaneCrossSlope}" size="2"></td>
                        </tr>
                </table>
        </td><td valign=top>
                <table border=0 width=100%>
                        <tr>
                        	<td align="right">Minimum Vertical Clearance</td>
                        	<td>11</td>
                        	<td><input type="text" name="MinimumVerticalClearance" value="{$MinimumVerticalClearance}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Lateral offset to obstruction</td>
                        	<td>12</td>
                        	<td><input type="text" name="LateralOffsetToObstruction" value="{$LateralOffsetToObstruction}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Structural Capacity / Loading</td>
                        	<td>13a</td>
                        	<td><input type="text" name="StructuralCapacity" value="{$StructuralCapacity}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Bridge Safety Rail Performance Criteria</td>
                        	<td>13b</td>
                        	<td><input type="text" name="BridgeSafety" value="{$BridgeSafety}" size="2"></td>
                        </tr>
                        <tr>
                        	<td colspan=3 align="center"><b>Other:</b></td>
                        </tr>
                        <tr>
                        	<td align="right">Accessibility Requirements</td>
                        	<td>14</td>
                        	<td><input type="text" name="AccessibilityRequirements" value="{$AccessibilityRequirements}" size="2"></td>
                        </tr>
                        <tr>
                        	<td colspan=3 align="center"><b>Secondary Safety Elements:</b></td>
                        </tr>
                        <tr>
                        	<td align="right">Guardrail Length of Need</td>
                        	<td>15</td>
                        	<td><input type="text" name="GuardrailLength" value="{$GuardrailLength}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Guardrail End of Treament</td>
                        	<td>16</td>
                        	<td><input type="text" name="GuardrailEndTreatment" value="{$GuardrailEndTreatment}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Intersection Sight Distance</td>
                        	<td>17</td>
                        	<td><input type="text" name="IntersectionSightDistance" value="{$IntersectionSightDistance}" size="2"></td>
                        </tr>
                        <tr>
                        	<td align="right">Milestone Description</td>
                        	<td colspan=2><select name="Description">{$Description}</select></td>
                        </tr>
                </table>
        </td></tr>
</table>
</form>

<br><br>
<table border=1 width=100%>
<tr>
	<td>Description</td>
	<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6a</td><td>6b</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13a</td>
	<td>13b</td><td>14</td><td>15</td><td>16</td><td>17</td>
</tr>
	{$data}
</table>
<br><br>
</div>
</form>

{literal}
<script>
        function load_dd(myform) {
                $.get('load_dd.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#deficiencies").html(php_msg);
                });
        }
</script>
{/literal}