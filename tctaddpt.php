<?php
include '../trxnmenu.php';
?>
<h2>Artist Add Post</h2>
<?php
include 'connect.php';
$col1 = $_POST['col1'];
$col2 = $_POST['col2'];

try {

	$sql = "insert into " . $_POST['tbl'] . "(" . $col1 . "," . $col2 . ") values (" . $_POST["id"] . ",\"" . $_POST["dsc"] . "\")";
	// Prepare statement

	$stmt = $conn->prepare($sql);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo $stmt->rowCount() . " records INSERTED successfully";
	echo "<br/><a href=\"maint.php\">two column tables</a>";
} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


include '../sitemap.php';
?>
