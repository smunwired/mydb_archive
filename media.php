<?php include 'leftmenu.php'; ?>
<h1>media</h1>
<?php
include 'connect.php';
$lasthead="zzz";
//$sql="select * from image left outer joing image_title on image.id=image_title.title where heading in ('the fall',top picks','vinyl revival','considering','killer debut','old hat','compact disc','digital','we got you on tape')
//   order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in ('top picks','vinyl revival','considering','killer debut','old hat','compact disc','digital','we got you on tape','the fall') order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in (select heading from heading where display=1) order by display_seq,heading";
//$sql="select image.id id,image.heading heading,image.url url,image.alt alt,image.display_seq display_seq,title_image.title title from image  left outer join title_image on id=image where heading in (select heading from heading where display=1) order by display_seq,heading";
$sql="select i.id id,h.nm heading,i.url url,i.alt alt,h.display_seq seq,it.title title,h.image_width wd,h.image_height ht
	from image i
	join image_heading ih on i.id=ih.image
	join heading h on ih.heading=h.id
	left outer join image_title it on i.id=it.image
	where h.display=1
	order by seq,heading";
$sql="select i.id id,i.url url,i.alt alt,it.title title
	from image i
	join image_title it on i.id=it.image
	joing title t on it.title=t.id
	join title_medium tm on tm.title=t.id
	join medium";
//$sql="select m.medium medium, 100 wd, 100 ht, url, alt, i.id image
//$sql="select i.id id,h.nm heading,if(url like 'http%',url,concat(\"images/\",url)) as url,i.alt alt,h.display_seq seq,it.title title,h.image_width wd,h.image_height ht
$sql="select m.medium medium, 100 wd, 100 ht, if(url like 'http%',url,concat(\"images/\",url)) as url, alt, i.id image
	from title t
	join title_medium tm on tm.title=t.id
	join image_title it on it.title=t.id
	join image i on i.id=it.image
	join medium m on tm.medium=m.id
	order by m.id";



foreach($conn->query($sql) as $row) {
	if ($lasthead!=$row['medium']) {
		echo "<h4>" . $row['medium'] . "</h4>";
	}
	echo "<a href=\"image/imgmodfm.php?image=" . $row[image] . "\"><img width=\"" . $row[wd] . "\" height=\"" . $row[ht] . "\" title=\"" . $row['alt'] . "\"src=\"" . $row['url'] . "\"/></a>";
	$lasthead = $row['medium'];
}


include 'sitemap.php'
?>
