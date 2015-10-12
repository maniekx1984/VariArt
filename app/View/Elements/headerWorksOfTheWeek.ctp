<h3>
	<?php
	echo "Works of the week ";
	
		echo $this->Html->link(
		    '',
		    '#collapseHeaderWorksOfTheWeek',
		    array('data-toggle' => 'collapse', 'aria-expanded' => 'true', 'aria-controls' => 'collapseHeaderWorksOfTheWeek', 'escape' => false, 'class' => 'btn btn-default btn-xs home-toggle', 'role' => 'button')
		);
	
	?>
</h3>
<div class="collapse in" id="collapseHeaderWorksOfTheWeek">
	
	<div class="row">
		<?php
		$i = 0;
		$homeWorksOfTheWeeks = $this->requestAction('/WorksOfTheWeeks/homeWorksOfTheWeek');
		foreach($homeWorksOfTheWeeks as $homeWorksOfTheWeek):
			echo "<div class=\"col-sm-3\">";
				$this->App->showMiniWorkwotW($is_of_age, $homeWorksOfTheWeek);
				echo "<br /><br />";
			echo "</div>";
		endforeach;
		?>
	</div>
	
	<div class="text-right">
		<?php
		echo $this->Html->link(
		    'more &rarr;',
		    array('controller' => 'WorksOfTheWeeks', 'action' => 'index'),
		    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
		);
		?>
	</div>
</div>