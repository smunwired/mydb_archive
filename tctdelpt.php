<?php
include '../trxnmenu.php';
?>
<h2><?php echo $_GET['tbl']; ?> Delete Post</h2>
<?php
include 'connect.php';
$col1 = $_GET['col1'];
$col2 = $_GET['col2'];

try {

	$sql = "delete from " . $_GET['tbl'] . " where " . $_GET['ky'] . "=" . $_GET["vl"];
	// Prepare statement

	$stmt = $conn->prepare($sql);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo $stmt->rowCount() . " records DELETED successfully";
	echo "<br/><a href=\"maint.php\">two column tables</a>";
} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


include '../sitemap.php';
?>
