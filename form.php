<?php include 'leftmenu.php'; ?>
<?php
function fslctnew($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
  if (empty($_POST[$id])) { $matchto = $row[$id]; } else { $matchto = $_POST[$id]; }
  echo "matchto : " . $matchto;
  echo "<br/>" . $sql . $whr . $ord;
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"form.php\"; this.form.submit()'><option value=\"0\">";
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
//echo $sql . $whr . $ord . " id: " . $id . " desc: " . $desc;
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"form.php\"; this.form.submit()'><option value=\"0\">";
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
include 'connect.php';
$tid = $_GET['tid']; if (empty($tid)) { $tid=$_POST['tid']; }
echo "<br/>tid is " . $tid;


if (empty($tid)) { echo "tid is empty"; echo "add one";

?>

	<h1>transdet add form</h1>

	<form action="post.php" method="post">
<input name="addmod" value="add" type="hidden">
<table>
<tr>
<td>tran date</td><td><input name="trd" value="<?php echo $_POST['trd']; ?>"></input></td></tr>
<td>new creditor</td><td><input name="crn" value="<?php echo $_POST['crn']; ?>"></input></td>
<td>new branch</td><td><input name="brn" value="<?php echo $_POST['brn']; ?>"></input></td></tr>
<td>desc</td><td><input name="dsc" value="<?php echo $_POST['dsc']; ?>"></input></td></tr>
<tr><td>creditor</td><td>
<?php
//echo fslct($conn,"select creditor_id crdd,creditor crd  from creditor"," where 1=1"," order by creditor",$_POST['crdd'],'crdd','crd','func.php');
//echo fslct($conn,"select id crdd,nm crd  from transdet join crd on crdd=id "," where 1=1"," group by crdd,crd order by crd",$_POST['crdd'],'crdd','crd','func.php');
//change to exclude branches rather than collect creditors otherwise it fails to see new, unassigned creditors
echo fslct($conn,"select id crdd,nm crd  from crd "," where id not in (select id from transdet join crd on id=brnd) "," group by crdd,crd order by crd",$_POST['crdd'],'crdd','crd','func.php');
?>
</td><td>branch</td><td>
<?php

if ($_POST['crdd']==null) {
//  $brnwhr = " where creditor_id=0";
  $brnwhr = " where c2.id=0";
} else {
  $brnwhr = " where c2.id=" . $_POST['crdd'];
}
	$crdd = $_POST['crdd'];
echo fslct($conn,"select c1.id brnd,c1.nm brn  from transdet join crd c1 on brnd=c1.id join crd c2 on c2.id=crdd",$brnwhr," group by brnd,brn order by brn",$_POST['brnd'],'brnd','brn','func.php');
?>
</td></tr><tr><td>XXXtran typeXXX</td><td>
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
<td>amount</td><td><input name="amt"  value="<?php echo $_POST['amt']; ?>"/></td>
<td>cr/dr</td><td><input name="crdr" type="radio" value="1"/><input name="crdr" type="radio" value="-1" checked /></td></tr>
<tr><td>cheque no</td><td><input name="chq"  value="<?php echo $_POST['chq']; ?>"/></td></tr>
<tr><td>statement date</td><td><input name="std"  value="<?php echo $_POST['std']; ?>"/></td></tr>
<tr><td><input type="submit" /></td></tr>
</table>
	</form>


<?php

} else {
			//	MODIFY
			//	MODIFY
			//	MODIFY
	$sql="select tran_id tid,tran_date trd,
	    c1.nm crd,c1.id crdd,tran_creditor crn,c2.id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		user_created utc, user_amended uta,date_created dtc, date_amended dta
		from transdet
		left join crd c1 on crdd=c1.id
		left join crd c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
	foreach($conn->query($sql) as $row) {
		if (empty($crdd)){$crdd=0;}
		?>
			<h1>transdet modify form</h1>
			<form action="post.php" method="post">
			<input name="tid" value="<?php echo $tid; ?>"  type="hidden" />
			<table>
				<tr>
					<td>tran date</td>
					<td><input name="trd" value="<?php echo $row['trd']; ?>"></input></td>
				</tr>
					<td>desc</td>
					<td><input name="dsc" value="<?php echo $row['dsc']; ?>"></input></td>
				</tr>
				<tr>
					<td>creditor</td>
					<td>
						<?php
							if (empty($_POST['crdd'])) { $crdd = $row['crdd']; } else { $crdd = $_POST['crdd']; }
							echo fslct($conn,"select id crdd ,nm crd  from transdet join crd on crdd=id "," where 1=1"," group by crdd,id order by crd",$crdd,'crdd','crd','func.php');
						?>
					</td>
					<td>branch</td>
					<td>
						<?php
							if ($crdd==null) {
							  $brnwhr = " where c2.id=0";
							} else {
							  $brnwhr = " where c2.id=" . $crdd;
							}
							if (empty($_POST['brnd'])) { $brnd = $row['brnd']; } else { $brnd = $_POST['brnd']; }
							echo fslct($conn,"select c1.id brnd,c1.nm brn  from transdet join crd c1 on brnd=c1.id join crd c2 on c2.id=crdd",$brnwhr," group by brnd,brn order by brn",$brnd,'brnd','brn','func.php');
						?>
			<tr>
				<td>new creditor</td><td><input name="crn" value="<?php echo $_POST['crn']; ?>"></input></td>
				<td>new branch</td><td><input name="brn" value="<?php echo $_POST['brn']; ?>"></input></td>
			</tr>
			</tr>

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
			<tr>
				<td>user created</td><td bgcolor="lightgray"><?php echo $row['utc']; ?></td>
				<td>user amended</td><td bgcolor="lightgray"><?php echo $row['uta']; ?></td>
			</tr>
			<tr>
				<td>date created</td><td bgcolor="lightgray"><?php echo $row['dtc']; ?></td>
				<td>date amended</td><td bgcolor="lightgray"><?php echo $row['dta']; ?></td>
			</tr>
			<!-- <tr><td><input type="submit" /></td></tr>	-->
			<tr><td><input type="submit" name="addmod" value="mod"/></td><td><input type="submit" name="addmod" value="add" /></td></tr>
		</table>
		</form>


<?php
	}
}
?>
