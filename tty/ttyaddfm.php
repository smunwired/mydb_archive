<?php include '../trxnmenu.php'; ?>
<h1>tran type add form</h1>

<?php
include 'connect.php';
?>
<form method="post" action="ttyaddpt.php">
<table>
<tr><td>id</td><td><input type="text" name="ttyd"></input></td></tr>
<tr><td>desc</td><td><input type="text" name="tty"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
<?php
//include '../sitemap.php';
?>

