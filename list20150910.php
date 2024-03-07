<?php include 'leftmenu.php'; ?>

<?php
function checkordcol($ordcolchk) {
	echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\"/>";
	echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" checked  />";
	echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\" />";
	$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");

	foreach ($arr as $value) {
		if ($ordcolchk==$value) { $checked="checked"; } else { $checked=""; }
	    echo $value . "<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"" . $value . "\" " . $checked . "/>";
	}
}
function fslct($ttl,$lbl,$conn,$sql,$id){
	echo " " . $ttl . " <select name=\" . $lbl . \">";
	if (empty($id)) { echo "<option value=\"\">all"; }
	foreach($conn->query($sql) as $row) {
		if ($row['id']==$id) {
    		echo "<option value=" . $row['id'] . " selected>" . $row['nm'];
		} else {
			echo "<option value=" . $row['id'] . ">" . $row['nm'];
		}
	}
	echo "</select>";
}

function selectordcol($ordcol) {
	$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");
	echo "<select name=\"ordcol\" onChange='this.form.submit();' >";
	foreach ($arr as $value) {
		if ($ordcol==$value) {
			echo "<option value=\"" . $value . "\" selected >" . $value;
		} else {
			echo "<option value=\"" . $value . "\">" . $value;
		}
	}
	echo "</select>";
}
?>
<form name="list.php" method="post">
<table width="100%">
	<tr>
		<td><h1>transactions</h1></td>
		<td width="40%" align="center">
			<table>
				<tr>
					<td><b>filter</b></td>
					<td>
						<?php
							include 'connect.php';
							fslct("account","ttyd",$conn,"select account_id id,account_name nm from account order by 2",$_GET['id']);
						?>
					</td><td>
						<?php
							fslct("tran type","accd",$conn,"select tran_type_id id,tran_type nm from tran_type order by 2",$_GET['id']);
						?>
					</td>
				</tr>
			</table>
		<td width="40%" align="right">
			<table>
				<tr>
					<td>order by</td>
					<td>
					<form action="list.php" method="post">
					<?php
					if (empty($_POST['ordcol'])) { $ordcol="tran_id"; } else { $ordcol=$_POST['ordcol']; }
					selectordcol($ordcol);
					?>
					</td>
					<td>asc/desc</td>
					<td>
					<?php
					if (empty($_POST['orddr'])) { $orddr="desc"; } else { $orddr=$_POST['orddr']; }
					if ($_POST['orddr']=="asc") {
						echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"asc\" checked />";
						echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"desc\" />";
					} else {
						echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"asc\" />";
						echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"desc\" checked />";
					}
					if (empty($_POST['limit'])) { $limit=22; } else { $limit=$_POST['limit']; }
					?>
					</td><td>limit</td><td width="40px"><input onChange='this.form.submit();' name="limit" value=" <?php echo $limit; ?> " />

		</td>
	</tr></table></td>
</tr></table>
</form>


<table>
<tr><th>date<th>creditor<th>desc<th>tran type<th>account<th>amount<th>receipt<th>dd<th>statement<th>cheque<th>freq<th>cost<td align="center"><a href="form.php">add</a></td></tr>
	<?php
	if (empty($_GET['whr'])) { $whr = " and 1=1 "; } else { $whr =  $_GET['whr']; }
	if (!empty($_GET['crdd'])) { echo $whr = " and crdd = " . $_GET['crdd']; }
	$sql="select tran_id tid,tran_date trd,
	case when length(c2.nm)!=0 then concat(c1.nm,', ',c2.nm) when length(c1.nm)!=0 then c1.nm else 'tran_creditor' end crd, /*last one should never happen */
		tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount*cr_dr amt, receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		date_created dtc, date_amended dta, freq_name frq, cost cst,crdd,brnd
		from transdet
		left join frequency on transdet.frequency = frequency.freq_id
		left join cost_center on transdet.cost_code = cost_center.cost_code
		left join crd c1 on crdd=c1.id
		left join crd c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id
		where " . $ordcol . " is not null " . $whr . " order by " . $ordcol . " " . $orddr .
		" limit " . $limit;
		echo "<p/>" . $sql;
	foreach($conn->query($sql) as $row) {
		if ($row['rcpt']==1) {$rcpt="checked";} else {$rcpt="";}
		if ($row['dd']==1) {$dd="checked";}else{$dd="";}
		echo "<tr>
			<!-- <td>" . $row['tid'] . "</td> -->
			<td>" . $row['trd'] . "</td><td>" . $row['crd'] . "</td><td>" . $row['dsc'] . "</td><td>" . $row['tty'] . "</td><td>" . $row['acc'] . "</td><td>" . $row['amt'] .
  			"</td><td><input type=\"checkbox\" " . $rcpt . "></input></td>
  			<td><input type=\"checkbox\" " . $dd . "></input></td><td>" . $row['std'] . "</td><td>" . $row['chq'] . "</td><td>" . $row['frq'] . "</td><td>" . $row['cst'] . "</td>
  			<!-- <td>" . $row['dtc'] . "</td><td>" . $row['dta']. "</td> -->
  			<td><a href=\"form.php?tid=" . $row['tid'] . "\">mod</a></td>
			<td><a href=\"post.php?addmod=del&tid=" . $row['tid'] . "\">del</a></td></tr>";

	}
?>
</table>
</form>
<?php include('dir.php'); ?>
</body>
</html>