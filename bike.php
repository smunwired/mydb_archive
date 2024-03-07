<?php include 'leftmenu.php'; ?>
<h1>bike</h1>

<?php
include 'connect.php';
	echo "<table border=1>
		<tr>
			<th width=75px>date
			<th>time
			<th width=60px>distance
			<th width=60px>average
			<th>max
			<th>odo
			<th width=300px>notes
			<th width=50px>cost
			<th width=50px>total
			<th width=50px>amortize
			<td colspan=\"2\" align=\"center\"><a href=\"add.php\">add</a></td>
		</tr>";
	$sql = "select tran_id tid,tran_date dt,0 tm,0 dst,0 av,0 mx,0 odo,tran_desc notes,tran_amount*cr_dr amt
		from transdet where (cost_code=1 or tran_type_id=21) and tran_date > '2014-05-01'
		union
		select 0 tid,rdate dt,tm,dst,av,mx,odo,notes,0 amt
		from bike where rdate != '0000-00-00' and odo > 0
		order by dt desc , odo desc";
	$cost = 0;

	//echo $sql;
	//this is not a comment
	foreach($conn->query($sql) as $row) {
		$cost = $cost + $row['amt'];
		echo "<tr>
			<td align=center>" . $row['dt'] . "</td>" .
			"<td align=right>" . $row['tm'] . "</td>" .
			"<td align=right>" . number_format($row['dst'],2) . "</td>" .
			"<td>" . number_format($row['av'],2) . "</td>" .
			"<td>" . number_format($row['mx'],2) . "</td>" .
			"<td>" . number_format($row['odo'],2) . "</td>" .
			"<td>" . $row['notes'] . "</td>" .
			"<td align=center>" . number_format($row['amt'],2) . "</td>" .
			"<td align=center>" . number_format($cost,2) . "</td>" .
			"<td align=center>" . number_format($cost/$row['odo'],2) . "</td>";
			if ($row['odo']>0) {
				echo "<td><a href=\"mod.php?odo=" . $row['odo'] . "\">mod</a></td>";
			} else {
				echo "<td><a href=\"form.php?tid=" . $row['tid'] . "\">mod</a></td>";
			}
			echo "<td><a href=\"del.php?odo=" . $row['odo'] . "\">del</a></td></tr>";
	}
	echo "</table>";
include 'sitemap.php';
?>
