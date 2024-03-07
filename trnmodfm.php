<h1>transdet modify form</h1>

<?php
function fslctnew($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
  if (empty($_POST[$id])) { $matchto = $row[$id]; } else { $matchto = $_POST[$id]; }
  echo "matchto : " . $matchto;
  echo "<br/>" . $sql . $whr . $ord;
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"trnmodfm.php\"; this.form.submit()'><option value=\"0\">";
  foreach($conn->query($sql . $whr . $ord) as $row) {
    if ($matchto==$row[$id]) {
  	echo "<option value=\"". $row[$id] . "\" selected>" . $row[$desc];
    } else {
  	echo "<option value=\"". $row[$id] . "\">" . $row[$desc];
    }
  }
  echo " </select>";
}
function fslct($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"trnmodfm.php\"; this.form.submit()'><option value=\"0\">";
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
  echo $name . $value;
  if ($value=="on") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } elseif ($value=="1") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } else {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" />";
  }
}
//$conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*		there must be a better way of doing this		*/
if (empty($_GET['tid'])) { $tid = $_POST['tid']; } else { $tid = $_GET['tid']; }

$servername = "192.168.56.104";
$username = "trxnuser";
$password = "trxnpass";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=trxndb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
	$sql="select tran_id tid,tran_date trd,
	/*concat(coalesce(creditor.creditor,tran_creditor),case when length(branch_name)!=0 then ', ' end,branch_name) crd,*/
	    creditor.creditor crd,creditor.creditor_id crdd,tran_creditor crn,transdet.branch_id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		date_created dtc, date_amended dta
		from transdet
		left join creditor on transdet.cred_id=creditor.creditor_id
		left join branch on transdet.branch_id=branch.branch_id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
echo "<p>" . $sql . "<br/>";
	foreach($conn->query($sql) as $row) {
		echo $row['tid'] . " rcpt: " . $row['rcpt'] . " dd : " . $row['dd'] . " crdr : " . $row['crdr'] ;
		/*
		if ($row['rcpt'] ==1) $rcpt="checked";
		if ($row['dd'] ==1) $dd="checked";
		echo "anything";
		echo "<tr><td>" . $row['tid'] . "</td><td>" . $row['tdt'] . "</td><td>" . $row['crd'] . "</td><td>" . $row['dsc'] . "</td><td>" . $row['tty'] . "</td><td>" . $row['acc'] . "</td><td>" . $row['amt'] .
  			"</td><td><input type=\"checkbox\" " . $rcpt . "></input></td><td><input type=\"checkbox\" " . $dd . "></input></td><td>" . $row['std'] . "</td>
  			<td>" . $row['dtc'] . "</td><td>" . $row['dta']. "</td>
  			<td><a href=\"trnmodfm.php?tid=" . $row['tid'] . "\">mod</a></td><td><a href=\"trndelpt.php?tid=" . $row['tid'] . "\">del</a></td></tr>";
*/
//echo "<br/>get crdd : " .  $_GET['crdd'];
//echo "<br/>post crdd : " .  $_POST['crdd'];
//echo "<br/>row : " .  $row['crdd'];


	?>
		<form action="trnmodpt.php" method="post">
		<table>
			<tr>
			<input name="tid" value="<?php echo $row['tid']; ?>"  type="hidden" />
			<td>tran date</td><td><input name="trd" value="<?php echo $row['trd']; ?>"></input></td></tr>
			<td>tran creditor</td><td><input name="crn" value="<?php echo $row['crn']; ?>"></input></td></tr>
			<td>desc</td><td><input name="dsc" value="<?php echo $row['dsc']; ?>"></input></td></tr>
			<tr><td>creditor</td><td>
			<?php

				if (empty($_POST['crdd'])) { $crdd = $row['crdd']; } else { $crdd = $_POST['crdd']; }
				echo fslct($conn,"select creditor_id crdd,creditor crd  from creditor"," where 1=1"," order by creditor",$crdd,'crdd','crd','func.php');
				/* replacing these *with this
				echo fslct($conn,"select creditor_id crdd,creditor crd  from creditor"," where 1=1"," order by creditor",'crdd','crd','func.php');
				*/
			?>
			</td><td>branch</td><td>
			<?php
//				if ($row['crdd']==null) {
				if (empty($crdd)) {
				  $brnwhr = " where creditor_id=0";
				} else {
//				  $brnwhr = " where creditor_id=" . $row['crdd'];
				  $brnwhr = " where creditor_id=" . $crdd;
				}
				if (empty($_POST['brnd'])) { $brnd = $row['brnd']; } else { $brnd = $_POST['brnd']; }
				echo fslct($conn,"select branch_id brnd,branch_name brn from branch",$brnwhr," order by branch_name",$brnd,'brnd','brn','func.php');
			?>
			</td></tr><tr><td>tran type</td><td>
			<?php
				if (empty($_POST['ttyd'])) { $ttyd = $row['ttyd']; } else { $ttyd = $_POST['ttyd']; }
				echo fslct($conn,"select tran_type_id ttyd,tran_type tty from tran_type"," where 1=1"," order by tran_type_id",$ttyd,'ttyd','tty','func.php');
			?>
			</td></tr><tr><td>account</td><td>
			<?php
				if (empty($_POST['accd'])) { $accd = $row['accd']; } else { $accd = $_POST['accd']; }
				echo fslct($conn,"select account_id accd,account_name acc from account"," where 1=1"," order by account_id",$accd,'accd','acc','func.php');
			?>
			</td></tr><tr><td>frequency</td><td>
			<?php
				if (empty($_POST['frqd'])) { $frqd = $row['frqd']; } else { $frqd = $_POST['frqd']; }
				echo fslct($conn,"select freq_id frqd,freq_name frq from frequency"," where 1=1"," order by freq_id",$frqd,'frqd','frq','func.php');
			?>
			</td></tr><tr><td>cost</td><td>
			<?php
				if (empty($_POST['cstd'])) { $cstd = $row['cstd']; } else { $cstd = $_POST['cstd']; }
				echo fslct($conn,"select cost_code cstd,cost cst from cost_center"," where 1=1"," order by cost_code",$cstd,'cstd','cst','func.php');
			?>
			</td></tr><?php echo "rcpt " . $row['rcpt'] . " dd " . $row['dd']; ?>
			<tr><td>receipt</td><td>
				<?php if (empty($_POST['rcpt'])) {$rcpt=$row['rcpt'];}else{$rcpt=$_POST['rcpt'];}
				if ($rcpt==1) {$checked="checked";}else{$checked="";} ?>
				<input type="checkbox" name="rcpt" value="1" <?php echo $checked; ?> />
			</td></tr>
			<tr><td>dd</td><td>
				<?php if (empty($_POST['dd'])) {$dd=$row['dd'];}else{$dd=$_POST['dd'];}
				if ($dd==1) {$checked="checked";}else{$checked="";} ?>
				<input type="checkbox" name="dd" value="1" <?php echo $checked; ?> />
			</td></tr>
			<td>amount</td><td><input name="amt"  value="<?php echo $row['amt']; ?>"/></td>
			<?php if ($row['crdr']==-1) { ?>
				<td>cr/dr</td><td><input name="crdr" type="radio" value="1" /><input name="crdr" type="radio" value="-1" checked /></td>
			<?php } else { ?>
				<td>cr/dr</td><td><input name="crdr" type="radio" value="1" checked /><input name="crdr" type="radio" value="-1" /></td>
			<?php } ?>
			</tr>
			<tr><td>cheque no</td><td><input name="chq"  value="<?php echo $row['chq']; ?>"/></td></tr>
			<tr><td>statement date</td><td><input name="std"  value="<?php echo $row['std']; ?>"/></td></tr>
			<tr><td>date created</td><td bgcolor="lightgray"><?php echo $row['dtc']; ?></td>
			<td>date amended</td><td bgcolor="lightgray"><?php echo $row['dta']; ?></td></tr>
			<!-- <tr><td><input type="submit" /></td></tr>	-->
			<tr><td><input type="submit" name="addmod" value="mod"/></td><td><input type="submit" name="addmod" value="like" /></td></tr>
		</table>
		</form>


<?php
    }
} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>



