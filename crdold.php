<html>
<head>
	<title>creditors</title>
	<style>
	h1, h2, p {
	    text-align: center;
	    color: red;
	}
	table.center {
	    margin-left:auto;
	    margin-right:auto;
  	}
	</style>
</head>
<body>
<?php include 'connect.php'; ?>
<h1>creditors</h1>
<div>
<table class="center"><tr><th>id<th>creditor<td colspan="2"><a href="crdaddfm.php"></td></tr>
<?php
$sql="select creditor_id crdd,creditor crd,count(distinct branch.branch_id) brnc from creditor
	left join transdet on transdet.cred_id=creditor.creditor_id
	left join branch on branch.branch_id = transdet.branch_id group by  creditor_id,creditor";
foreach($conn->query($sql) as $row) {

	echo "<tr valign=\"top\"><td>" . $row['crdd'] . "</td>	<td><a href=list.php?crdd=" . $row['crdd'] . ">" . $row['crd'] . "</a></td><td><a href=\"crdmodfm.php?crdd=" . $row['crdd'] . "\">mod</a></td><td><a href=\"crddelpt.php?crdd=" . $row['crdd'] . "\">del</a></td>";

	if ($row['brnc']>0) {
		if (($_GET['action']=="brn")&&($_GET['crdd']==$row['crdd'])) {
			echo "<td align=\"center\"><a href=\"crd.php\">hide branches</a></td></tr>";
			$brnq = "select branch_id,branch_name from branch where branch_id in (select branch.branch_id from transdet
			join creditor on transdet.cred_id=creditor.creditor_id join branch on transdet.branch_id=branch.branch_id
			where transdet.cred_id=" . $_GET['crdd']. ")";
			//echo $brnq;
			echo "<tr><td colspan=5><table class=\"center\"><tr><td>&nbsp;</td><td>&nbsp;</td><td><a href=\"cadd.php\">add</a></td>";
			foreach($conn->query($brnq) as $brow) {
				echo "<tr><td>" . $brow['branch_id'] . "</td><td>" . $brow['branch_name'] . "</td><td><a href=\"cmod\">mod</a> <a href=\"cdel\">del</a></td></tr>";
			}
			echo "</table></td></tr>";
		} else {
			echo "<td><a href=\"crd.php?action=brn&crdd=" . $row['crdd'] . "\">list branches</a></td></tr>";
		}
	} else {
		echo "<td align=\"center\"><a href=\"crd.php?action=addb\">add branch</a></td></tr>";
	}
}
?>
</table>
</div>
</body>
</html>