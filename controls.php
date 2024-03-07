<?php if ((empty($_GET['grp']))) { $grp="accd"; } else { $grp = $_GET['grp']; } ?>
<?php if (empty($_GET['chng'])) { $chng = 0; } else { $chng = $_GET['chng']; } ?>
<form method="GET">
<input type="hidden" name="chng" value="<?php echo $chng; ?>"></input>
<table align="center">
	<tr>
		<td>
	<table align="center">
	<tr>
	<td>
	<a href="controls.php?chng=<?php echo $chng - 1; ?>&grp=<?php echo $grp; ?>">less</a>
	</td>
	<td>
	<h1 align="center"><?php
		if ($chng==0) {
			echo date("F Y");
		} else {
			echo date("F Y", strtotime("+" . $chng . " months"));
		}?></h1>
	</td>
	<td>
	<a href="controls.php?chng=<?php echo $chng + 1; ?>&grp=<?php echo $grp; ?>">more</a>
	</td>
	</tr>
	</table>
	</td><td>
	<table align="right">
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
		</td>
	</tr>
</table>

</form>
