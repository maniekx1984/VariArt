<div class="row">
	<div class="col-sm-5">
		<?php
		echo "<div class=\"media\">";
			echo "<div class=\"media-left\">";
				echo $this->App->showPhoto($user['User']["id"], $user['User']["is_photo"]);
			echo "</div>";
			echo "<div class=\"media-body\">";
				echo "<h3 class=\"media-heading\">";
					echo $this->App->formatLevel($user['User']["level"], $user['User']["master_level"]);
					echo $user['User']["username"];
					
					echo " ";
					
					if(isset($user_id) AND $user_id <> $user['User']["id"]){
						
						$likeGalleries = $this->requestAction("likeGalleries/checkIfLike/".$user['User']["id"]."");
						if($likeGalleries > 0){
							echo "<span data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Favorite user\" class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span>";
						} else {
							echo $this->Form->postLink('<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>',
								array('controller' => 'LikeGalleries', 'action' => 'add', $user['User']["id"]),
								array('escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Add to favorite users'));
						}
					}
					
					echo " ";
					
					if(isset($user_id) AND $user_id <> $user['User']["id"]){
						
						$dontLikeGalleries = $this->requestAction("dontLikeGalleries/checkIfDontLike/".$user['User']["id"]."");
						if($dontLikeGalleries > 0){
							echo "<span data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Blocked user\" class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span>";
						} else {
							echo $this->Form->postLink('<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>',
								array('controller' => 'DontLikeGalleries', 'action' => 'add', $user['User']["id"]),
								array('escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Block user'));
						}
					}
					
					
					if(strlen($user['User']['name']) > 0 OR strlen($user['User']['surname']) > 0){
						echo "<br /><small>";
							echo $user['User']['name'];
							echo " ";
							echo $user['User']['surname'];
						echo "</small>";
					}
				echo "</h3>";
				
			echo "</div>";
		echo "</div>";
		?>
	</div>
	<div class="col-sm-3">
		<h4>Contact user</h4>
		<?php
		if ($user['User']['is_visible_email'] == 1){
			echo "<strong>E-mail</strong><br />";
			echo $user['User']['email'];
			echo "<br /><br />";
		}
		if(strlen($user['User']['webpage']) > 0){
			echo "<strong>Webpage</strong><br />";
			echo $this->Html->link($user['User']['webpage'], "http://".$user['User']['webpage']."", array('target' => '_blank'));
		}
		?>
	</div>
	<div class="col-sm-4">
		<h4>Description</h4>
		<?php
		echo $user['User']['description'];
		?>
	</div>
</div>