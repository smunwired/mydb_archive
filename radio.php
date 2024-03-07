<?php if ((empty($_GET['grp']))) {
	$grp="accd"; }
else {
	$grp = $_GET['grp'];
} ?>
<form method="GET">
	<table 	width="30%" align="right">
		<?php
		if ($grp=="accd") {
		echo "
		<tr>
			<td>acc</td>
			<td><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"accd\" checked></input></td>
			<td>tty</td>
			<td><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"ttyd\"></input><td
		</tr>
		";
		} else {
		echo "
		<tr>
			<td>acc</td>
			<td><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"accd\"></input></td>
			<td>tty</td>
			<td><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"ttyd\" checked></input><td
		</tr>
		 "; } ?>
	</table>

</form>
