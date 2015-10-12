<?php
$this->set('title_for_layout', 'News');
?>

<div class="row">
	<div class="col-sm-8">
		
		<h3>
			News
		</h3>
		<br />
		<?php
		echo $this->element('news');
		
		echo "<br />";
		
		echo $this->element('paginator');
		?>
		
	</div>
	<div class="col-sm-4">
		<?php
		echo $this->element('sideNewWorks');
		?>
	</div>
</div>