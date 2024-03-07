<h1>transdet add post</h1>
<!-- validation -->
<?php
function validateInput($input,$val) {
    if (empty($val)) {
      throw new Exception($input . " must have a value.");
    }
}
echo "addmod : " . $_POST['addmod'];
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

	if ($_POST['rcpt']=="on") { $rcpt=1; } else { $rcpt=0; }

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
  ?>
