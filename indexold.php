<?php include 'leftmenu.php'; ?>
<h1>Random Lists</h1>

<?php
include 'connect.php';
$lasthead="zzz";
$sql="select * from image where heading in ('top picks','vinyl revival','considering','killer debut','old hat','compact disc')
   order by display_seq,heading";
  //and url like '%100,100%'
foreach($conn->query($sql) as $row) {
	if ($lasthead!=$row['heading']) {
		echo "<h2>" . $row['heading'] . "</h2>";
	}
	echo "<image width=\"100\! height=\"100\" src=\"" . $row['url'] . "\">";
	$lasthead = $row['heading'];
}
include 'sitemap.php'
?>
