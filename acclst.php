<?php include 'leftmenu.php'; ?>

<h1>account</h1>

<?php
include 'connect.php';
$ordcol = 1;
	echo "<table><tr><th>id<th align=\"center\">account</td><td colspan=\"3\" align=\"center\"><a href=\"accaddfm.php\">add</a></td></tr>";
	$sql = "select account_id accd, account_name acc
		from account
		order by " . $ordcol;
		//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['accd'] .
		"</td><td>" . $row['acc'] .
		"</td>
		<td><a href=\"accmodfm.php?accd=" . $row['accd'] . "\">mod</a></td>
		<td><a href=\"accdelpt.php?accd=" . $row['accd'] . "\">del</a></td>";
	}
	echo "</table>";
//include 'sitemap.php';
?>
