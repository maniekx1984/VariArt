<?php
$this->set("title_for_layout", "Works of the week");
?>

<div class="row">
	<div class="col-sm-12">
		
		<h3>
			Works of the week
		</h3>
		<br />
		<?php
			$i = 0;
			foreach ($worksOfTheWeeks as $worksOfTheWeek):
				if($i == 0){
					echo "<div class=\"row\">";
				}
				echo "<div class=\"col-sm-2\">";
					$this->App->showMiniWorkEntree($is_of_age, $worksOfTheWeek);
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
		
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<?php
		echo $this->element('paginator');
		?>
		
	</div>
</div>