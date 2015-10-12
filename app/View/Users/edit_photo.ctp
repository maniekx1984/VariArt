<?php
$this->set("title_for_layout", "Edit the photo");
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Edit the photo
		</h3>
		<br />
		<?php
		
		if($user_id == $this->params['pass'][0]) {
			echo $this->Session->flash();
			
			
			echo $this->Form->create('User',
				array('action' => 'editPhoto',
					'type' => 'file',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->input('email', array('type' => 'hidden'));
			
			
			
			echo "<strong>Current photo</strong><br />";
			echo $this->App->showPhoto($this->request->data['User']['id'], $this->request->data['User']['is_photo']);
			
			echo "<br /><br />";
			echo $this->Form->input('file', array('type' => 'file', 'class' => false, 'label' => array('text' => 'Choose new photo')));
			echo "<div class=\"help-block\">JPG only; max 230px of width.</div>";
			echo "<br /><br />";
			echo $this->Form->end(array('label' => 'Save new photo', 'class' => 'btn btn-primary'));
			
			echo $this->Form->create('User', array('action' => 'deletePhoto', 'type' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => false, 'required' => false)));
			
			echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->input('email', array('type' => 'hidden'));
			
			
			echo "<br /><br />";
			echo $this->Form->end(array('label' => 'Remove current photo', 'class' => 'btn btn-primary'));
			
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">No permission.</div>";
		}
		
		?>
	
		<br /><br />
	</div>
</div>