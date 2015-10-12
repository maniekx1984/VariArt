<?php
$this->set('title_for_layout', 'News');
?>

<div class="row">
	<div class="col-sm-8">
		
		<h3>
			News
		</h3>
		<br />
		<?php
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
						echo $this->App->formatLevel($news['Author']['level'], $news['Author']['master_level']).''.$news['Author']['username'];
						
						echo " | ".$news['News']['date']." | Źródło: ".$news['News']['source']."";
					echo "</small>";
				echo "</h4>";
			echo "</div>";
		echo "</div>";
		
		echo "<br />";
		
		echo nl2br($news['News']['lead']);
		
		echo "<br /><br />";
		
		echo nl2br($news['News']['n_text']);
		
		if($newsFilesCount > 0){
			echo "<br /><br />";
			
			echo "<div class=\"row\">";
			foreach($newsFiles as $newsFile):
				$filename_array = explode('.', $newsFile['NewsFile']['file_name']);
				$ext = end($filename_array);
				$ext = strtolower($ext);
				$clearFileName = $filename_array[0];
				
				
				echo "<div class=\"col-sm-6\">";
					echo $this->Html->tag('img', null, array('class' => 'img-rounded img-responsive', 'src' => 'http://variart.org/img/news/'.$newsFile['NewsFile']['file_name'].''));
				echo "</div>";
			endforeach;
			echo "</div>";
		}
		?>
		<br />
		<h3>Add comment</h3>
		
		<?php
		echo $this->element('newsAddComment', array('commentNewsAuthorId' => $news['Author']['id'], 'commentNewsId' => $news['News']['id']));
		?>
		<br />
		<h3>Comments</h3>
		<?php
		foreach($newsComments as $newsComment):
			$this->App->showComment($newsComment, "news");
		endforeach;
		
		echo $this->element('paginator');
		?>
		
	</div>
	
	<div class="col-sm-4">
		<?php
		echo $this->element('sideNewWorks');
		?>
	</div>
</div>