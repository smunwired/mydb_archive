<h1>transdet modify post</h1>
<?php
function validateInput($input,$val) {
    if (empty($val)) {
      throw new Exception($input . " must have a value.");
    }
}
echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
echo "<br/>dd : " . $_POST['dd'];
echo "<br/>rcpt : " . $_POST['rcpt'];

if ($_GET['addmod']=="del") {
	echo "<br/>delete selected";
?>
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




} else if ($_POST['addmod']=='like') {
	//echo "addmod, do nothing!!!";
	?>
	<h1>transdet add post</h1>
	<!-- validation -->
	<?php
	try {
	  validateInput('Amount',$_POST['amt']);
	  validateInput('Tran Type',$_POST['ttyd']);
	  validateInput('Account',$_POST['accd']);
	  try {
	    $conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (empty($conn)) {
		  throw new Exception("Connection failed!");
	    }
		//echo "<br/>connected";
		echo "trd " . $_POST['trd'] . ", std " . $_POST['std'] . ", chq " . $_POST['chq'];
		$trd = "'" . $_POST['trd'] . "'";
		$crn = "'" . $_POST['crn'] . "'";
		$dsc = "'" . $_POST['dsc'] . "'";
		$amt = $_POST['amt'];
		$crdr = $_POST['crdr'];echo "crdr : " . $crdr;
		$ttyd = $_POST['ttyd'];
		$accd = $_POST['accd'];

		if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
		if (empty($_POST['std'])) { $std="null"; } else { $std= "'" . $_POST['std'] . "'"; }

		if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}

		if (($_POST['rcpt']=="on")||($_POST['rcpt']=="1")) { $rcpt=1; } else { $rcpt=0; }

		if (($_POST['dd']=="on")||($_POST['dd']=="1")) { $dd=1; } else { $dd=0; }


		if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
		if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
		if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
		if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
		if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
		$isrt="insert into transdet(tran_date,tran_creditor,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
		receipt_ind,dd_ind,date_created,user_created,frequency,cred_id,branch_id,cost_code)
		values(" . $trd . "," . $crn . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
		$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . ")";

		echo "isrt " . $isrt;


		// Prepare statement
		$stmt = $conn->prepare($isrt);

		// execute the query
		$stmt->execute();

		// echo a message to say the INSERT succeeded
		echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED successfully<br/><a href=\"trnlst.php\">list</a>";
		} catch(PDOException $e) {
		  //  echo "Connection failed: " . $e->getMessage();
		  echo "<br/> PDO failure <br/>" . $e->getMessage();
		}
	  }
	  catch (Exception $e) {
	    // Here you can either echo the exception message like:
	        echo $e->getMessage();
	    /* Or you can throw the Exception Object $e like:
	        throw $e;
	    */
	  }

} else {
try {
  validateInput('Amount',$_POST['amt']);
  validateInput('Tran Type',$_POST['ttyd']);
  validateInput('Account',$_POST['accd']);
  try {
    $conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (empty($conn)) {
	  throw new Exception("Connection failed!");
    }
/*		date fields		*/
	if (empty($_POST['trd'])) { $trd="null"; } else { $trd = "'" . $_POST['trd'] . "'"; }
	if (empty($_POST['std'])) { $std="null"; } else { $std = "'" . $_POST['std'] . "'"; }
	$crn = "'" . $_POST['crn'] . "'";
	$dsc = "'" . $_POST['dsc'] . "'";
	$amt = $_POST['amt'];
	echo "crdr : " . $_POST['crdr'];
	$crdr = $_POST['crdr'];
	$ttyd = $_POST['ttyd'];
	$accd = $_POST['accd'];
//	if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
	if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
/*		checkboxes		*/
echo "<br/>rcpt " . $_POST['rcpt'] . " & dd " . $_POST['dd'];
    if (empty($_POST['rcpt'])) { $rcpt = 0; } else { $rcpt = 1; }
    if (empty($_POST['dd'])) { $dd = 0; } else { $dd = 1; }

	if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
	if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
	if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
	if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
	if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }

	$updt="update transdet set tran_date=" . $trd .
	",tran_creditor=" . $crn .
	",tran_desc=" . $dsc .
	",tran_amount=" . $amt .
	",cr_dr=" . $crdr .
	",tran_type_id=" . $ttyd .
	",account_id=" . $accd .
	",statement_date=" . $std .
	",cheque_no=" . $chq .
	",receipt_ind=" . $rcpt .
	",dd_ind=" . $dd .
	",date_amended=current_timestamp,user_amended='phpuser'
	,frequency=" . $frqd .
	",cred_id=" . $crdd .
	",branch_id=" . $brnd .
	",cost_code=" . $cstd . " where tran_id=" . $_POST['tid'];

//echo "<p>" . $updt;

	// Prepare statement
	$stmt = $conn->prepare($updt);

	// execute the query
	$stmt->execute();

	// echo a message to say the UPDATE succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) UPDATED successfully";
	echo "<br/><a href=\"trnlst.php\">list</a>";
	} catch(PDOException $e) {
	  //  echo "Connection failed: " . $e->getMessage();
	  echo "<br/> PDO failure <br/>" . $e->getMessage();
	}
} catch (Exception $e) {
    // Here you can either echo the exception message like:
	echo $e->getMessage();
    /* Or you can throw the Exception Object $e like:
        throw $e;
    */
}
}
?>
