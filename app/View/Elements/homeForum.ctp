<?php
$lastPosts = $this->requestAction('/posts/sidePosts');
foreach($lastPosts as $lastPost):
	
	echo "<h5>";
		echo $this->Html->link($this->Text->truncate($lastPost['Post']['content'], 40, array('ellipsis' => '...', 'exact' => false, 'html' => false
		)), array('controller' => 'topics', 'action' => 'view', $lastPost['Topic']['id']));
		echo "<br />";
		echo "<small>";
			echo $this->App->formatLevel($lastPost['User']['level'], $lastPost['User']['master_level']).''.$lastPost['User']['username'].' | '.$lastPost['Post']['created'];
		echo "</small>";
	echo "<h5>";
endforeach;
?>