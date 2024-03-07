<?php
include 'connect.php';
$isrt="update artist set prefix = \"" . $_POST['prf'] . "\",firstname = \"" . $_POST['frs'] . "\",lastname= \"" . $_POST['lst'] . "\",joinstr=\"" . $_POST['jns'] . "\",
	bandname=\"" . $_POST['bnd'] . "\",collaborators=\"" . $_POST['clb'] . "\" where id = 49";
//echo "<p/>" . $isrt;
try {
$stmt = $conn->prepare($isrt);
$stmt->execute();
echo $stmt->rowCount() . " artist row(s) UPDATED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
<p/><a href="artist.php">artists</a>