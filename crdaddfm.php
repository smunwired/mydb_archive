<h1>creditor add form</h1>
<?php
function fslct($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"trnaddfm.php\"; this.form.submit()'><option value=\"0\">";
  foreach($conn->query($sql . $whr . $ord) as $row) {
    if ($matchto==$row[$id]) {
  	echo "<option value=\"". $row[$id] . "\" selected>" . $row[$desc];
    } else {
  	echo "<option value=\"". $row[$id] . "\">" . $row[$desc];
    }
  }
  echo " </select>";
}
function fchkbx($name,$value) {
  if ($value=="on") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } else {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" />";
  }
}
$conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<form action="trnaddpt.php" method="post">
<table>
<tr>
<td>creditor</td><td><input name="trd" value="<?php echo $_POST['trd']; ?>"></input></td></tr>
<td>tran creditor</td><td><input name="crn" value="<?php echo $_POST['crn']; ?>"></input></td></tr>
<td>desc</td><td><input name="dsc" value="<?php echo $_POST['dsc']; ?>"></input></td></tr>
<tr><td>creditor</td><td>
<?php
echo fslct($conn,"select creditor_id crdd,creditor crd  from creditor"," where 1=1"," order by creditor",$_POST['crdd'],'crdd','crd','func.php');
?>
</td><td>branch</td><td>
<?php
if ($_POST['crdd']==null) {
  $brnwhr = " where creditor_id=0";
} else {
  $brnwhr = " where creditor_id=" . $_POST['crdd'];
}
echo fslct($conn,"select branch_id brnd,branch_name brn from branch",$brnwhr," order by branch_name",$_POST['brnd'],'brnd','brn','func.php');
?>
</td></tr><tr><td>tran type</td><td>
<?php
echo fslct($conn,"select tran_type_id ttyd,tran_type tty from tran_type"," where 1=1"," order by tran_type_id",$_POST['ttyd'],'ttyd','tty','func.php');
?>
</td></tr><tr><td>account</td><td>
<?php
echo fslct($conn,"select account_id accd,account_name acc from account"," where 1=1"," order by account_id",$_POST['accd'],'accd','acc','func.php');
?>
</td></tr><tr><td>frequency</td><td>
<?php
echo fslct($conn,"select freq_id frqd,freq_name frq from frequency"," where 1=1"," order by freq_id",$_POST['frqd'],'frqd','frq','func.php');
?>
</td></tr><tr><td>cost</td><td>
<?php
echo fslct($conn,"select cost_code cstd,cost cst from cost_center"," where 1=1"," order by cost_code",$_POST['cstd'],'cstd','cst','func.php');
?>
</td></tr>
<tr><td>receipt</td><td><?php echo fchkbx("rcpt",$_POST['rcpt']); ?></td></tr>
<tr><td>dd</td><td><?php echo fchkbx("dd",$_POST['dd']); ?></td></tr>
<td>amount</td><td><input name="amt"  value="<?php echo $_POST['amt']; ?>"/></td><td>cr/dr</td><td><input name="crdr" type="radio" value="0"/><input name="crdr" type="radio" value="1" checked /></td></tr>
<tr><td>cheque no</td><td><input name="chq"  value="<?php echo $_POST['chq']; ?>"/></td></tr>
<tr><td>statement date</td><td><input name="std"  value="<?php echo $_POST['std']; ?>"/></td></tr>
<tr><td><input type="submit" /></td></tr>
</table>
</form>