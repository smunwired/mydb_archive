<h1>transdet delete post</h1>
<?php
  try {
    $conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (empty($conn)) {
	  throw new Exception("Connection failed!");
    }
	echo "<br/>connected";
	echo "<br/>trd " . $_POST['trd'] . ", std " . $_POST['std'] . ", chq " . $_POST['chq'];
	$trd = "'" . $_POST['trd'] . "'";
	$crn = "'" . $_POST['crn'] . "'";
	$dsc = "'" . $_POST['dsc'] . "'";
	$amt = $_POST['amt'];
	$crdr = $_POST['crdr'];
	$ttyd = $_POST['ttyd'];
	$accd = $_POST['accd'];
	if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
	if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}

	if ($_POST['rcpt']=="on") { $rcpt=1; } else { $rcpt=0; }

	if ($_POST['dd']=="on") { $dd=1; } else { $dd=0; }


	if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
	if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
	if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
	if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
	if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
//	/*
//	$isrt="insert into transdet(tran_date,tran_creditor,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
//	receipt_ind,dd_ind,date_created,user_created,frequency,cred_id,branch_id,cost_code)
//	values(" . $trd . "," . $crn . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
//	$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . ")";
//	*/
	$dlt="delete from transdet where tran_id=" . $_GET['tid'];

	echo "<br/>dlt " . $dlt;


	// Prepare statement
	$stmt = $conn->prepare($dlt);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) DELETED successfully<br/><a href=\"trnlst.php\">list</a>";
	} catch(PDOException $e) {
	  //  echo "Connection failed: " . $e->getMessage();
	  echo "<br/> PDO failure <br/>" . $e->getMessage();
	}
?>
