<?php
include 'connect.php';
$stmt = $conn->prepare("select * from artist where id=" . $_GET['id']);
$stmt->execute();
$row = $stmt->fetch();
?>
<html>
<body>
<h1>artist modify form</h1>
<table>
<form method="post" action="artstmdp.php">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<tr><td>prefix</td><td><input name="prf" type="text" value="<?php echo $row[prefix]?>"/></td></tr>
<tr><td>firstname</td><td><input name="frs" type="text" value="<?php echo $row['firstname']?>"/></td></tr>
<tr><td>lastname</td><td><input name="lst" type="text" value="<?php echo $row[lastname]?>"/></td></tr>
<tr><td>joinstr</td><td><input name="jns" type="text" value="<?php echo $row[joinstr]?>"/></td></tr>
<tr><td>bandname</td><td><input name="bnd" type="text" value="<?php echo $row[bandname]?>"/></td></tr>
<tr><td>collaborators</td><td><input name="clb" type="text" value="<?php echo $row[collaborators]?>"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="modify"></td></tr>
</form>
</table>
</body>

</html>
