<?php include 'leftmenu.php'; ?>
<?php
function getSel($chk1,$chk2,$chk3){
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
<?php include 'connect.php'; ?>
<?php if ((empty($_GET['grp']))) { $grp="accd"; } else { $grp = $_GET['grp']; } ?>
<?php if (empty($_GET['chng'])) { $chng = 0; } else { $chng = $_GET['chng']; } ?>
<?php if (empty($_GET['show'])) { $show = 0; } else { $show = $_GET['show']; } ?>
<form method="GET">
	  <div style="margin: 20 20 20 20;" align="right"><b>options : </b>
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
<input type="hidden" name="chng" value="<?php echo $chng; ?>"></input>
<table align="center">
  <tr>
    <td>
      <table align="center">
        <tr>
          <td>
            <a href="months.php?chng=<?php echo $chng - 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">less</a>
          </td>
          <td>
            <h1 align="center">
            <?php
		    if ($chng==0) {
		      echo date("F Y");
		    } else {
			  echo date("F Y", strtotime("+" . $chng . " months"));
		    }
		    ?>
		    </h1>
	      </td>
	      <td>
	      <a href="months.php?chng=<?php echo $chng + 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">more</a>
	      </td>
	    </tr>
	  </table>
	</td>
  </tr>
</table>

<table align="center">
<?php
  $whr = " and 1=1 ";
  $ordcol = "tran_date";
  $limit = 222;
#is this a comment ?
  if ($grp=="ttyd") {
    $slct = "select tran_type.tran_type_id ttyd, tran_type.tran_type tty,sum(transdet.tran_amount*cr_dr) amt ";
    $grpby = " group by ttyd,tty order by ttyd ";
  } else if ($grp=="accd") {
    $slct = "select account.account_id ttyd, account.account_name tty,sum(transdet.tran_amount*cr_dr) amt ";
    $grpby = " group by ttyd,tty order by ttyd ";
  } else {
    $slct = "select  tran_id tid,tran_date trd, crdd,	brnd,
        		concat_ws(', ',c1.nm,c2.nm) crd,
        		tran_type.tran_type_id ttyd,
        		tran_type.tran_type tty,
        		account.account_name acc,
        		account.account_id accd,
        		transdet.tran_amount*transdet.cr_dr amt,
        		receipt_ind rcpt, dd_ind dd,
        		date_format(statement_date,'%Y-%m-%y') std,
        		date_format(date_created,'%Y-%m-%d') dtc,
        		if(date_format(date_amended,'%Y')='0000','n/a',date_format(date_amended,'%Y-%m-%d')) as dta ";
    $grpby = " order by tran_date ";
  }
  $sql = $slct . "
		from transdet
		left join frequency on transdet.frequency = frequency.freq_id
		left join cost_center on transdet.cost_code = cost_center.cost_code
		left join crd c1 on crdd=c1.id
		left join crd c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id
		where " . $ordcol . " is not null " . $whr . "
		and date_format(tran_date,'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) . "' " . $grpby . $orddr .
		" limit " . $limit;
#	echo $sql;
	if ($grp=='all'){
			foreach($conn->query($sql) as $row2) {
				echo "<tr><td align=center>" . $row2['trd'] . "</td><td>" . $row2['crd'] . "</td><td>"  . $row2['acc'] . "</td><td>"  . $row2['tty'] . "</td><td>"
					. $row2['amt'] . "</td><td>" . $row2['rcpt'] . "</td><td>" . $row2['dd'] . "</td><td>" . $row2['std']
					. "</td><td><a href=mod.php?tid=" . $row2['tid']
					. ">mod</a></td><td><a href=del.php?tid=" . $row2['tid'] . ">del</a></td></tr>";
			}
	} else {
	  foreach($conn->query($sql) as $row) {
	    if ($show!=$row['ttyd']) {
		    echo "<tr><td><a href=\"months.php?chng=" . $chng . "&grp=" . $grp . "&show=" . $row['ttyd'] . "\">" . $row['tty'] . "</a></td><td>" . $row['amt'] . "</td></tr>";
		} else {
		    echo "<tr><td><a href=\"months.php?chng=" . $chng . "&grp=" . $grp . "&show=0\">" . $row['tty'] . "</a></td><td>" . $row['amt'] . "</td></tr>";
			//account, tran_type or all ?
			if ($grp=="accd") {
				$cls = "transdet.account_id";
			} else if ($grp=="ttyd"){
				$cls = "transdet.tran_type_id";
			} else {
				$cls = $show;
			}
			$sql2="select  tran_id tid,tran_date trd, crdd,	brnd,
        		concat_ws(', ',c1.nm,c2.nm) crd,
        		tran_type.tran_type_id ttyd,
        		tran_type.tran_type tty,
        		transdet.tran_amount*transdet.cr_dr amt,
        		receipt_ind rcpt, dd_ind dd,
        		date_format(statement_date,'%Y-%m-%y') std,
        		date_format(date_created,'%Y-%m-%d') dtc,
        		if(date_format(date_amended,'%Y')='0000','n/a',date_format(date_amended,'%Y-%m-%d')) as dta
			from transdet
			left join frequency
			on transdet.frequency = frequency.freq_id
			left join cost_center on transdet.cost_code = cost_center.cost_code
			left join crd c1 on crdd=c1.id
			left join crd c2 on brnd=c2.id
			join account on transdet.account_id=account.account_id
			join tran_type on transdet.tran_type_id=tran_type.tran_type_id
			where tran_id is not null
			and " . $cls . "=" . $show .
			" and date_format(tran_date,'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) .
			"' order by 2";


			#echo "<tr><td>" . $sql2 . "</td></tr>";
			echo "<tr><th>tran date<th>creditor<th>type<th>amount<th>rcpt<th>dd<th>statement</tr>";
			foreach($conn->query($sql2) as $row2) {
				echo "<tr><td align=center>" . $row2['trd'] . "</td><td>" . $row2['crd'] . "</td><td>"  . $row2['acc'] . "</td><td>"  . $row2['tty'] . "</td><td>"
					. $row2['amt'] . "</td><td>" . $row2['rcpt'] . "</td><td>" . $row2['dd'] . "</td><td>" . $row2['std']
					. "</td><td><a href=mod.php?tid=" . $row2['tid']
					. ">mod</a></td><td><a href=del.php?tid=" . $row2['tid'] . ">del</a></td></tr>";
			}
			}
		}
	}
?>

</table>
</form>
