<?php
$this->set("title_for_layout", "Register");
?>

<div class="row">
	<div class="col-sm-12">
		<h3>
			Register
		</h3>
		<br />
		<?php
		if($level > 2) {
			
			?>
			
			<div class="table-responsive">
				<?php
				echo "<table class=\"table table-hover table-bordered\">";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Moderator</th>";
							echo "<th>Action</th>";
							echo "<th>Description</th>";
							echo "<th>Date</th>";
							echo "<th>Time</th>";
						echo "</tr>";
					echo "</thead>";
					
					echo "<tbody>";
						foreach ($registers as $register):
							echo "<tr>";
								echo "<td>";
									echo $register['Moderator']['username'];
								echo "</td>";
								
								echo "<td>";
									echo $register['Register']['action'];
								echo "</td>";
								
								echo "<td>";
									echo $register['Register']['description'];
								echo "</td>";
								
								echo "<td>";
									echo $register['Register']['date'];
								echo "</td>";
								
								echo "<td>";
									echo $register['Register']['time'];
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