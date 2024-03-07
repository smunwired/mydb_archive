<h1>add a new record</h1>
<form method="post" action="newpost.php">
<table>
      <tr><td>medium</td><td>
<?php
include 'connect.php';
	    $sql = "select * from medium";
        echo "<div style=\"position: absolute;top: 32px; left: 430px;\" id=\"outerFilterDiv\">
<tr><td>medium</td><td><input name=\"filterTextField\" type=\"text\" id=\"filterTextField\"
tabindex=\"2\"  style=\"width: 140px;    position: absolute; top: 1px; left: 1px; z-index: 2;border:none;\" />
        <div style=\"position: absolute;\" id=\"filterDropdownDiv\">
<select name=\"filterDropDown\" id=\"filterDropDown\" tabindex=\"1000\"
    onchange=\"DropDownTextToBox(this,'filterTextField');\"
    style=\"position: absolute; top: 0px; left: 0px; z-index: 1; width: 165px;\">";
	    foreach($conn->query($sql) as $row) {
		  echo "<option value=" . $row['id'] . "/>" . $row['medium'];

	    }
	    echo "</select></td></tr>";
	    ?>

<div style="position: absolute;top: 32px; left: 430px;" id="outerFilterDiv">
<tr><td>medium</td><td><input name="filterTextField" type="text" id="filterTextField" tabindex="2"  style="width: 140px;
    position: absolute; top: 1px; left: 1px; z-index: 2;border:none;" />
        <div style="position: absolute;" id="filterDropdownDiv">
<select name="filterDropDown" id="filterDropDown" tabindex="1000"
    onchange="DropDownTextToBox(this,'filterTextField');" style="position: absolute;
    top: 0px; left: 0px; z-index: 1; width: 165px;">
    <option value="-1" selected="selected" disabled="disabled">-- Select Column Name --</option>
</select>


</td></tr>
<tr><td>year</td><td><br/><input type="text" name="year"/></td></tr>
<tr><td>label</td><td><br/><input type="text" name="label"/></td></tr>
<tr><td>title</td><td><br/><input type="text" name="title"/></td></tr>
<tr><td>artist</td><td><br/><input type="text" name="artist"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="add"></td></tr>
</table>
</form>

