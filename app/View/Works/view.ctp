<?php
$this->set("title_for_layout", "".$work['Work']['title']." - ".$work['User']['name']." ".$work['User']['surname']." (".$work['User']['username'].")");
?>


<div class="row">
	<div class="col-sm-7">
		<h3>
		<?php
			echo $work['Work']['title'];
			
			echo " | ";
			
			echo $this->App->formatLevel($user['User']["level"], $user['User']["master_level"]);
			echo $user['User']["username"];
			
			echo "<br />";
			
			echo "<small>";
				echo $work['Category']['title'];
				echo " | ";
				echo "views: ";
				echo $work['Work']['work_views'];
			echo "</small>";
			?>
		</h3>
	</div>
	<div class="col-sm-5">
		<h3>Description</h3>
		<?php
		echo $work['Work']['description'];
		?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<?php
		echo $this->Html->link(
		    '&larr; back to the user details',
		    array('controller' => 'users', 'action' => 'view', $work['User']['id']),
		    array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false)
		);
		
		?>
		<br />
		<br />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		
		<div class="row">
			<div class="col-xs-0 col-sm-1">
				
			</div>
			<div class="col-xs-3 col-sm-2">
				<?php
				if($first['Work']['id'] == $work['Work']['id']){
					echo "<span role=\"button\" class=\"btn btn-default btn-xs\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span> first</span>";
				} else {
					echo $this->Html->link('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> first', array('controller' => 'works', 'action' => 'view', $first['Work']['id']), array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
				}
				?>
			</div>
			<div class="col-xs-3 col-sm-2">
				<?php
				if($prev == null){
					echo "<span role=\"button\" class=\"btn btn-default btn-xs\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span> previous</span>";
				} else {
					echo $this->Html->link('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> previous', array('controller' => 'works', 'action' => 'view', $prev['Work']['id']), array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
				}
				?>
			</div>
			<div class="col-xs-0 col-sm-2">
				
			</div>
			<div class="col-xs-3 col-sm-2">
				<div class="text-right">
					<?php
					if($next == null){
						echo "<span role=\"button\" class=\"btn btn-default btn-xs\">next <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></span>";
					} else {
						echo $this->Html->link("next <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>", array('controller' => 'works', 'action' => 'view', $next['Work']['id']), array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
					}
					?>
				</div>
			</div>
			<div class="col-xs-3 col-sm-2">
				<div class="text-right">
					<?php
					if($last['Work']['id'] == $work['Work']['id']) {
						echo "<span role=\"button\" class=\"btn btn-default btn-xs\">last <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span><span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></span>";
					} else {
						echo $this->Html->link("last <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span><span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>", array('controller' => 'works', 'action' => 'view', $last['Work']['id']), array('class' => 'btn btn-default btn-xs', 'role' => 'button', 'escape' => false));
					}
					?>
				</div>
			</div>
			<div class="col-xs-0 col-sm-1">
				
			</div>
		</div>
		
		<br />
		<?php
		if ($work['Work']['is_for_of_age'] == 1 AND ($is_of_age == 0 OR $is_of_age == 1)){
			echo $this->Html->image("osiemnascie_400.gif", array('alt' => $work['Work']['title'], 'class' => 'img-responsive center-block'));
		} else {
			echo $this->Html->image('works/'.$work['User']['id'].'/'.$work['Work']['file_name'], array('alt' => $work['Work']['title'], 'class' => 'img-responsive center-block', 'style' => 'max-height: 90vh;', 'id' => 'work'));
		}
		
		echo '<br /><div class=\'text-center\'>';
			echo '<div class=\'btn btn-default btn-xs\' role=\'button\' id=\'btn-change-h\'>';
				echo 'view this work in original size';
			echo '</div>';
		echo '</div>';
		
		?>
		
		<script>
			
			$( "#btn-change-h" ).click(function() {
				if ($( "#btn-change-h" ).text() == "view this work in smaller size"){
					$( "#work" ).css( "max-height", "90vh" );
					$( "#btn-change-h" ).text( "view this work in original size" );
				} else {
					$( "#work" ).css( "max-height", "" );
					$( "#btn-change-h" ).text( "view this work in smaller size" );
				}
			});
			
		</script>
		
		<?php
		
		
		if(isset($user_id) AND $work['User']['id'] <> $user_id){
			
			if($work['Work']['date'] >= $wotw_week['WorksOfTheWeeksWeek']['date_start'] AND 
				$work['Work']['date'] <= $wotw_week['WorksOfTheWeeksWeek']['date_end'] AND 
				$user_votes_count < 3 AND 
				$user_votes_count_for_this_work == 0) {
				echo "<br />";
				echo "<div class=\"text-center\">";
					echo $this->Form->postLink('nominate to the works of the week', array('controller' => 'WorksOfTheWeeks', 'action' => 'add', $work['Work']['id']), array('escape' => false, 'class' => 'btn btn-success', 'role' => 'button'));
				echo "</div>";
			}
		}
		
		
		if($entree == null AND $level > 2){
			?>
			<div class="row">
				<div class="col-sm-3">
					
				</div>
				<div class="col-sm-6">
					<?php
					echo $this->Form->create('Entree',
						array('action' => 'add',
							'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
								'label' => false,
								'div' => 'form-group',
								'class' => 'form-control',
								'required' => false)));
					
					echo "<br /><h4>Entree</h4>";
					
					echo $this->Form->input('description', array('type' => 'text', 'rows' => '7',
						'label' => array('text' => 'Description', 'class' => 'control-label')));
					
					echo $this->Form->input('moderator_id', array('type' => 'hidden', 'value' => $user_id));
					echo $this->Form->input('work_id', array('type' => 'hidden', 'value' => $work['Work']['id']));
					echo $this->Form->input('destination_date', array('type' => 'hidden', 'value' => '0000-00-00'));
					echo $this->Form->input('is_waiting', array('type' => 'hidden', 'value' => '1'));
					echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $work['User']['id']));
					echo $this->Form->input('file_name', array('type' => 'hidden', 'value' => $work['Work']['file_name']));
					
					echo $this->Form->end(array('label' => 'Add as entree', 'class' => 'btn btn-primary'));
					?>
				</div>
				<div class="col-sm-3">
					
				</div>
			</div>
			<?php
		}
		
		
		if(!($work_votes == null)){
			echo "<br /><div class=\"alert alert-success\"><strong>Work of the week:</strong><br />".$work_votes['WorksOfTheWeek']['date']." | votes: ".$work_votes['WorksOfTheWeek']['votes']."";
			echo "</div>";
		}
		
		
		if($entree != null AND $entree['Entree']['is_waiting'] == 0){
			echo "<br /><div class=\"alert alert-success\"><strong>Entree:</strong><br />".$entree['Entree']['destination_date']." | moderator: ";
			echo $this->Html->link($entree['Moderator']['username'], array('controller' => 'users', 'action' => 'view', $entree['Moderator']['id']));
			echo "<br />";
			echo "".$entree['Entree']['description']."</div>";
		}
		
		
		?>
		
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-4">
		<h3>Add comment</h3>
		
		<?php
		echo $this->element('workAddComment', array('commentWorkUserId' => $work['Work']['user_id'], 'commentWorkId' => $work['Work']['id']));
		?>
		<br />
	</div>
	
	<div class="col-sm-8">
		<h3>Comments</h3>
		
		<?php
		foreach($workComments as $workComment):
			$this->App->showComment($workComment, "work");
		endforeach;
		?>
		<br />
		<?php
		echo $this->element('paginator');
		?>
	</div>
</div>