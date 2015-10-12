<?php
$this->set("title_for_layout", "Blocked users");
?>


<div class="row">
	<div class="col-sm-12">
		
		<h3>
			Blocked users
		</h3>
		<br />
		<?php
			foreach ($dontLikeGalleries as $dontLikeGallery):
				
				echo "<div class=\"media\">";
					echo "<div class=\"media-left\">";
						echo $this->App->showAvatarMediaObject($dontLikeGallery['Dontlike']['id'], $dontLikeGallery['Dontlike']['is_avatar']);
					echo "</div>";
					echo "<div class=\"media-body\">";
						echo $this->App->formatLevel($dontLikeGallery['Dontlike']['level'], $dontLikeGallery['Dontlike']['master_level']);
						echo $this->Html->link(
						    $dontLikeGallery['Dontlike']['username'],
						    array(
						        'controller' => 'users',
						        'action' => 'view',
						        $dontLikeGallery['Dontlike']['id']
						    )
						);
						echo " ";
						echo $this->Form->postLink('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array('action' => 'delete', $dontLikeGallery['DontLikeGallery']['id']), array('escape' => false), ('Do you want to remove this user from blocked users list?'));
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