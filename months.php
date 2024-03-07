<?php include 'leftmenu.php'; ?>
<?php include 'getsel.php'; ?>
<?php include 'connect.php'; ?>
<?php if ((empty($_GET['grp']))) { $grp="accd"; } else { $grp = $_GET['grp']; } ?>
<?php if (empty($_GET['chng'])) { $chng = 0; } else { $chng = $_GET['chng']; } ?>
<?php if (empty($_GET['show'])) { $show = 0; } else { $show = $_GET['show']; } ?>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>options : </b>
	<?php		getsel($grp);		?>
</div>
<input type="hidden" name="chng" value="<?php echo $chng; ?>"></input>
<div style="display:table;width:100%;">
<!--  <div style="display: table-row;border: 1px solid #98bf21; ">	-->
  <div style="display:table-row;">
<!--    <div style="display: table-cell; width:70px;margin-right:auto;margin-left: auto ;border: 1px solid #98bf21; text-align:center;">	-->
    <div style="display: table-cell;text-align:center;">
      <a href="months.php?chng=<?php echo $chng - 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">less</a>
    </div>
<!--    <div style="display: table-cell; width: 70px ;  margin-left: auto ;  margin-right: auto ;">	-->
    <div style="display:table-cell;">
      <h1 align="center">
       <?php
	    if ($chng==0) {
	      echo date("F Y");
	    } else {
		  echo date("F Y", strtotime("+" . $chng . " months"));
	    }
	   ?>
    </div>
<!--    <div style="display: table-cell; width: 70px ;margin:20 20 20 20;border: 1px solid #98bf21;text-align:center;">	-->
    <div style="display:table-cell;text-align:center;">
      <a href="months.php?chng=<?php echo $chng + 1; ?>&grp=<?php echo $grp; ?>&show=<?php echo $show; ?>">more</a>
    </div>
  </div>
</div>

<table align="center" width=100% border=0>
<?php include 'query.php'; ?>
<?php
if ($grp=='all'){
		echo "<tr><th width=75px>tran date
				<th width=225px>crd
				<th width=225px>dsc
				<th width=125px>acc
				<th width=125px>tty
				<th width=30px>amt
				<th width=50px>chq
				<th width=25px>rcpt
				<th width=25px>dd
				<th width=75px>std</tr>";
			foreach($conn->query($sql) as $row2) {
				echo "<tr>
						<td align=\"center\">" . $row2['trd'] . "</td>
						<td>" . $row2['crd'] . "</td>
						<td>" . $row2['dsc'] . "</td>
						<td>" . $row2['acc'] . "</td>
						<td>" . $row2['tty'] . "</td>
						<td align=\"right\">" . $row2['amt'] . "</td>
						<td align=\"center\">" . $row2['chq'] . "</td>
						<td align=\"center\">" . $row2['rcpt'] . "</td>
						<td align=\"center\">" . $row2['dd'] . "</td>
						<td align=\"center\">" . $row2['std'] . "</td>
						<td><a href=form.php?tid=" . $row2['tid']. " target=_blank>mod</a></td>
						<td><a href=del.php?tid=" . $row2['tid'] . " target=_blank>del</a></td>
					</tr>";
			}
	} else {
	  foreach($conn->query($sql) as $row) {
	    if ($show!=$row['ttyd']) {
		    echo "<tr><td align=center><a href=\"months.php?chng=" . $chng . "&grp=" . $grp . "&show=" . $row['ttyd'] . "\">" . $row['tty'] . "</a></td><td>" . $row['amt'] . "</td></tr>";
		} else {
		    echo "<tr><td align=center><a href=\"months.php?chng=" . $chng . "&grp=" . $grp . "&show=0\">" . $row['tty'] . "</a></td><td align=center>" . $row['amt'] . "</td></tr>";
			//account, tran_type or all ?
			if ($grp=="accd") {
				$cls = "transdet.account_id";
			} else if ($grp=="ttyd"){
				$cls = "transdet.tran_type_id";
			} else {
				$cls = $show;
			}
			$sql2="select  tran_id tid,tran_date trd, tran_desc dsc, crdd,	brnd,
        		concat_ws(', ',c1.nm,c2.nm) crd,
        		tran_type.tran_type_id ttyd,
        		tran_type.tran_type tty,
        		account.account_id accd,
        		account.account_name acc,
        		transdet.tran_amount*transdet.cr_dr amt,
        		receipt_ind rcpt,
        		dd_ind dd,
        		date_format(statement_date,'%Y-%m-%d') std,
        		cheque_no chq,
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
			" and date_format(coalesce(statement_date,tran_date),'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) .
			"' order by coalesce(statement_date,tran_date)";


			#echo "<tr><td>" . $sql2 . "</td></tr>";
		echo "<tr><th width=75px>tran date
				<th width=125px>crd<th width=225px>desc";
		if ($grp=='accd') { echo "<th width=125px>tty"; } else { echo "<th width=125px>acc"; }
		echo "<th>amt
				<th width=25px>chq
				<th width=25px>dd
				<th width=25px>rcpt
				<th width=75px>std</tr>";
			/* echo "<tr><th>tran date<th>creditor<th>desc<th>type<th>amount<th>rcpt<th>dd<th>statement</tr>"; */
			foreach($conn->query($sql2) as $row2) {
				echo "<tr>
						<td width=\"75px\" align=\"center\">" . $row2['trd'] . "</td>
						<td>" . $row2['crd'] . "</td>
						<td align=\"center\">" . $row2['dsc'] . "</td>";
						if ($grp=="accd") {
							echo "<td>" . $row2['tty'] . "</td>";
						} else {
							echo "<td>" . $row2['acc'] . "</td>";
						}
						echo "<td align=\"right\">" . $row2['amt'] . "</td>
						<td align=\"center\">" . $row2['chq'] . "</td>
						<td align=\"center\">" . $row2['dd'] . "</td>
						<td align=\"center\">" . $row2['rcpt'] . "</td>
						<td align=\"center\">" . $row2['std'] . "<a href=setstddt.php?tid=" . $row2['tid'] . "&trd=" . $row2['trd'] . " target=_blank>set</a></td>
						<td><a href=form.php?tid=" . $row2['tid']. " target=_blank>mod</a></td>
						<td><a href=del.php?tid=" . $row2['tid'] . " target=_blank>del</a></td>
					</tr>";
					/*
				echo "<tr><td align=center>" . $row2['trd'] . "</td><td>" . $row2['crd'] . "</td><td>"  . $row2['dsc'] . "</td><td>"  . $row2['acc'] . "</td><td>"  . $row2['tty'] . "</td><td>"
					. $row2['amt'] . "</td><td>" . $row2['rcpt'] . "</td><td>" . $row2['dd'] . "</td><td>" . $row2['std']
					. "</td>
					<td><a href=form.php?tid=" . $row2['tid']
					. " target=_blank>mod</a></td><td><a href=del.php?tid=" . $row2['tid'] . " target=_blank>del</a></td></tr>";
					*/
			}
			}
		}
	}
?>

</table>
</form>
