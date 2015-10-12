<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="color: #a9a9a9;" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="loginLabel">Login</h4>
			</div>
			<div class="modal-body">
				<?php
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
				echo "<br />";
				echo $this->Html->link('password recovery?', array('controller' => 'users', 'action' => 'passwordRecovery'));
				echo " | ";
				echo $this->Html->link('registration', array('controller' => 'users', 'action' => 'register'));
				?>
			</div>
		</div>
	</div>
</div>