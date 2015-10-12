<?php
$this->set('title_for_layout', 'Add topic');
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Add topic
		</h3>
		<br />
		<?php
		if(isset($user_id)){
			echo $this->Form->create('Topic', array(
			'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
				'label' => false,
				'div' => 'form-group',
				'class' => 'form-control',
				'required' => false)));
			
			
			echo $this->Form->input('name', array('type' => 'string',
					'label' => array('text' => 'Title', 'class' => 'control-label')));
			
			echo "<br />";
			
			echo $this->Form->input('content', array('type' => 'text',
				'rows' => '15',
				'label' => array('text' => 'Contents', 'class' => 'control-label')));
				
			
			echo "<br /><br />";
			echo $this->Form->input('forum_id', array('options' => $forums,
			'label' => array('text' => 'Forum section', 'class' => 'control-label')));
			echo "<br />";
			echo $this->Form->end(array('label' => 'Add', 'class' => 'btn btn-primary'));
		}
		?>
	
		<br /><br />
	</div>
</div>