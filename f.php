<form method="GET" action="p.php">
<input type="hidden" name="chng" value="-1"></input>chng set to -1	<table width="40%" align="center">
	<tr>
	<td>
	<a href="radmn.php?chng=-2&grp=accd">less</a>
	</td>
	<td>
	<h1 align="center">October 2015</h1>
	</td>
	<td>
	<a href="radmn.php?chng=0&grp=accd">more</a>
	</td>
	</tr>
	</table>
	<table 	width="30%" align="right">

		<tr>
			<td>acc</td>
			<td><input type="radio" onchange="this.form.submit();" name="grp" value="accd" checked></input></td>
			<td>tty</td>
			<td><input type="radio" onchange="this.form.submit();" name="grp" value="ttyd"></input><td
		</tr>
			</table>

</form>
