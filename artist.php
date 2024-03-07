<?php include 'leftmenu.php'; ?>
<h1>artist</h1>
<?php
include 'connect.php';
$sql="select id,concat(prefix artist from artist order by concat(lastname,bandname,collaborators)";
$sql = "select id, concat(prefix,
	case when length(prefix)=0 then '' else ' ' end,firstname,
	case when length(firstname)=0 then '' else ' ' end,lastname,
	case when length(lastname)=0 then '' else ' ' end,joinstr,
	case when length(joinstr)=0 then '' else ' ' end,bandname) artist,
	case length(lastname) when 0 then bandname else lastname end ordcol
	from artist
	order by ordcol";
$sql = "select id, concat(prefix,
	case when length(prefix)=0 then '' else ' ' end,firstname,
	case when length(firstname)=0 then '' else ' ' end,lastname,
	case when length(lastname)=0 then '' else ' ' end,joinstr,
	case when length(joinstr)=0 then '' else ' ' end,bandname,
	case when length(bandname)=0 then '' else ' ' end,collaborators) artist
	from artist
	order by concat(lastname,bandname,collaborators)";
//echo $sql;
echo "<table><tr><td>&nbsp;</td><td align=\"center\" colspan=\"3\"><a href=\"artstadf.php\">add</a></td></tr>";
foreach($conn->query($sql) as $row) {
	//echo $row['prefix'] . $row['firstname'] . $row['lastname'] . $row['joinstr'] . $row['bandname'] . $row['collaborators'] . "<br/>";
	echo "<tr><td>" . $row['artist'] . "</td>
		<td><a href=\"artstmdf.php?id=" . $row['id'] . "\">mod</a></td>
		<td><a href=\"artstdlp.php?id=" . $row['id'] . "\">del</a></td>
		<td><a href=\"title.php?artist=" . $row['id'] . "\">titles</a></td>
	</tr>";
}
echo "</table>";
?>