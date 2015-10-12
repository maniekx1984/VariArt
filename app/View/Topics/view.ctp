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
			
			echo "<li>";
			echo $this->Html->link($forum['Forum']['name'],
				array('controller'=>'topics', 'action'=>'index', $forum['Forum']['id']));
			echo "</li>";
			
			echo "<li class=\"active\">";
			echo $topic['Topic']['name'];
			echo "</li>";
			
		echo "</ol>";
		
		
		echo $this->Html->link(('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add post'),
			array('controller'=>'posts', 'action'=>'add', $topic['Topic']['id']),
			array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
		?>
		<br /><br />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<div class="list-group">
			
			<?php
			
			if(strlen($topic['Topic']['content']) > 1){
				
				echo "<div class='list-group-item'>";
					
					echo '<div class="row">';
						
						echo '<div class="col-sm-2">';
							echo "<div class=\"media\">";
								echo "<div class=\"media-left\">";
									echo $this->App->showAvatarForum($post['User']['id'], $post['User']['is_avatar']);
								echo "</div>";
								echo "<div class=\"media-body\">";
									echo $this->Html->link(''.$this->App->formatLevel($post['User']['level'], $post['User']['master_level']).''.$post['User']['username'].'',
										array('controller' => 'users', 'action' => 'view', $post['User']['id']),
										array('escape' => false));
									echo "<br />";
									echo "<small>";
										echo $post['Post']['created'];
									echo "</small>";
								echo "</div>";
							echo "</div>";
						echo '</div>';
						
						echo '<div class="col-sm-10">';
							echo nl2br($post['Post']['content']);
						echo '</div>';
						
					echo '</div>';
					
				echo "</div>";
				
			}
			
			foreach ($posts as $post):
				
				echo "<div class='list-group-item'>";
					
					echo '<div class="row">';
						
						echo '<div class="col-sm-2">';
							echo "<div class=\"media\">";
								echo "<div class=\"media-left\">";
									echo $this->App->showAvatarForum($post['User']['id'], $post['User']['is_avatar']);
								echo "</div>";
								echo "<div class=\"media-body\">";
									echo $this->Html->link(''.$this->App->formatLevel($post['User']['level'], $post['User']['master_level']).''.$post['User']['username'].'',
										array('controller' => 'users', 'action' => 'view', $post['User']['id']),
										array('escape' => false));
									echo "<br />";
									echo "<small>";
										echo $post['Post']['created'];
									echo "</small>";
								echo "</div>";
							echo "</div>";
						echo '</div>';
						
						echo '<div class="col-sm-10">';
							echo nl2br($post['Post']['content']);
						echo '</div>';
						
					echo '</div>';
					
				echo "</div>";
				
			endforeach;
			
			?>
			
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Add post
		</h3>
		<?php
		if(isset($user_id)){
			echo $this->Form->create('Post', array('action' => 'add',
			'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
				'label' => false,
				'div' => 'form-group',
				'class' => 'form-control',
				'required' => false)));
			
			echo $this->Form->input('content', array('type' => 'text',
				'rows' => '10'));
			
			echo $this->Form->hidden('topic_id', array('value' => $topic['Topic']['id']));
	        echo $this->Form->hidden('forum_id', array('value' => $forum['Forum']['id']));
			echo "<br />";
			echo $this->Form->end(array('label' => 'Add', 'class' => 'btn btn-primary'));
			
		} else {
			echo "Please log in to add new post.<br />";
		}
		?>
	</div>
</div>