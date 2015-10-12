<?php
$this->set("title_for_layout", "Favorite users/galleries");
?>


<div class="row">
	<div class="col-sm-12">
		
		<h3>
			Favorite users/galleries
		</h3>
		<br />
		<?php
			foreach ($likeGalleries as $likeGallery):
				
				echo "<div class=\"media\">";
					echo "<div class=\"media-left\">";
						echo $this->App->showAvatarMediaObject($likeGallery['Like']['id'], $likeGallery['Like']['is_avatar']);
					echo "</div>";
					echo "<div class=\"media-body\">";
						echo $this->App->formatLevel($likeGallery['Like']['level'], $likeGallery['Like']['master_level']);
						echo $this->Html->link(
						    $likeGallery['Like']['username'],
						    array(
						        'controller' => 'users',
						        'action' => 'view',
						        $likeGallery['Like']['id']
						    )
						);
						echo " ";
						echo $this->Form->postLink('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array('action' => 'delete', $likeGallery['LikeGallery']['id']), array('escape' => false), ('Do you really want to remove this user from favorite list?'));
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