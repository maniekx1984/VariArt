<?php
$this->set('title_for_layout', 'Forum');
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Forum
		</h3>
		<?php
		echo "<ol class=\"breadcrumb\">";
			
			echo "<li>";
			echo $this->Html->link('Forum',
				array('controller'=>'forums', 'action'=>'index'));
			echo "</li>";
			
			echo "<li class=\"active\">";
			echo $forum['Forum']['name'];
			echo "</li>";
			
		echo "</ol>";
		
		echo $this->Html->link(('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add new topic'),
			array('action'=>'add'),
			array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
		?>
		<br /><br />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<div class="list-group">
			
			<?php
			
			foreach ($topics as $topic):
				$postCount = count($topic['Post']);
				
				echo "<div class='list-group-item'>";
					
					echo '<div class="row">';
						
						echo '<div class="col-sm-6">';
							echo $this->Html->link('<h4 class="list-group-item-heading">'.$topic['Topic']['name'].'</h4>',
								array('controller'=>'topics', 'action'=>'view', $topic['Topic']['id']),
								array('escape'=>false));
						echo '</div>';
						
						echo '<div class="col-sm-3 col-xs-6">';
							echo '<div class=\'list-group-item-text\'>';
								echo 'Posty: '.$postCount;
							echo '</div>';
						echo '</div>';
						
						echo '<div class="col-sm-3 col-xs-6">';
							echo '<div class=\'list-group-item-text\'>';
								if($postCount > 0) {
									echo 'Last post: <br />'; 
									$post = $topic['Post'][$postCount-1];
									if(!empty($post['User']['id'])){
										echo $this->Html->link($post['User']['username'], array('controller' => 'users',
											'action' => 'view',
											$post['User']['id']));
									}
									echo "<br /><small>";
									echo $post['created'];
									echo "</small>";
				                }
							echo '</div>';
						echo '</div>';
						
					echo '</div>';
					
					
				echo "</div>";
				
			endforeach;
			
			?>
			
		</div>
		
	</div>
</div>