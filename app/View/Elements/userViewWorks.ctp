<?php
$i = 0;

foreach($works as $work):
	if($i == 0){
		echo "<div class=\"row\">";
	}
	echo "<div class=\"col-sm-2\">";
		$this->App->showMiniWorkInUserHome($is_of_age, $work);
		echo "<br /><br />";
	echo "</div>";
	if($i == 5){
		echo "</div>";
		$i = 0;
	} else {
		$i = $i + 1;
	}
endforeach;
if($i > 0){
	echo "</div>";
}
?>