<html>
<body>
<h1>The Collected Thoughts of Chairman Stef</h1>
<?php
echo $_GET['action'];
include 'connect.php';
if ($_GET['action']=="add") {
	try {
		$sql = "insert into paragraph (text) values (\"" . $_POST['txt'] . "\")";
		echo $sql;
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo "<br/>" . $stmt->rowCount() . " paragraph rows INSERTED<br/>";
	} catch(PDOException $e){
		echo "<br/>" . $e;
	}
}
foreach($conn->query("select * from paragraph") as $row) {
	echo $row['date_added'] . ":" . $row['text'];
}
?>
<form method="get" action="paragraph.php?action=add">
<p/>
<textarea name="txt" rows="5" cols="20">thoughts ?</textarea>

<p/><input type="submit" value="done?"></td></tr>
</form>

</body>

</html>
