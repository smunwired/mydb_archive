<?php
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
<?php
/*
$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");
//reset($arr);
//while (list(, $value) = each($arr)) {
//    echo "Value: $value<br />\n";
//}

foreach ($arr as $value) {
    echo $value . "<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"" . $value . "\"/>";
}
*/
?>
<html>
<head>
<style>
<link rel="stylesheet" type="text/css" href="/mydb/style/scroll.css">
</style>
</head>
<body>
<form name="trnlst.php" method="post">
<table width="100%">
<tr><td><h1>transactions</h1></td><td width="40%" align="right">
	<table><tr><td>order by</td><td bgcolor="lightgray">
<form action="trnlst.php" method="post">
<?php

function checkordcol($ordcolchk) {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\"/>";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" checked  />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\" />";
$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");
//reset($arr);
//while (list(, $value) = each($arr)) {
//    echo "Value: $value<br />\n";
//}

foreach ($arr as $value) {
	if ($ordcolchk==$value) { $checked="checked"; } else { $checked=""; }
    echo $value . "<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"" . $value . "\" " . $checked . "/>";
}
}

if (empty($_POST['ordcol'])) { $ordcol="tran_id"; } else { $ordcol=$_POST['ordcol']; }
selectordcol($ordcol);
/*
if ($ordcol=="tran_date") {
	checkordcol("tran_date");
//   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\"/>";
//   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" checked  />";
//   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\" />";
} elseif ($ordcol=="statement_date") {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\"/>";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\" checked  />";
} else {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\" checked  />";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\"/>";
}
*/
?><!-- <td><select name="ordcol"><option value="tran_id">tran_id</select></td>	-->
		<td>asc/desc</td><td bgcolor="lightgray">
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
echo "</td><td>limit</td><td width=\"40px\"><input onChange='this.form.submit();' name=\"limit\" value=\"" . $limit . "\" />";
?>
		</td>
	</tr></table></td>
</tr></table>
</form>


<table>
<tr><th>date<th>creditor<th>desc<th>tran type<th>account<th>amount<th>receipt<th>dd<th>statement<th>cheque<th>freq<th>cost<td align="center"><a href="trnaddfm.php">add</a></td></tr>
<?php
$servername = "192.168.56.104";
$username = "trxnuser";
$password = "trxnpass";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=trxndb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

	//$limit=100;
	//$ordcol="tran_id";
	//$ord="desc";
	if (empty($_GET['whr'])) { $whr = " and 1=1 "; } else { $whr =  $_GET['whr']; }
	$sql="select tran_id tid,tran_date trd,concat(coalesce(creditor.creditor,tran_creditor),case when length(branch_name)!=0 then ', ' end,branch_name) crd,
		tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount*cr_dr amt, receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		date_created dtc, date_amended dta, freq_name frq, cost cst
		from transdet
		left join frequency on transdet.frequency = frequency.freq_id
		left join cost_center on transdet.cost_code = cost_center.cost_code
		left join creditor on transdet.cred_id=creditor.creditor_id
		left join branch on transdet.branch_id=branch.branch_id
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
  			<td><a href=\"trnmodfm.php?tid=" . $row['tid'] . "\">mod</a></td>
  			<td><a href=\"trndelpt.php?tid=" . $row['tid'] . "\">del</a></td>
			<td><a href=\"trnmodpt.php?addmod=del&tid=" . $row['tid'] . "\">del</a></td></tr>";

	}
	echo "</table>";

} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>
</form>
</body>
</html>