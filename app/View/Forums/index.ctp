<?php
$this->set('title_for_layout', 'Forum');
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Forum
		</h3>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<div class="list-group">
			
			<?php
			
			foreach ($forums as $forum):
				
				$postCount = count($forum['Post']);
				
				echo "<div class='list-group-item'>";
				
					echo '<div class="row">';
						
						echo '<div class="col-sm-6">';
							echo $this->Html->link('<h4 class="list-group-item-heading">'.$forum['Forum']['name'].'</h4>',
			                    array('controller' => 'topics', 'action' => 'index', $forum['Forum']['id']),
			                    array('escape'=>false));
							echo '<div class=\'list-group-item-text\'>'.$forum['Forum']['description'].'</div><br />';
						echo '</div>';
						
						echo '<div class="col-sm-3 col-xs-6">';
							echo '<div class=\'list-group-item-text\'>';
								echo '<div class=\'list-group-item-text\'>Posts: '.$postCount.'</div>';
							echo '</div>';
						echo '</div>';
						
						echo '<div class="col-sm-3 col-xs-6">';
							echo '<div class=\'list-group-item-text\'>';
								echo '<div class=\'list-group-item-text\'>Latest post: <br />'.$this->Html->link($forum['Post'][$postCount-1]['created'], array('controller'=>'topics', 'action'=>'view', $forum['Post'][$postCount-1]['topic_id'])).'</div>';
							echo '</div>';
						echo '</div>';
						
					echo '</div>';
				
				echo "</div>";
			endforeach;
			
			?>
			
		</div>
		
	</div>
</div>