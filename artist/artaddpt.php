<?php
include '../leftmenu.php';
?>
<h2>Artist Add Post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "insert into artist(prefix,firstname,lastname,joinstr,bandname,collaborators) values (\"" . $_POST["prefix"] . "\",\"" . $_POST["firstname"] . "\",\"" . $_POST["lastname"] . "\",\"" . $_POST["joinstr"] . "\",\"" . $_POST["bandname"] . "\",\"" . $_POST["collab"] . "\")";
	// Prepare statement

	$stmt = $conn->prepare($sql);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	$justcreated = $conn->lastInsertId();
	echo $stmt->rowCount() . " artists INSERTED successfully<br><a href=\"../title/ttladdfm.php?id=" . $justcreated . "\" >add title for artist</a>";
} catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


include '../sitemap.php';
?>
