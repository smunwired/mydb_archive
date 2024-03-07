<!--
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
-->
<?php include 'leftmenu.php'; ?>
<?php include 'connect.php'; ?>
<h1>creditors</h1>
<div>
<table class="center"><tr><th>id<th>creditor<td colspan="2"><a href="crdaddfm.php"></td></tr>
<?php
$sql="select creditor_id crdd,creditor crd,count(distinct branch.branch_id) brnc from creditor
	left join transdet on transdet.cred_id=creditor.creditor_id
	left join branch on branch.branch_id = transdet.branch_id group by  creditor_id,creditor";
$sql="select id crdd,nm crd,count(c2.id) brnc from transdet join crd c1 on c1.id=crdd join crd c2 on c2.id=brnd group by id,nm";
$sql="select c1.id crdd,c1.nm crd,count(c2.id) brnc from transdet join crd c1 on c1.id=crdd left join crd c2 on c2.id=brnd group by c1.id,c1.nm order by 2";
$sql="select id crdd,nm crd from crd where exists (select * from transdet where transdet.brnd=crd.id) order by 2";
$sql="select \"cred\" typ,id crdd,nm crd from crd where exists (select * from transdet where transdet.crdd=crd.id) union
select \"bran\" typ,id crdd,nm crd from crd where exists (select * from transdet where transdet.brnd=crd.id) order by 1,3";
echo $sql;

$hd="first";
foreach($conn->query($sql) as $row) {
	//echo "typ : " . $row['typ'];
	//if ($hd=="first"){echo $row['typ']; echo "<tr><td colspan=\"4\" align=\"center\"><h1>Creditors</h1></td></tr>";$hd==$row['typ'];echo $hd;}

	//if ($row['typ']=="cred") {
	//
	//}
	//if ($row['typ']=="bran") {
	//	echo "<tr><td align=\"center\">Branches</td></tr>";
	//}

	echo "<tr valign=\"top\"><td>" . $row['crdd'] . "</td>	<td>" . $row['typ'] . "</td> <td><a href=list.php?crdd=" . $row['crdd'] . ">" . $row['crd'] . "</a></td><td><a href=\"crdmodfm.php?crdd=" . $row['crdd'] . "\">mod</a></td><td><a href=\"crddelpt.php?crdd=" . $row['crdd'] . "\">del</a></td>";
/*
	if ($row['brnc']>0) {
		if (($_GET['action']=="brn")&&($_GET['crdd']==$row['crdd'])) {
			echo "<td align=\"center\"><a href=\"crd.php\">hide branches</a></td></tr>";
			$brnq = "select branch_id,branch_name from branch where branch_id in (select branch.branch_id from transdet
			join creditor on transdet.cred_id=creditor.creditor_id join branch on transdet.branch_id=branch.branch_id
			where transdet.cred_id=" . $_GET['crdd']. ")";
			$brnq="select id brnd,nm brn from transdet join crd on brnd=id where crdd=" . $_GET['crdd'] . " group by brnd, brn order by 2";
			//echo $brnq;
			echo "<tr><td colspan=5><table class=\"center\"><tr><td>&nbsp;</td><td>&nbsp;</td><td><a href=\"cadd.php\">add</a></td>";
			foreach($conn->query($brnq) as $brow) {
				echo "<tr><td>" . $brow['brnd'] . "</td><td>" . $brow['brn'] . "</td><td><a href=\"cmod\">mod</a> <a href=\"cdel\">del</a></td></tr>";
			}
			echo "</table></td></tr>";
		} else {
			echo "<td><a href=\"crd.php?action=brn&crdd=" . $row['crdd'] . "\">list branches</a></td></tr>";
		}
	} else {
		echo "<td align=\"center\"><a href=\"crd.php?action=addb\">add branch</a></td></tr>";
	}
	*/
}
?>
</table>
</div>
</body>
</html>