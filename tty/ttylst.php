<?php include 'leftmenu.php'; ?>

<h1>tran type</h1>

<?php
include 'connect.php';
$ordcol = 1;
	echo "<table style=\"margin:auto;border:solid; width:50%\"><tr><th>id<th align=\"center\">tran type</td><td colspan=\"3\" align=\"center\"><a href=\"ttyaddfm.php\">add</a></td></tr>";
	$sql = "select tran_type_id ttyd, tran_type tty
		from tran_type
		order by " . $ordcol;
		//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['ttyd'] .
		"</td><td>" . $row['tty'] .
		"</td>
		<td><a href=\"ttymodfm.php?id=" . $row['ttyd'] . "\">mod</a></td>
		<td><a href=\"ttydelpt.php?id=" . $row['ttyd'] . "\">del</a></td>";
	}
	echo "</table>";
//include 'sitemap.php';
?>
