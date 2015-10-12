<?php
$this->set('title_for_layout', 'My news');
?>


<div class="row">
	<div class="col-sm-12">
		
		<h3>
			My news
		</h3>
		<br />
		<?php
		foreach($news as $news):
			echo "<div class=\"media\">";
				echo "<div class=\"media-left\">";
					echo $this->App->showAvatarMediaObject($news['Author']['id'], $news['Author']['is_avatar']);
				echo "</div>";
				echo "<div class=\"media-body\">";
					echo "<h4 class=\"media-heading\">";
						echo $this->Html->link(
						    $news['News']['title'],
						    array('controller' => 'news', 'action' => 'view', $news['News']['id'])
						);
						echo "<br />";
						echo "<small>";
							echo $this->App->showNewsStatus($news);
						echo "</small>";
					echo "</h4>";
					if($news['News']['is_activated'] == 0){
						echo $this->Html->link('Add image to this news', array('controller' => 'newsFiles', 'action' => 'add', $news['News']['id']));
					}
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