<?php include '../trxnmenu.php'; ?>
<h1><?php echo $_GET['tbl']; ?> modify form</h1>
<?php
include 'connect.php';
$id = $_GET['id'];
//echo "<br/>id: " . $_GET["id"];
try {
        echo "<table>";
        $sql = "select " . $_GET['ky'] . " id," . $_GET['str'] . " dsc from " . $_GET['tbl'] . " where " . $_GET['ky'] . "=" . $_GET["vl"];
		echo $sql;
        foreach($conn->query($sql) as $row) {
                echo "<form method=\"post\"action=\"tctmodpt.php\">
			<input name=\"id\" type=\"hidden\" value=\"" . $row['id'] . "\"></input>
			<input name=\"ky\" type=\"hidden\" value=\"" . $_GET['ky'] . "\"></input>
			<input name=\"vl\" type=\"hidden\" value=\"" . $_GET['vl'] . "\"></input>
			<input name=\"tbl\" type=\"hidden\" value=\"" . $_GET['tbl'] . "\"></input>
			<input name=\"str\" type=\"hidden\" value=\"" . $_GET['str'] . "\"></input>
			<tr><td>desc</td><td><input name=\"dsc\" type=\"text\" value=\"" . $row['dsc'] . "\"></input></td></tr>
			<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
		</form>";
//        echo $row['id'];
	}
        echo "</table>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
include 'sitemap.php';
?>
