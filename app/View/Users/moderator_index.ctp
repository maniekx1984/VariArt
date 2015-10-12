<?php
$this->set("title_for_layout", "Users");
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Users
		</h3>
		<br />
		<?php
		if($level > 2) {
			
			echo "<h4>Choose the user</h4>";
			
			echo $this->Form->create('User',
				array('action' => 'moderatorIndex',
					'class' => 'form-inline',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			
			echo $this->Form->input('mtos');
			echo " ";
			echo $this->Form->end(array('label' => 'Edit', 'class' => 'btn btn-primary', 'div' => false));
			echo "<br /><br />";
			?>
			
			
			<div class="table-responsive">
				<?php
				echo "<table class=\"table table-hover table-bordered\">";
					echo "<thead>";
						echo "<tr>";
							echo "<th>User</th>";
							echo "<th>Edit</th>";
							echo "<th>Remove</th>";
						echo "</tr>";
					echo "</thead>";
					
					echo "<tbody>";
						foreach ($users as $user):
							echo "<tr>";
								echo "<td>";
									
									
									echo $this->Html->link(
										''.$this->App->formatLevel($user['User']['level'], $user['User']['master_level']).''.$user['User']['username'].'',
										array(
											'controller' => 'users',
											'action' => 'view',
											$user['User']['id']),
										array('escape' => false));
									
								echo "</td>";
								
								echo "<td>";
									echo $this->Html->link(
										'edit',
										array(
											'controller' => 'users',
											'action' => 'moderatorEdit',
											$user['User']['id']));
								echo "</td>";
								echo "<td>";
									echo "TODO :(";
								echo "</td>";
							echo "</tr>";
						endforeach;
					echo "<tbody>";
					
				echo "</table>";
				?>
			</div>
			
			<?php
			echo $this->element('paginator');
		}
		?>
		
	</div>
</div>