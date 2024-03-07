<?php include 'connect.php';
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