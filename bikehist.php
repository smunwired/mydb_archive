<?php include 'topmenu.php'; ?>
<h1>bikehist</h1>

<?php
include 'connect.php';
	echo "<table width=\"70%\" align=\"center\"><tr><th>date<th>time<th>distance<th>average<th>max<th>notes<td colspan=\"2\" align=\"center\"><a href=\"bkhaddfm.php\">add</a></td></tr>";
//	$sql = "select rdate,tm,dst,av,mx,odo,notes,cost,total,amortize from bikeimp";
	$sql = "select * from bikehist";
		echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['rdt'] . "</td>" .
		"<td>" . $row['tm'] . "</td>" .
		"<td>" . $row['dst'] . "</td>" .
		"<td>" . $row['av'] . "</td>" .
		"<td>" . $row['mx'] . "</td>" .
		"<td>" . $row['nts'] . "</td>" .
		"<td><a href=\"bkhmodfm.php?id=" . $row['id'] . "\">mod</a></td>
		<td><a href=\"bkhdelt.php?id=" . $row['id'] . "\">del</a></td></tr>";
	}
	echo "</table>";
include 'sitemap.php';
?>
