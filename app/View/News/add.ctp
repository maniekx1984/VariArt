<?php
$this->set("title_for_layout", "Add news");
?>


<div class="row">
	<div class="col-sm-12">
		<h3>
			Add news
		</h3>
		<br /><br />
		<?php
		if(isset($user_id)){
			
			echo $this->Session->flash();
			
			echo $this->Form->create('News',
				array('action' => 'add',
					'type' => 'post',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo "<strong>All fields are required.</strong><br /><br />";
			
			echo $this->Form->input('title', array('type' => 'string', 'label' => array('text' => 'Topic', 'class' => 'control-label')));
			
			echo "<br />";
			echo $this->Form->input('source', array('type' => 'string', 'label' => array('text' => 'Source', 'class' => 'control-label')));
			
			echo "<br />";
			echo $this->Form->input('lead', array('type' => 'text', 'rows' => '8', 'label' => array('text' => 'Lead', 'class' => 'control-label')));
			
			echo "<br />";
			echo $this->Form->input('n_text', array('type' => 'text', 'rows' => '15', 'label' => array('text' => 'Contents', 'class' => 'control-label')));
			
			echo "<br />";
			echo $this->Form->end(array('label' => 'Add news', 'class' => 'btn btn-primary'));
			
		}
		?>
	
		<br /><br />
	</div>
</div>