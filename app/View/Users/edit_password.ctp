<?php
$this->set("title_for_layout", "Edit the password");
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Edit the password
		</h3>
		<br />
		<?php
		
		if($user_id == $this->params['pass'][0]) {
			echo $this->Session->flash();
			
			echo $this->Form->create('User',
				array('action' => 'editPassword',
					'type' => 'post',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->input('email', array('type' => 'hidden'));
			
			echo $this->Form->input('old_password', array('type' => 'password', 'label' => array('text' => 'Current password', 'class' => 'control-label')));
			echo "<br />";
			echo $this->Form->input('password', array('type' => 'password', 'value' => '', 'label' => array('text' => 'New password', 'class' => 'control-label')));
			echo "<br />";
			echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => array('text' => 'Confirm new password', 'class' => 'control-label')));
			
			echo "<br /><br />";
			echo $this->Form->end(array('label' => 'Change password', 'class' => 'btn btn-primary'));
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">No permission.</div>";
		}
		
		?>
	
		<br /><br />
	</div>
</div>