<h3>
	<?php
	echo "New works in main gallery";
	?>
</h3>
	
<?php
$lastWorks = $this->requestAction("works/homeNewWorks");
foreach($lastWorks as $lastWork):
	$this->App->showMiniWorkWithDetailsHome($is_of_age, $lastWork);
	echo "<br />";
endforeach;
?>

<div class="text-right">
	<?php
	echo $this->Html->link(
	    'more &rarr;',
	    array('controller' => 'works', 'action' => 'main'),
	    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
	);
	?>
</div>