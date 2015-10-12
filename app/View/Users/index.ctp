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
			foreach ($users as $user):
				
				echo "<div class=\"media\">";
					echo "<div class=\"media-left\">";
						echo $this->App->showAvatarMediaObject($user['User']['id'], $user['User']['is_avatar']);
					echo "</div>";
					echo "<div class=\"media-body\">";
						echo $this->App->formatLevel($user['User']['level'], $user['User']['master_level']);
						echo $this->Html->link(
						    $user['User']['username'],
						    array(
						        'controller' => 'users',
						        'action' => 'view',
						        $user['User']['id']
						    )
						);
					echo "</div>";
				echo "</div>";
			endforeach;
		?>
		
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<?php
		echo $this->element('paginator');
		?>
		
	</div>
</div>