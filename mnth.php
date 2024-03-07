<html>
<head>
  <title>mydb</title>
  <link rel="stylesheet" type="text/css" href="/mydb/style/scroll.css">
</head>

<body>

<div id="left">
<a href="/mydb">home</a>
<ul>
<li><a href="/mydb/artstlst.php">artist</a>
<li><a href="/mydb/titlelst.php">titles</a>
<li><a href="/mydb/image.php">image</a>
<li><a href="heading.php">display</a></li>
<li><a href="/mydb/media.php">media</a></li>
</ul>
<!--<li><a href="/mydb/list.php">divansactions</a>-->
<p class="sub">divansactions
<ul>
<li><a href="/mydb/months.php">months</a>
<li><a href="/mydb/list.php">list</a>
<li><a href="/mydb/form.php">add</a>
<li><a href="/mydb/crd.php">creditors</a>
<li><a href="/mydb/maint.php">maint</a>
</ul>
<ul>
<li><a href="/mydb/bike.php">bike</a>
</ul>
<ul>
<li><a href="/mydb/para.php">paragraph</a>
</ul>
</div>

<div id="right"><form method="GET">
<input type="hidden" name="chng" value="-1"></input>
<div class="row">
  	<div>
		<a href="months.php?chng=-2&grp=accd&show=0">less</a>
	</div>
	<div>
		<h1 align="center"> May 2016		    </h1>
	</div>
	<div>
		<a href="months.php?chng=0&grp=accd&show=0">more</a>
	</div>
	<div>
		acc
	</div>
	<div><input type="radio" onchange="this.form.submit();" name="grp" value="accd" checked></input></div>
			<div>tty</div>
			<div><input type="radio" onchange="this.form.submit();" name="grp" value="ttyd"></input></div>
			<div>all</div>
			<div><input type="radio" onchange="this.form.submit();" name="grp" value="all"></input></div>
		</div>
		  </div>
	</div>
  </div>
</div>

<div align="center">
<div><div><a href="months.php?chng=-1&grp=accd&show=3">Barclaycard                                            </a></div><div>-746.10</div></div><div><div><a href="months.php?chng=-1&grp=accd&show=99">Cash           </a></div><div>-212.88</div></div>
</div>
</form>
