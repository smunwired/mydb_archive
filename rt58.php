<?php include 'leftmenu.php'; ?>
<h1>creditors</h1>
<table>
<tr><th>creditor id<th>creditor<th>branch id<th>branch<td align="center"><td colspan="2" align="center"><a href="crdaddfm.php">add</a></td></tr>
<?php
	$sql="select rdate,tm,dst,av,mx,ood,notes,costs,total,amortize from rt58";
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['rdate'] . "</td>
			<td>" . $row['tm'] . "</td>
			<td>" . $row['dst'] . "</td>
			<td>" . $row['av'] . "</td>
			<td>" . $row['mx'] . "</td>
			<td>" . $row['ood'] . "</td>
			<td>" . $row['notes'] . "</td>
			<td>" . $row['costs'] . "</td>
			<td>" . $row['total'] . "</td>
			<td>" . $row['amortize'] . "</td></tr>";
	}
echo "</table>";
?>