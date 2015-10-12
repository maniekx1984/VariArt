<?php
$this->set("title_for_layout", "Login");
?>

<div class="row">
	<div class="col-sm-8">
		<h3>
			Login
		</h3>
		<br />
		<?php
		if (isset($user_id)){
			echo "<div class=\"alert alert-success\" role=\"alert\">";
				echo "You are already logged in.";
			echo "</div>";
		} else {
			echo $this->Session->flash('auth');
			
			echo "<div class=\"row\">";
				echo "<div class=\"col-sm-7\">";
					echo $this->Form->create('User', array('action' => 'login',
						'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
							'label' => false,
							'div' => 'form-group',
							'class' => 'form-control',
							'required' => false)));
					
					
					echo $this->Form->input('username', array('type' => 'string',
					'label' => array('text' => 'Nick/login', 'class' => 'control-label')));
					echo "<br />";
					echo $this->Form->input('password', array(
					'label' => array('text' => 'Password', 'class' => 'control-label')));
					
					
					echo "<br />";
					echo $this->Form->end(array('label' => 'Login', 'class' => 'btn btn-primary'));
				echo "</div>";
				echo "<div class=\"col-sm-5\">";
					
				echo "</div>";
			echo "</div>";
			
			echo "<br />";
			echo $this->Html->link('password recovery', array('controller' => 'users', 'action' => 'passwordRecovery'));
			echo " | ";
			echo $this->Html->link('registration', array('controller' => 'users', 'action' => 'register'));
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