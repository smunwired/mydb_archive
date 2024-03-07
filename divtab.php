<!--
<head>
<style>
.rTable    { display: table; }
.rTableRow       { display: table-row; }
.rTableHeading    { display: table-header-group; }
.rTableBody    { display: table-row-group; }
.rTableFoot    { display: table-footer-group; }
.rTableCell, .rTableHead  { display: table-cell; }
</style>
</head>
-->
<head>
<style>
.rTable {
		    	display: table;
		    	width: 100%;
		}
		.rTableRow {
		    	display: table-row;
		}
		.rTableHeading {
		    	display: table-header-group;
		    	background-color: #ddd;
		}
		.rTableCell, .rTableHead {
		    	display: table-cell;
		    	padding: 3px 10px;
		    	border: 1px solid #999999;
		}
		.rTableHeading {
		    	display: table-header-group;
		    	background-color: #ddd;
		    	font-weight: bold;
		}
		.rTableFoot {
		    	display: table-footer-group;
		    	font-weight: bold;
		    	background-color: #ddd;
		}
		.rTableBody {
		    	display: table-row-group;
		}
</style>
</head>

<h2>Phone numbers</h2>
<div class="rTable">
	<div class="rTableRow">
		<div class="rTableHead"><strong>Name</strong></div>
		<div class="rTableHead"><span style="font-weight: bold;">Telephone</span></div>
		<div class="rTableHead">&nbsp;</div>
	</div>
	<div class="rTableRow">
		<div class="rTableCell">John</div>
		<div class="rTableCell"><a href="tel:0123456785">0123 456 785</a></div>
		<div class="rTableCell"><img src="images/check.gif" alt="checked" /></div>
	</div>
	<div class="rTableRow">
		<div class="rTableCell">Cassie</div>
		<div class="rTableCell"><a href="tel:9876532432">9876 532 432</a></div>
		<div class="rTableCell"><img src="images/check.gif" alt="checked" /></div>
	</div>
</div>
<?php
function getSel($chk1,$chk2,$chk3){
		echo "
		<div class=\"rTableRow\">
			<div class=\"rTableCell\">acc</div>
			<div class=\"rTableCell\"><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"accd\"" . $chk1 .  "></input></div>
			<div class=\"rTableCell\">tty</div>
			<div class=\"rTableCell\"><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"ttyd\"" . $chk2 . "></input></div>
			<div class=\"rTableCell\">all</div>
			<div class=\"rTableCell\"><input type=\"radio\" onchange=\"this.form.submit();\" name=\"grp\" value=\"all\"" . $chk3 . "></input></div>
		</div>
	";
}
?>
<?php include 'connect.php'; ?>
<?php if ((empty($_GET['grp']))) { $grp="accd"; } else { $grp = $_GET['grp']; } ?>
<?php if (empty($_GET['chng'])) { $chng = 0; } else { $chng = $_GET['chng']; } ?>
<?php if (empty($_GET['show'])) { $show = 0; } else { $show = $_GET['show']; } ?>
<form method="GET">
<input type="hidden" name="chng" value="<?php echo $chng; ?>"></input>
<div>
  <div>
    <div>
      <div>
        <div>
          <div class=\"rTable\">
            <div class=\"rTableRow>

            <a href="months.php?chng=<?php echo $chng - 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">less</a>
          </div>
          <div>
            <h1 align="center">
            <?php
		    if ($chng==0) {
		      echo date("F Y");
		    } else {
			  echo date("F Y", strtotime("+" . $chng . " months"));
		    }
		    ?>
		    </h1>
          </div>
          <div>
	      <a href="months.php?chng=<?php echo $chng + 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">more</a>
          </div>
		  		</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div>
		<?php
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
		getSel($chk1,$chk2,$chk3);
		?>
  </div>
</div>

