<?php
$this->set("title_for_layout", "Password recovery");
?>

<div class="row">
	<div class="col-sm-8">
		<h3>
			Password recovery
		</h3>
		<br />
		
		<?php
		if (isset($user_id)){
			echo "<div class=\"alert alert-success\" role=\"alert\">";
				echo "You are already logged in.";
			echo "</div>";
		} else {
			echo $this->Session->flash();
			
			echo $this->Form->create('User',
				array('action' => 'passwordRecovery',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo $this->Form->input('username', array('type' => 'string', 'label' => array('text' => 'Please enter your nick/login', 'class' => 'control-label'), 'style' => 'width: 300px;'));
			echo "<br />";
			echo $this->Form->end(array('label' => 'Send me the news password', 'class' => 'btn btn-primary'));
		}
		echo "<br /><br />";
		?>
		
		<br /><br />
	</div>
	<div class="col-sm-4">
		<?php
		echo $this->element('sideNewWorks');
		?>
	</div>
</div>