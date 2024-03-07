<?php include 'leftmenu.php'; ?>
<h1>listen!</h1>
<?php
include 'connect.php';
$lasthead="zzz";
//$sql="select * from image left outer joing image_title on image.id=image_title.title where heading in ('the fall',top picks','vinyl revival','considering','killer debut','old hat','compact disc','digital','we got you on tape')
//   order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in ('top picks','vinyl revival','considering','killer debut','old hat','compact disc','digital','we got you on tape','the fall') order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in (select heading from heading where display=1) order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in (select heading from heading where display=1) order by display_seq,heading";
$sql="select i.id id,h.nm heading,if(url like 'http%',url,concat(\"images/\",url)) as url,i.alt alt,h.display_seq seq,it.title title,h.image_width wd,h.image_height ht
	from image i
	join image_heading ih on i.id=ih.image
	join heading h on ih.heading=h.id
	left outer join image_title it on i.id=it.image
	where h.display=1
	order by seq,heading";

foreach($conn->query($sql) as $row) {
	if ($lasthead!=$row['heading']) {
		echo "<h4>" . $row['heading'] . "</h4>";
	}
	echo "<a href=\"image/imgmodfm.php?image=" . $row[id] . "\"><img width=\"" . $row[wd] .
		"\" height=\"" . $row[ht] . "\" title=\"" . $row['alt'] . "\" src=\"" . $row['url'] . "\"/></a>";
	$lasthead = $row['heading'];
}

echo "<h2>images</h2>";
$sql="select id, url, alt, wdth, hght  from image i where not exists (select null from image_heading ih where ih.image=i.id)";
$sql="select id, if(url like 'http%',url,concat(\"images/\",url)) as url, alt, wdth, hght  from image i";
foreach($conn->query($sql) as $row) {
	echo "<a href=\"image/imgmodfm.php?image=" . $row[id] . "\"><img width=\"" . $row[wdth]. "\" height=\"" . $row[hght] . "\" title=\"" . $row['alt'] . "\"src=\"" . $row['url'] . "\"/></a>";
}


include 'sitemap.php'
?>
