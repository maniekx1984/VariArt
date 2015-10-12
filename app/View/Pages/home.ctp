<?php
$this->set('title_for_layout', 'Home');
?>


<div class="row">
	<div class="col-sm-12">
		<?php
		echo $this->element('headerEntreeJumbotron');
		?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<?php echo $this->element('headerWorksOfTheWeek'); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<?php echo $this->element('homeNewWorks'); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h3>
			<?php
			echo "Interesting gallery ";
			
				echo $this->Html->link(
				    '',
				    '#collapseHomeInteresting',
				    array('data-toggle' => 'collapse', 'aria-expanded' => 'true', 'aria-controls' => 'collapseHomeInteresting', 'escape' => false, 'class' => 'btn btn-default btn-xs home-toggle', 'role' => 'button')
				);
			
			?>
		</h3>
		<div class="collapse in" id="collapseHomeInteresting">
			<div class="row">
				<?php
				$interestingUserId = $this->requestAction('/users/homeInteresting');
				$interestingWorks = $this->requestAction('/works/homeInteresting/'.$interestingUserId['User']['id'].'');
				$i = 0;
				foreach($interestingWorks as $interestingWork):
					echo "<div class=\"col-sm-2\">";
						$this->App->showMiniWorkWithDetailsInteresting($is_of_age, $interestingWork);
						echo "<br /><br />";
					echo "</div>";
				endforeach;
				?>
			</div>
			
			<div class="text-right">
				<?php
				echo $this->Html->link(
				    'more &rarr;',
				    array('controller' => 'users', 'action' => 'view', $interestingUserId['User']['id']),
				    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
				);
				?>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<h3>
			<?php
			echo "New works in the initial gallery ";
			
				echo $this->Html->link(
				    '',
				    '#collapseHomeInitial',
				    array('data-toggle' => 'collapse', 'aria-expanded' => 'true', 'aria-controls' => 'collapseHomeInitial', 'escape' => false, 'class' => 'btn btn-default btn-xs home-toggle', 'role' => 'button')
				);
			
			?>
		</h3>
		
		<div class="collapse in" id="collapseHomeInitial">
			<div class="row">
				<?php
				$initialWorks = $this->requestAction('/works/homeInitial');
				foreach($initialWorks as $initialWork):
					echo "<div class=\"col-sm-2\">";
						$this->App->showMiniWorkWithDetailsInteresting($is_of_age, $initialWork);
						echo "<br /><br />";
					echo "</div>";
				endforeach;
				?>
			</div>
			
			<div class="text-right">
				<?php
				echo $this->Html->link(
				    'more &rarr;',
				    array('controller' => 'works', 'action' => 'initial'),
				    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
				);
				?>
			</div>
		</div>
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-8">
		
		<h3>
			<?php
			echo "News";
			?>
		</h3>
		
		<?php
		$latestNews = $this->requestAction('/news/latestNews');
		
		foreach($latestNews as $latestNews):
			echo "<div class=\"media\">";
				echo "<div class=\"media-left\">";
					echo $this->App->showAvatarMediaObject($latestNews['Author']['id'], $latestNews['Author']['is_avatar']);
				echo "</div>";
				echo "<div class=\"media-body\">";
					echo "<h4 class=\"media-heading\">";
						echo $this->Html->link(
						    $latestNews['News']['title'],
						    array('controller' => 'news', 'action' => 'view', $latestNews['News']['id'])
						);
						echo "<br />";
						echo "<small>";
							echo $this->App->formatLevel($latestNews['Author']['level'], $latestNews['Author']['master_level']).''.$latestNews['Author']['username'];
							echo " | ".$latestNews['News']['date']."";
						echo "</small>";
					echo "</h4>";
				echo "</div>";
			echo "</div>";
		endforeach;
		?>
		
		<br />
		<div class="text-right">
			<?php
			echo $this->Html->link(
			    'more &rarr;',
			    array('controller' => 'news', 'action' => 'index'),
			    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
			);
			?>
		</div>
		
	</div>
	<div class="col-sm-4">
		
		<h3>
			<?php
			echo "Recent on forum";
			?>
		</h3>
		
		<?php
		echo $this->element('homeForum');
		?>
		<br />
		<div class="text-right">
			<?php
			echo $this->Html->link(
			    'more &rarr;',
			    array('controller' => 'forums', 'action' => 'index'),
			    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
			);
			?>
		</div>
		
	</div>
</div>