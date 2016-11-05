<?php
include("../includes/php/khoitao.php");
$varis=intval($_GET["varis"]);
switch($varis)
{
	case 1:delManualFile();break;
}
function delManualFile()
{
	$id=intval($_GET["id"]);
	$fields=$_GET["fields"];
	$test=mysql_query("update product set $fields='' where id=$id");
	if($test) echo 1;
	else echo 0;
}

?>