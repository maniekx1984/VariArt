<?php
$this->set("title_for_layout", "Registration");
?>

<div class="row">
	<div class="col-sm-8">
		<h3>
			Registration
		</h3>
		<br />
		<?php
		if (isset($user_id)) {
			echo "<div class=\"alert alert-success\" role=\"alert\">";
				echo "You are already registred.";
			echo "</div>";
		} else {
			
			
			
			echo $this->Session->flash();
			
			echo "<div class=\"row\">";
				echo "<div class=\"col-sm-8\">";
					echo $this->Form->create('User', array('action' => 'register',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
					'label' => false,
					'div' => 'form-group',
					'class' => 'form-control',
					'required' => false)));
					
					echo $this->Form->input('email', array('type' => 'string',
					'label' => array('text' => 'E-mail', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('username', array('type' => 'string',
						'label' => array('text' => 'Nick / Login', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('password', array('label' => array('text' => 'Password', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('confirm_password', array('type' => 'password',
					'label' => array('text' => 'Confirm password', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('description', array('type' => 'text',
					'rows' => '8',
					'label' => array('text' => 'Description', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('people_verification', array('type' => 'string',
					'label' => array('text' => 'Please verify that you are a human, enter the number of human legs', 'class' => 'control-label'),
					'style' => 'width: 50px;'));
					
					echo "<br />By clicking Register, you acknowledge that you have read and agree to the ";
					echo $this->Html->link(
					    'Terms &amp; Conditions',
					    '/pages/terms_conditions',
					    array('target' => '_blank')
					);
					echo ".<br /><br />";
				echo "</div>";
				echo "<div class=\"col-sm-4\">";
					
				echo "</div>";
			echo "</div>";
			
			
			
			echo $this->Form->end(array('label' => 'Register', 'class' => 'btn btn-primary'));
		}
		?>
		<br /><br />
	</div>
	<div class="col-sm-4">
		<?php
		echo $this->element('sideNewWorks');
		?>
	</div>
</div>