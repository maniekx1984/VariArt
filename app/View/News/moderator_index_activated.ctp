<?php
$this->set('title_for_layout', 'News');
?>

<div class="row">
	<div class="col-sm-12">
		
		<h3>
			Accepted news
		</h3>
		<br />
		<?php
		if($level > 2){
			foreach($news as $news):
				echo "<div class=\"media\">";
					echo "<div class=\"media-left\">";
						echo $this->App->showAvatarMediaObject($news['Author']['id'], $news['Author']['is_avatar']);
					echo "</div>";
					echo "<div class=\"media-body\">";
						echo "<h4 class=\"media-heading\">";
							echo $this->Html->link(
							    $news['News']['title'],
							    array('controller' => 'news', 'action' => 'moderatorView', $news['News']['id'])
							);
							echo "<br />";
							echo "<small>";
								echo $this->App->formatLevel($news['Author']['level'], $news['Author']['master_level']).''.$news['Author']['username'];
								
								echo " | ".$news['News']['date']."";
							echo "</small>";
						echo "</h4>";
					echo "</div>";
				echo "</div>";
			endforeach;
		}
		echo "<br />";
		
		echo $this->element('paginator');
		?>
		
	</div>
</div>