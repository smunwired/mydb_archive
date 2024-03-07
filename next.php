<?php

echo "<form action=\"next.php\" method=\"post\">";
if ($_POST['ordcol']=="trd") {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tid\"/>";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"trd\" checked  />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"std\" />";
} elseif ($_POST['ordcol']=="std") {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tid\"/>";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"trd\" />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"std\" checked  />";
} else {
   echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tid\" checked  />";
   echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"trd\" />";
   echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"std\"/>";
}
echo "</form>";

?>