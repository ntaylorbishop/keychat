<?php

$string = file_get_contents("/Users/hhouston/Desktop/menu.json");
$json_a=json_decode($string,true);

var_dump($json_a);
ksort($json_a['menu']);
var_dump($json_a);

echo "<ol>\n";
foreach($json_a['menu'] as $key => $val) {
        echo "\t<li>" . htmlentities($key) . ' => ' . htmlentities($val) . "</li>\n";
}
echo "</ol>\n";
/*
foreach ($json_a as $key => $value)
 {
   echo $key, ' : ';
   foreach($value as $v)
   {
       echo $v."  ";
   }
}
*/

?>