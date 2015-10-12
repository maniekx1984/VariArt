<?php
$this->set("title_for_layout", "Sent messages");
?>

<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
			echo $this->element('messagesTopLinks', array("gcvViewed" => "2"));
			?>
		</ul>
		<h3>
			Sent messages
		</h3>
		<br />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
			
			<?php
			
			foreach ($messages as $message):
				
				echo '<div class="list-group">';
					echo "<div class='list-group-item'>";
						
						echo '<div class="row">';
							
							echo '<div class="col-sm-2">';
								echo "<div class=\"media\">";
									echo "<div class=\"media-left\">";
										echo $this->App->showAvatarForum($message['Mto']['id'], $message['Mto']['is_avatar']);
									echo "</div>";
									echo "<div class=\"media-body\">";
										echo $this->Html->link(''.$this->App->formatLevel($message['Mto']['level'], $message['Mto']['master_level']).''.$message['Mto']['username'].'',
											array('controller' => 'users', 'action' => 'view', $message['Mto']['id']),
											array('escape' => false));
										echo "<br />";
										echo "<small>";
											echo $message['Message']['date'];
										echo "</small>";
									echo "</div>";
								echo "</div>";
							echo '</div>';
							
							echo '<div class="col-sm-8">';
								echo $this->Html->link('<h4 class="list-group-item-heading">'.$message['Message']['title'].'</h4>', array('controller' => 'messages', 'action' => 'viewSent', $message['Message']['id']), array('escape' => false));
								
							echo '</div>';
							
							echo '<div class="col-sm-2">';
								echo 'Read:<br />';
								if($message['Message']['is_read'] == "0") {
									echo "NO";
								} elseif($message['Message']['is_read'] == "1") {
									echo "YES";
								}
								
							echo '</div>';
							
						echo '</div>';
						
					echo "</div>";
				echo '</div>';
				
			endforeach;
			
			?>
		
		<?php
		echo $this->element('paginator');
		?>
			
	</div>
</div>