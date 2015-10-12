<?PHP
#!/usr/bin/php
//set_time_limit(0);
include("app/Config/database.php");

$db = new DATABASE_CONFIG();


if(!$mydb = mysql_connect($db->default['host'], $db->default['login'], $db->default['password'])) {
	
}
if(!$myselect = mysql_select_db($db->default['database'], $mydb)) {
	
}
$dg_data = date("Y-m-d");


$dg_mysql = "UPDATE va_entrees SET is_waiting = '0', destination_date = '$dg_data' WHERE is_waiting = '1' ORDER BY id ASC LIMIT 1;";
$dg_wynik = mysql_query($dg_mysql);

//echo $dg_mysql;


mysql_close();
?>