<?php include 'leftmenu.php'; ?>

<h1>tran type</h1>

<?php
include 'connect.php';
$ordcol = 1;

$action=$_GET['action'];
if ($action=='lst') {


	echo "<table style=\"margin:auto;border:solid; width:50%\"><tr><th>id<th align=\"center\">tran type</td><td colspan=\"3\" align=\"center\"><a href=\"ttyaddfm.php\">add</a></td></tr>";
	$sql = "select tran_type_id ttyd, tran_type tty
		from tran_type
		order by " . $ordcol;
		//echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr><td>" . $row['ttyd'] .
		"</td><td>" . $row['tty'] .
		"</td>
		<td><a href=\"ttymodfm.php?id=" . $row['ttyd'] . "\">mod</a></td>
		<td><a href=\"ttydelpt.php?id=" . $row['ttyd'] . "\">del</a></td>";
	}
	echo "</table>";
} else {
?>
<h1>tran type modify form</h1>
<?php
$id = $_GET['id'];
//echo "<br/>id: " . $_GET["id"];
try {
        echo "<table>";
        $sql = "select * from tran_type where tran_type_id=" . $_GET["ttyd"];
//		echo $sql;
        foreach($conn->query($sql) as $row) {
                echo "<form method=\"post\"action=\"ttymodpt.php\">
			<input name=\"ttyd\" type=\"hidden\" value=\"" . $row['tran_type_id'] . "\"></input>
			<tr><td>prefix</td><td><input name=\"tty\" type=\"text\" value=\"" . $row['tran_type'] . "\"></input></td></tr>
			<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>
		</form>";
//        echo $row['id'];
	}
        echo "</table>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
function fslct($ttl,$lbl,$conn,$sql,$id){
		echo"<table><tr>
	        <td>" . $ttl . "</td>";
		        echo "<td><select name=\" . $lbl . \">";
		        if (empty($id)) { echo "<option value=\"\">all"; }
		        foreach($conn->query($sql) as $row) {
		          if ($row['id']==$id) {
		          echo "<option value=" . $row['id'] . " selected>" . $row['nm'];
		        } else {
		          echo "<option value=" . $row['id'] . ">" . $row['nm'];
		          }
		        }
			    echo "</select></td></tr></table>";
}

fslct("account","ttyd",$conn,"select account_id id,account_name nm from account order by 2",$_GET['id']);
fslct("tran type","accd",$conn,"select tran_type_id id,tran_type nm from tran_type order by 2",$_GET['id']);
?>
<?php include '../trxnmenu.php'; ?>
<h1>tran type add form</h1>

<?php
include 'connect.php';
?>
<form method="post" action="ttyaddpt.php">
<table>
<tr><td>id</td><td><input type="text" name="ttyd"></input></td></tr>
<tr><td>desc</td><td><input type="text" name="tty"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
<?php
?>

<?php
?>
<h2>Artist Add Post</h2>
<?php

try {

	$sql = "insert into tran_type(tran_type_id,tran_type) values (" . $_POST["ttyd"] . ",\"" . $_POST["tty"] . "\")";
	// Prepare statement

	$stmt = $conn->prepare($sql);

	// execute the query
	$stmt->execute();

	// echo a message to say the INSERT succeeded
	echo $stmt->rowCount() . " records INSERTED successfully";
	echo "<br/><a href=\"ttylst.php\">list tran types</a>";
} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


include '../sitemap.php';
?>
<?php
include '../trxnmenu.php';
try { $sql = "delete from tran_type where tran_type_id =" . $_GET["ttyd"] ;
//echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the DELETE succeeded
    echo $stmt->rowCount() . " records DELETED successfully<br/><a href=\"ttylst.php\">tran types</a>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

}
include '../sitemap.php';
?>

