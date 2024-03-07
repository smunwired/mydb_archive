<?php include '../trxnmenu.php'; ?>
<h1><?php echo $_GET['tbl']; ?> add form</h1>

<?php
include 'connect.php';
?>
<form method="post" action="tctaddpt.php">
<table>
<input type="hidden" name="tbl" value="<?php echo $_GET['tbl']; ?>"></input>
<input type="hidden" name="col1" value="<?php echo $_GET['col1']; ?>"></input>
<input type="hidden" name="col2" value="<?php echo $_GET['col2']; ?>"></input>
<tr><td>id</td><td><input type="text" name="id"></input></td></tr>
<tr><td>desc</td><td><input type="text" name="dsc"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
<?php
//include '../sitemap.php';
?>

