<?php
$this->set("title_for_layout", "Edit the user");
?>


<div class="row">
	<div class="col-sm-12">
		<h3>
			Edit the user
		</h3>
		<br />
		<?php
		
		if($level > 2) {
			echo $this->Session->flash();
			
			echo $this->Form->create('User',
				array('action' => 'moderatorEdit',
					'type' => 'post',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo $this->Form->input('id', array('type' => 'hidden'));
			
			if($level == 4){
				echo $this->Form->input('username', array('type' => 'string', 'label' => array('text' => 'Nick', 'class' => 'control-label')));
				echo "<br />";
			}
			
			echo $this->Form->input('name', array('type' => 'string', 'label' => array('text' => 'Name', 'class' => 'control-label')));
			echo "<br />";
			echo $this->Form->input('surname', array('type' => 'string', 'label' => array('text' => 'Surname', 'class' => 'control-label')));
			
			echo "<br /><br />";
			echo $this->Form->input('email', array('type' => 'string', 'label' => array('text' => 'E-mail', 'class' => 'control-label')));
			echo "<div class=\"checkbox\">";
				echo "<label>";
					echo $this->Form->checkbox('is_visible_email', array('div' => false, 'class' => false, 'label' => false));
					echo "E-mail visible on the page";
				echo "</label>";
			echo "</div>";
			
			
			echo "<br /><br />";
			echo $this->Form->input('webpage', array('type' => 'string', 'label' => array('text' => 'Webpage<br />http://', 'class' => 'control-label')));
			
			echo "<br /><br />";
			echo $this->Form->input('description', array('type' => 'text', 'rows' => '8', 'label' => array('text' => 'Description', 'class' => 'control-label')));
			
			echo "<br /><br />";
			$options = array('0' => 'No choose', '1' => 'No', '2' => 'Yes');
			
			echo $this->Form->input('is_of_age', array(
			    'options' => $options,
			    'default' => $this->Form->value('User.is_of_age'),
			    'label' => array('text' => '18 years?', 'class' => 'control-label')
			));
			
			echo "<br /><br />";
			$options_levels = array('0' => 'Initial gallery', '1' => 'Main gallery', '2' => 'Main gallery - deserved', '3' => 'Main gallery - moderator', '4' => 'Main gallery - administrator');
			echo $this->Form->input('level', array(
			    'options' => $options_levels,
			    'default' => $this->Form->value('User.level'),
			    'label' => array('text' => 'Level/gallery', 'class' => 'control-label')
			));
			
			echo "<div class=\"checkbox\">";
				echo "<label>";
					echo $this->Form->checkbox('master_level', array('div' => false, 'class' => false, 'label' => false));
					echo "The master";
				echo "</label>";
			echo "</div>";
			
			echo "<br />";
			echo "<div class=\"checkbox\">";
				echo "<label>";
					echo $this->Form->checkbox('blocked', array('div' => false, 'class' => false, 'label' => false));
					echo "Blocked user";
				echo "</label>";
			echo "</div>";
			
			echo "<br />";
			echo $this->Form->end(array('label' => 'Save', 'class' => 'btn btn-primary'));
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">No permission.</div>";
		}
		
		?>
	
		<br /><br />
	</div>
</div>