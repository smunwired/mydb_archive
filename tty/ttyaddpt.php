<?php
include '../trxnmenu.php';
?>
<h2>Artist Add Post</h2>
<?php
include 'connect.php';

try {

	$sql = "insert into tran_type(tran_type_id,tran_type) values (" . $_POST["ttyd"] . ",\"" . $_POST["tty"] . "\")";
	// Prepare statement

	$stmt = $conn->prepare($sql);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo $stmt->rowCount() . " records INSERTED successfully";
	echo "<br/><a href=\"ttylst.php\">list tran types</a>";
} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


include '../sitemap.php';
?>
