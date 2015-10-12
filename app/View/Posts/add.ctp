<?php
$this->set('title_for_layout', 'Add post');
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Add post
		</h3>
		<?php
		if(isset($user_id)) {
			echo $this->Html->link('Forum',
						array('controller'=>'forums', 'action'=>'index'));
			echo " > ";
			echo $this->Html->link($forum['Forum']['name'],
				array('controller'=>'topics', 'action'=>'index', $forum['Forum']['id']));
			echo " > ";
			echo $this->Html->link($topic['Topic']['name'],
				array('controller'=>'topics', 'action'=>'view', $topic['Topic']['id']));
			?>
			<br /><br />
			<?php
			if(isset($user_id)){
				
				echo $this->Form->create('Post', array(
				'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
					'label' => false,
					'div' => 'form-group',
					'class' => 'form-control',
					'required' => false)));
				
				echo $this->Form->input('content', array('type' => 'text',
					'rows' => '15',
					'label' => array('text' => 'Contents', 'class' => 'control-label')));
				
				echo $this->Form->hidden('topic_id', array('value' => $topic['Topic']['id']));
		        echo $this->Form->hidden('forum_id', array('value' => $forum['Forum']['id']));
				echo "<br />";
				echo "<br />";
				echo $this->Form->end(array('label' => 'Add', 'class' => 'btn btn-primary'));
				
			}
		} else {
			echo "Please log in to add new post.<br />";
		}
		?>
	
		<br /><br />
	</div>
</div>