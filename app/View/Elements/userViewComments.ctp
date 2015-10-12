<?php
foreach($comments as $comment):
	$this->App->showComment($comment, "user");
endforeach;
?>