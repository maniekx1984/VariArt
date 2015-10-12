<?PHP
#!/usr/bin/php
//set_time_limit(0);
include("app/Config/database.php");

$db = new DATABASE_CONFIG();


if(!$mydb = mysql_connect($db->default['host'], $db->default['login'], $db->default['password'])) {
	
}
if(!$myselect = mysql_select_db($db->default['database'], $mydb)) {
	
}
$current_date = date("Y-m-d");
$end_date = date('Y-m-d', strtotime('+6 days'));


//select last week
$week = "SELECT * FROM va_works_of_the_weeks_weeks ORDER BY id DESC LIMIT 0,1;";
$week = mysql_query($week);
$week = mysql_fetch_array($week);

$week_id = $week["id"];
$week_date_end = $week["date_end"];

//grup works from last week
$gouped_works = "SELECT COUNT(work_id) AS votes_count, work_id, id FROM va_works_of_the_weeks WHERE week_id = '$week_id' GROUP BY work_id ORDER BY votes_count DESC, id ASC LIMIT 0,4";
$gouped_works = mysql_query($gouped_works);
while($gouped_works_row = mysql_fetch_array($gouped_works)) {
	
	mysql_query("INSERT INTO va_works_of_the_weeks (work_id, week_id, votes, date) VALUES ('".$gouped_works_row["work_id"]."', '$week_id', '".$gouped_works_row["votes_count"]."', '$week_date_end');");
	
}

//copy votes to VOTES table
mysql_query("INSERT INTO va_works_of_the_weeks_votes SELECT * FROM va_works_of_the_weeks WHERE voter_id IS NOT NULL AND week_id = '$week_id';");

//delete votes
mysql_query("DELETE FROM va_works_of_the_weeks WHERE voter_id IS NOT NULL AND week_id = '$week_id';");


//add new week
mysql_query("INSERT INTO va_works_of_the_weeks_weeks VALUES ('NULL', '$current_date', '$end_date');");


mysql_close();
?>