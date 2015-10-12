<?php
$this->set("title_for_layout", "Adding the work");
?>

<div class="row">
	<div class="col-sm-8">
		<h3>
			Adding the work
		</h3>
		<br />
		<?php
		if(isset($user_id)){
			
			echo $this->Session->flash();
			
			if($user['User']['level'] == 0 AND $allWorks >= 40){
				echo "<div class=\"alert alert-danger\" role=\"alert\">You can not add the work - as the user from Initial Gallery you can have max 40 works in your gallery.</div>";
			} else {
				if(($user['User']['level'] == 0 AND $todayWorks >= 1) OR ($user['User']['level'] > 0 AND $todayWorks >= 2)) {
					echo "<div class=\"alert alert-danger\" role=\"alert\">You used your daily limit of work upload.</div>";
				} else {
					
					echo $this->Form->create('Work',
						array('action' => 'add',
							'type' => 'file',
							'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
								'label' => false,
								'div' => 'form-group',
								'class' => 'form-control',
								'required' => false)));
					
					echo $this->Form->input('file', array('type' => 'file', 'class' => false, 'label' => array('text' => 'Choose file')));
					
					echo "<br />";
					echo $this->Form->input('title', array('type' => 'string', 'label' => array('text' => 'Title', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('description', array('type' => 'text', 'rows' => '8', 'label' => array('text' => 'Description', 'class' => 'control-label')));
					
					echo "<br />";
					echo $this->Form->input('category_id', array('label' => array('text' => 'Category', 'class' => 'control-label')));
					
					echo "<br />";
					echo "<div class=\"checkbox\">";
						echo "<label>";
							echo $this->Form->input('is_for_of_age', array('div' => false, 'class' => false, 'label' => false));
							echo "18 years work?";
						echo "</label>";
					echo "</div>";
					
					
					echo "<br />";
					echo "By adding the work in the gallery you declare that this work is your authorship, your ownership and you have all nessesery rights to the elements used in this work.<br /><br />";
					echo $this->Form->end(array('label' => 'Add work', 'class' => 'btn btn-primary'));
					
				}
			}
			
		}
		?>
	
		<br /><br />
	</div>
	
	<div class="col-sm-4">
		<br />
		<br />
		<strong>Note:</strong>
		<ul>
			<li>max file weight: 500KB</li>
			<li>daily upload limit: 2 (Main Gallery); 1 (Initial Gallery)</li>
			<li>max works in Initial Gallery user gallery: 40</li>
			<li>JPG only</li>
		</ul>
	</div>
</div>