<?php include '../trxnmenu.php'; ?>
<h1>tran type modify form</h1>
<?php
include 'connect.php';
$id = $_GET['id'];
//echo "<br/>id: " . $_GET["id"];
try {
        echo "<table>";
        $sql = "select * from tran_type where tran_type_id=" . $_GET["ttyd"];
//		echo $sql;
        foreach($conn->query($sql) as $row) {
                echo "<form method=\"post\"action=\"ttymodpt.php\">
			<input name=\"ttyd\" type=\"hidden\" value=\"" . $row['tran_type_id'] . "\"></input>
			<tr><td>prefix</td><td><input name=\"tty\" type=\"text\" value=\"" . $row['tran_type'] . "\"></input></td></tr>
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
