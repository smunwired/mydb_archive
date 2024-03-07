<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<HTML>
  <HEAD>
    <TITLE>two column table maint</TITLE>
    <STYLE type="text/css">
      IMG, DIV { float: left; margin: 2em }
      BODY, P, IMG { margin: 2em }
    </STYLE>
  </HEAD>
  <BODY>
  <!--
    <P><IMG src=img.png alt="This image will illustrate floats">
       Some sample text that has no other...

       <div>div 1 stuff</div><div>div 2 stuff</div>
       -->
<?php include '../trxnmenu.php';
function tctlst($ordcol,$tbl,$id,$dsc) {
include 'connect.php';
	echo "<table><tr><th>id<th align=\"center\">desc</td><td colspan=\"3\" align=\"center\"><a href=\"tctaddfm.php?tbl=" . $tbl . "&col1=" . $id . "&col2=" . $dsc . "\">add</a></td></tr>";
	$sql = "select " . $id . " id, ". $dsc . " dsc
		from " . $tbl . "
		order by " . $ordcol;
		//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['id'] .
		"</td><td>" . $row['dsc'] .
		"</td>
		<td><a href=\"tctmodfm.php?tbl=" . $tbl . "&ky=" . $id . "&vl=" . $row['id'] . "&str=" . $dsc . "\">mod</a></td>
		<td><a href=\"tctdelpt.php?tbl=" . $tbl . "&ky=" . $id .  "&vl=" . $row['id'] . "\">del</a></td>";
	}
	echo "</table>";

}
?>

<div>
<h1>tran type</h1>
<?php tctlst("1","tran_type","tran_type_id","tran_type"); ?>
</div>

<div>
<h1>account</h1>
<?php tctlst("1","account","account_id","account_name"); ?>
</div>

<div>
<h1>frequency</h1>
<?php tctlst("1","frequency","freq_id","freq_name"); ?>
</div>

<div>
<h1>cost center</h1>
<?php tctlst("1","cost_center","cost_code","cost"); ?>
</div>

<div>
<h1>creditor</h1>
<?php tctlst("1","creditor","creditor_id","creditor"); ?>
</div>

<div>
<h1>branch</h1>
<?php tctlst("1","branch","branch_id","branch_name"); ?>
</div>

</BODY>
</HTML>

