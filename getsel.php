<?php
function getSel($grp){
		if ($grp=="accd") {
			$chk1 = " checked";
			$chk2 = "";
			$chk3 = "";
		} else if ($grp=="ttyd"){
			$chk1 = "";
			$chk2 = " checked";
			$chk3 = "";
		} else {
			$chk1 = "";
			$chk2 = "";
			$chk3 = " checked";
		}
		echo "
			acc
			<input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"accd\"" . $chk1 .  "></input>
			tty
			<input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"ttyd\"" . $chk2 . "></input>
			all
			<input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"all\"" . $chk3 . "></input>
		";
}
?>
