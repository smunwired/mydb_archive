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
<?php if ((empty($_GET['yrs']))) { $yrs="1000"; } else { $yrs = $_GET['yrs']; } ?>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>yrs : </b>
	<?php
			echo "<input name=\"yrs\" value=\"" . $yrs . "\" onchange=\"this.form.submit();\" >";
	?>
</div>


<h1>creditors</h1>
<div>
<table width="100%">
	<tr>
		<th>id
		<th width="50%" align="left" >creditor
		<th align="center">branches
		<th align="center\">trans
		<td colspan="2"><a href="crdaddfm.php"></td>
	</tr>
<?php

$sql="select creditor_id crdd,creditor crd,count(distinct branch.branch_id) brnc from creditor
	left join transdet on transdet.cred_id=creditor.creditor_id
	left join branch on branch.branch_id = transdet.branch_id group by  creditor_id,creditor";
$sql="select id crdd,nm crd,count(c2.id) brnc from transdet join crd c1 on c1.id=crdd join crd c2 on c2.id=brnd group by id,nm";
$sql="select c1.id crdd,c1.nm crd,count(c2.id) brnc from transdet join crd c1 on c1.id=crdd left join crd c2 on c2.id=brnd group by c1.id,c1.nm order by 2";
$sql="select id crdd,nm crd from crd where exists (select * from transdet where transdet.brnd=crd.id) order by 2";
$sql="select \"cred\" typ,id crdd,nm crd from crd where exists (select * from transdet where transdet.crdd=crd.id) union
select \"bran\" typ,id crdd,nm crd from crd where exists (select * from transdet where transdet.brnd=crd.id) order by 1,3";
$sql="select c.id crdd,c.nm crd,b.nm brn, count(b.id) bcnt, count(*) count from transdet join crd c on crdd=c.id left outer join crd b on brnd=b.id group by c.nm,b.nm order by 2";
$sql="select c.id crdd,c.nm crd,count(b.id) bcnt, count(*) count
from transdet join crd c on crdd=c.id left outer join crd b on brnd=b.id
where transdet.tran_date > date_sub(now(),interval " . $yrs . " YEAR) group by c.nm order by 2";
echo $sql;

foreach($conn->query($sql) as $row) {
	echo "<tr valign=\"top\">
		<td align=\"center\">" . $row['crdd'] . "</td>
<!--		<td align=\"left\">" . $row['typ'] . "</td>		-->
		<td align=\"left\"><a href=list.php?crdd=" . $row['crdd'] . ">" . $row['crd'] . "</a></td>";
	if ($row['bcnt']>0) {
		if (($_GET['action']=="show")&&($_GET['crdd']==$row['crdd'])) {
			echo "<td align=\"center\"><a href=\"crd.php?action=hide&crdd=" . $row['crdd'] . "\">hide</a></td>";
		} else {
			echo "<td align=\"center\"><a href=\"crd.php?action=show&crdd=" . $row['crdd'] . "\">show</a></td>";
		}
	} else {
		echo "<td>&nbsp;</td>";
	}
	//	} else {
	//		echo "<td><a href=\"crd.php?action=show&crdd=" . $row['crdd'] . "\">show</a></td>";
			//} else {echo "<td>&nbsp;</td>";
	//	}
	//	}
	echo "<td align=\"center\">" . $row['count'] . "</td>";
	echo "<td><a href=\"mod.php?actn=mdfm&tbl=crd&id=" . $row['crdd'] . "\">mod</a></td>
		<td><a href=\"crddelpt.php?crdd=" . $row['crdd'] . "\">del</a></td>";
	if ($_GET['action']=="show") {
		if ($_GET['crdd']==$row['crdd']) {
			$bsql = "select id brnd,nm brn,count(*) rws from transdet join crd on brnd=id where crdd=" . $row['crdd'] . " group by brnd,brn";
			echo "<tr>
				<td colspan=6 align=center><table width=\"80%\">";
				foreach($conn->query($bsql) as $brow) {
					echo "<tr>
						<td>" . $brow['brnd'] . "</td>
						<td><a href=\"list.php?whr= and brnd=" . $brow['brnd'] . "\">" . $brow['brn'] . "</a></td>
						<td>" . $brow['rws'] . "</td>
						<td><a href=crd.php?action=mod&brnd=" . $brow['brnd'] . ">mod</a> <a href=crd.php?action=del&brnd=" . $brow['brnd'] . ">del</a></td>
					</tr>";
				}
				echo "</table></td>
			</tr>";
		}
	}
}
?>
</table>
</div>
</form>
</body>
</html>