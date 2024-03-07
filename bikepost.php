<h1>bike modify post</h1>
<?php
include 'connect.php';
$sql="update bike set rdate='" . $_POST['rdate'] . "',
	tm='" . $_POST['tm'] . "',
	dst=" . $_POST['dst'] . ",
	av=" . $_POST['av'] . ",
	mx=" . $_POST['mx'] . ",
	notes='" . $_POST['notes'] . "'
	where odo = " . $_POST['odo'];
echo $sql;
try {
	// Prepare statement
	$stmt = $conn->prepare($sql);
	// execute the query
	$stmt->execute();
	// echo a message to say the UPDATE succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) UPDATED successfully<br/><a href=\"bike.php\">list</a>";
} catch(PDOException $e) {
	echo "<br/> PDO failure <br/>" . $e->getMessage();
}

?>
