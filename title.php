<?php include 'leftmenu.php'; ?>
<h1>title</h1>
<table>
<tr><th>title<th>prefix<th>first_released<th>compilation
<?php
include 'connect.php';
$sql="select * from title where artist = " . $_GET['artist'];
echo "<table><tr><td>&nbsp;</td><td align=\"center\" colspan=\"3\"><a href=\"ttlmdadf.php\">add</a></td></tr>";
foreach($conn->query($sql) as $row) {
	echo "<tr>
		<td>" . $row['title'] . "</td>
		<td>" . $row['prefix'] . "</td>
		<td>" . $row['first_released'] . "</td>
		<td>" . $row['compilation'] . "</td>
		<td><a href=\"media.php?id=" . $row['title'] . "\">media</a></td>
	</tr>";
}
?>
</table>
</body>
</html>