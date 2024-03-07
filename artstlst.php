<?php include 'leftmenu.php'; ?>
<h1>Artists</h1>

<?php
include 'connect.php';
	echo "<table class=\"nobr\">
		<tr>
			<th>artist
			<td colspan=\"3\"><a href=\"artist/artstadd.php\">add</a></td>
		</tr>";
	/*
	$sql = "select id, concat(prefix,
		case when length(prefix)=0 then '' else ' ' end,firstname,
		case when length(firstname)=0 then '' else ' ' end,lastname,
		case when length(lastname)=0 then '' else ' ' end,joinstr,
		case when length(joinstr)=0 then '' else ' ' end,bandname) artist,
		case length(lastname) when 0 then bandname else lastname end ordcol
		from artist
		order by ordcol";
	*/
	if (empty($_GET['id'])) {
		$whr = " where 1=1 ";
	} else {
		$whr = " where id = " . $_GET['id'];
	}
	$sql = "select id, fnfullname(id) artist,
		case length(lastname) when 0 then bandname else lastname end ordcol
		from artist " . $whr .
		" order by ordcol";
		//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['artist'] .
			"</td>
			<td><a href=\"artist/artmodfm.php?id=" . $row['id'] . "\">mod</a></td>
			<td><a href=\"artist/artstdel.php?id=" . $row['id'] . "\">del</a></td>
			<td><a href=\"/mydb/titlelst.php?artist=" . $row['id'] . "&artstnm=" . $row['artist'] . "\">list</a></td>
		</tr>";
	}
	echo "</table>";
include 'sitemap.php';
?>
