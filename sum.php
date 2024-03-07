<?php
echo "lastval:" . $_GET['lastval'];
echo "a:" . $_GET['a'];
echo "b:" . $_GET['b'];
$thisval = $_GET['a'] + $_GET['b']; echo $thisval;
?>
<form action="sum.php" method="get">
<a href="sum.php?a=-1">less</a>
<input type="hidden" name="lastval" value="<?php echo $thisval; ?>"></input>
</form>