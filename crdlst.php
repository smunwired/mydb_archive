<html>
<body>
<table width="100%">
<tr><td><h1>creditors</h1></td><td width="40%" align="right">
	<!--
	<table><tr>
		<td>sort by</td><td>tid</td><td><input name="srtcol" type="radio" value="tid" checked /></td>
		<td>trd</td><td><input name="srtcol" type="radio" value="trd" /></td>
		<td>std</td><td><input name="srtcol" type="radio" value="std" /></td>
		<td>asc/desc</td><td><input name="srtdr" type="radio" value="asc" /></td><td><input name="srtdr" type="radio" value="dsc" checked /></td>
		<td>limit</td><td><input name="lmt" value="22" /></td>
	</tr></table>
	-->
	</td>
</tr></table>

<table>
<tr><th>creditor id<th>creditor<td colspan="3" align="center"><a href="crdaddfm.php">add</a></td><th>branch id<th>branch<td align="center"></td></tr>
<?php
$servername = "192.168.56.104";
$username = "trxnuser";
$password = "trxnpass";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=trxndb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

	$sql="select creditor.creditor_id crdd, creditor.creditor crd, branch.branch_id brnd,branch.branch_name brn
	from creditor
	left join branch on creditor.creditor_id=branch.creditor_id
	order by crd,brn";
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['crdd'] . "</td>
			<td>" . $row['crd'] . "</td>
			<td><a href=\"crdmodfm.php?crdd=" . $row['crdd'] . "\">mod</a></td>
			<td><a href=\"crddelpt.php?crdd=" . $row['crdd'] . "\">del</a></td>
			<td><a href=\"brnaddfm.php?crdd=" . $row['crdd'] . "\">add branch</a></td>
			<td>" . $row['brnd'] . "</td>
			<td>" . $row['brn'] . "</td>
			<td><a href=\"brnmodfm.php?brnd=" . $row['brnd'] . "\">mod</a></td>
			<td><a href=\"brndelpt.php?brnd=" . $row['brnd'] . "\">del</a></td></tr>";
	}
	echo "</table>";

} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>