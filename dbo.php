<?php
$host = "127.0.0.1";
$user = "root";
$pass = "1234";
$dbname = "chk_fr";

	$objConnect = mysql_connect($host,$user,$pass);
if($objConnect){
	 mysql_select_db ($dbname);
	 mysql_query("SET NAMES UTF8");
}

else echo "Database Connect Failed.";