<?php include 'leftmenu.php'; ?>
<h1>titles</h1>

<?php
include 'connect.php';
$ttlfnd = 0;
$select = "select t.id id,fnfullname(a.id) artist,a.id aid,
	concat(t.prefix,case when length(t.prefix)=0 then '' else ' ' end,t.title) title,
	count(tm.label) media,coalesce(first_released,min(release_year),'') released,count(i.id) imgc
	from title t
	left join title_medium tm on t.id=tm.title
	join artist a on a.id=t.artist
	left join image i on i.title=t.id";
$grp=" group by t.title order by concat(lastname,bandname),coalesce(first_released,min(release_year),'')";
if ($_GET["artist"]!=0) {
  $sql=$select . " where a.id=" . $_GET["artist"] . $grp;
} elseif ($_GET["id"]!=0) {
  $sql=$select . " where t.id=" . $_GET["id"] . $grp;
} else {
  $sql=$select . $grp;
}
//echo "<p>" . $sql . "</p>";
echo "<table class=\"nobr\">";
$lastartst = "zzzz";
foreach($conn->query($sql) as $row) {
  $ttlfnd = 1;
  echo "<tr>";
  if ($lastartst!=$row['artist']) {
    $lastartst=$row['artist'];
    echo "<td><b>" . $row['artist'] .  "</b></tr>
      <tr><th class=\"leftpaddedcellgray\">title
          <th class=\"subheading\">year<th class=\"subheading\">media
          <td  class=\"subheading\" colspan=\"4\" align=\"center\"><a href=\"title/ttladdfm.php?id=" . $row["aid"] . "\">add</a></td></tr>";
  }
  echo "<tr><td class=\"leftpaddedcell\">" . $row['title'] .
    "</td><td>" . $row['released'] .
    "</td><td class=\"cntr\">" . $row['media'] .
    "</td><td><a href=\"title/ttlmodfm.php?id=" . $row['id'] . "\">mod</a></td>
    <td><a href=\"title/titledel.php?id=" . $row['id'] . "\">del</a></td>
    <td><a href=\"title/ttlmdlst.php?id=" . $row['id'] . "\">list title media</a></td>
    <td><a href=\"title/ttlmdadf.php?id=" . $row['id'] . "\">add title medium</a></td>";
    if ($row['imgc']==0) {
    	echo "<td><a href=\"image/imgaddfm.php?id=" . $row['id'] . "\">add image</a></td>";
    } else {
    	echo "<td><a href=\"image/imgmodfm.php?title=" . $row['id'] . "\">image</a></td>";
    }
  echo "</tr>";
}
if ($ttlfnd==0) {
  echo "<tr><td>No titles found for <b>" . $_GET['artstnm'] . "</b></td><td><a href=\"title/ttladdfm.php?id=" . $_GET["artist"] . "\">add</a></td></tr>";
}
echo "</table>";
include 'sitemap.php';
?>
</body></html>
