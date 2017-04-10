<?php
$con = mysql_connect("localhost","root","");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("budget", $con);

$result = mysql_query("SELECT category.category,familybudget.moneyspent FROM category,familybudget
 WHERE category.categoryid=familybudget.categoryid AND familybudget.dateid=1 AND familybudget.familyid=3");
$rows = array();
while($r = mysql_fetch_array($result)) {
	$row[0] = $r[0];
	$row[1] = $r[1];
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);

mysql_close($con);
?> 
