<?php
$conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
function test($passedin) {
  return "100";
}
?>
<form action="post.php" method="post">
<table>
<tr><td>tran date</td><td><input name="trd"></input></td></tr>
<tr><td>creditor</td><td><select name="crdd" onchange='this.form.action="page.php"; this.form.submit()'><option value="0">
<?php echo test(1); ?>
<?php
$sql = "select creditor_id crdd,creditor crd  from creditor order by creditor";
foreach($conn->query($sql) as $row) {
  if ($_POST['crdd']==$row['crdd']) {
	echo "<option value=\"". $row['crdd'] . "\" selected>" . $row['crd'];
  } else {
	echo "<option value=\"". $row['crdd'] . "\">" . $row['crd'];
  }
}
?>
</select></td></tr>
<br/>
<select name="brnd" onchange='this.form.action="page.php"; this.form.submit()'><option value="0">
<?php
$sql = "select branch_id brnd,branch_name brn from branch where creditor_id=" . $_POST['crdd'] . " order by branch_name";
foreach($conn->query($sql) as $row) {
  if ($_POST['brnd']==$row['brnd']) {
	echo "<option value=\"". $row['brnd'] . "\" selected>" . $row['brn'];
  } else {
	echo "<option value=\"". $row['brnd'] . "\">" . $row['brn'];
  }
}
?>
</select>
<br/>
<select name="ttyd" onchange='this.form.action="page.php"; this.form.submit()'><option value="0">
<?php
$sql = "select tran_type_id ttyd,tran_type tty from tran_type order by tran_type_id";
foreach($conn->query($sql) as $row) {
  if ($_POST['ttyd']==$row['ttyd']) {
	echo "<option value=\"". $row['ttyd'] . "\" selected>" . $row['tty'];
  } else {
	echo "<option value=\"". $row['ttyd'] . "\">" . $row['tty'];
  }
}
?>
</select>
<br/>
<select name="accd" onchange='this.form.action="page.php"; this.form.submit()'><option value="0">
<?php
$sql = "select account_id accd,account_name acc from account order by account_id";
foreach($conn->query($sql) as $row) {
  if ($_POST['accd']==$row['accd']) {
	echo "<option value=\"". $row['accd'] . "\" selected>" . $row['acc'];
  } else {
	echo "<option value=\"". $row['accd'] . "\">" . $row['acc'];
  }
}
?>
</select>
<br/>
<select name="frqd" onchange='this.form.action="page.php"; this.form.submit()'><option value="0">
<?php
$sql = "select freq_id frqd,freq_name frq from frequency order by freq_id";
foreach($conn->query($sql) as $row) {
  if ($_POST['frqd']==$row['frqd']) {
	echo "<option value=\"". $row['frqd'] . "\" selected>" . $row['frq'];
  } else {
	echo "<option value=\"". $row['frqd'] . "\">" . $row['frq'];
  }
}
?>
</select>
<br/>
<input type="submit"></input>
</form>