
<?php include 'topmenu.php'; ?>
<h1>bikehist add post</h1>
<?php
include 'connect.php';
try {
	if (empty($conn)) {
	  throw new Exception("Connection failed!");
    }
	//echo "<br/>connected";

	if (empty($_POST['nts'])) { $nts = null; } else { $nts = "'" . $_POST['nts'] . "'"; }

	$isrt = "insert into bikehist (rdt,dst,mx,tm,av,nts) values ('" . $_POST['rdt'] . "'," . $_POST['dst'] . "," . $_POST['mx'] . ",'" . $_POST['tm'] . "'," . $_POST['av'] . "," . $nts . ")" ;
	echo $isrt;

    try {
	// Prepare statement
	$stmt = $conn->prepare($isrt);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED successfully<br/><a href=\"bikehist.php\">list</a>";
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