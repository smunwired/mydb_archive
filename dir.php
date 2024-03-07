<?php
$dir = "/var/www/html/mydb";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    if ((substr($filename,-3)=="php")||(substr($filename,-4)=="html")) {
    	$files[] = " <a href=\"" . $filename . "\">" . $filename . "</a>";
    }
}

echo "<p/>";
//do not know how this works yet
sort($files);

$max = sizeof($files);
for($i = 0; $i < $max;$i++)
{
echo $files[$i];
}

//print_r($files);

//rsort($files);

//print_r($files);

?>