<h1><?php echo $_GET['tbl']; ?> modify post</h1>
<?php
include '../trxnmenu.php';
include 'connect.php';
echo "<br/>str : " . $_POST['str'];
try {
	$sql = "update " . $_POST['tbl'] . " set " . $_POST['str'] . "=\"" . $_POST["dsc"] . "\" where " . $_POST['ky'] . " = " . $_POST['vl'];
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully<br/><a href=\"maint.php\">tran types</a>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

include '../sitemap.php';
?>
