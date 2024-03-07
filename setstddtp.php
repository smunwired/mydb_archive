<?php
include 'connect.php';
echo "std : " . $_POST['std'];
echo "tid : " . $_POST['tid'];
$set="update transdet set statement_date = '" . $_POST['std'] . "' where tran_id = " . $_POST['tid'];
echo "set " . $set;
try {
$stmt = $conn->prepare($set);
$stmt->execute();
echo $stmt->rowCount() . " transdet statement dates UPDATED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
