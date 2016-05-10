<!DOCTYPE html>
<html lang="en">

<head>
{literal}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BLN | DOT Tracker</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/desktop.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <!--<script src="js/jquery.min.js"></script>-->

   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
   <script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"></script>
   <script src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"></script>

  <script>
  $(function() {
    var availableTags = [
	// results here
    ];
    $( "#project_number" ).autocomplete({
      source: availableTags,
      appendTo: "#container",
      position: { my : "right bottom", at: "right bottom" },
      //<!-- Added SELECT event -kjg //-->
      select: function (event, ui) {
        $( "#project_number" ).val(ui.item.label);
                document.getElementById('project_number').value = ui.item.label;
        redirect_page()
        },
      //<!-- END //-->
      minLength: 1
    });
  });
  </script>

<script>
$(function() {
$( "#TargetDate" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#TargetDateOut" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#ActualDate" ).datepicker({dateFormat: "yy-mm-dd"});
$( "#DateIn"     ).datepicker({dateFormat: "yy-mm-dd"});
$( "#DateOut"    ).datepicker({dateFormat: "yy-mm-dd"});
$( "#date1"      ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
});
$( "#date2"      ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
});
});
</script>


<style>
tr.noBorder td {border: 0; }
</style>

{/literal}
</head>
