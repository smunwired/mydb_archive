<?php
include 'connect.php';
$isrt="insert into artist (prefix,firstname,lastname,joinstr,bandname,collaborators) values (
\"" . $_POST['prf'] . "\",\"" . $_POST['frs'] . "\", \"" . $_POST['lst'] . "\",\"" . $_POST['jns'] . "\"
	,\"" . $_POST['bnd'] . "\",\"" . $_POST['clb'] . "\")";
echo "<p/>" . $isrt;
try {
$stmt = $conn->prepare($isrt);
$stmt->execute();
echo $stmt->rowCount() . " artist row(s) INSERTED successfully.";
} catch (PDOException $e) {
	echo "<p/>" . $e;
}
?>
<p/><a href="artist.php">artists</a>