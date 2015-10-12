<?php
$this->set("title_for_layout", "Entrees");
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Entrees
		</h3>
		<br />
		<?php
		if($level > 2) {
			
			if($entreesWaitingCount == 0){
				echo "<div class=\"alert alert-danger\" role=\"alert\">";
					echo "Warning: There are no new Entrees!";
				echo "</div>";
			}
			
			?>
			
			<div class="table-responsive">
				<?php
				echo "<table class=\"table table-hover table-bordered\">";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Work</th>";
							echo "<th>Published?</th>";
							echo "<th>Moderator</th>";
							echo "<th>Remove</th>";
						echo "</tr>";
					echo "</thead>";
					
					echo "<tbody>";
						foreach ($entrees as $entree):
							echo "<tr>";
								echo "<td>";
									echo $this->Html->link($entree['Work']['title'], array('controller' => 'works', 'action' => 'view', $entree['Work']['id']));
								echo "</td>";
								
								echo "<td>";
									if($entree['Entree']['is_waiting'] == 0) {
										echo "YES";
									} else if($entree['Entree']['is_waiting'] == 1){
										echo "NO";
									}
								echo "</td>";
								
								echo "<td>";
									echo $entree['Moderator']['username'];
								echo "</td>";
								
								echo "<td>";
									echo $this->Form->postLink(('Remove'), array('action' => 'delete', $entree['Entree']['id']), array(), ('Do you really want to remove this entree?'));
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