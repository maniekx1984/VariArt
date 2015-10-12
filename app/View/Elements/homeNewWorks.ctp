<h3>
	<?php
	echo "New works in main gallery ";
	//echo "<small>";
		echo $this->Html->link(
		    '',
		    '#collapseHomeNewWorks',
		    array('data-toggle' => 'collapse', 'aria-expanded' => 'true', 'aria-controls' => 'collapseHomeNewWorks', 'escape' => false, 'class' => 'btn btn-default btn-xs home-toggle', 'role' => 'button')
		);
	//echo "</small>";
	?>
</h3>
<div class="collapse in" id="collapseHomeNewWorks">
	
	<div class="row">
		<?php
		$i = 0;
		$lastWorks = $this->requestAction("works/homeNewWorks");
		foreach($lastWorks as $lastWork):
			echo "<div class=\"col-sm-2\">";
				$this->App->showMiniWorkWithDetailsHome($is_of_age, $lastWork);
				echo "<br /><br />";
			echo "</div>";
		endforeach;
		?>
	</div>
	
	<div class="text-right">
		<?php
		echo $this->Html->link(
		    'more &rarr;',
		    array('controller' => 'works', 'action' => 'main'),
		    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
		);
		?>
	</div>
</div>