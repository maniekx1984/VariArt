<?php
$this->set("title_for_layout", "Work edit");
?>


<div class="row">
	<div class="col-sm-8">
		<h3>
			Work edit
		</h3>
		<br />
		<?php
		if(isset($user_id)) {
			echo $this->Session->flash();
			
			if($work['User']['id'] == $user_id){
				
				echo $this->Form->create('Work',
					array('action' => 'edit',
						'type' => 'file',
						'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
							'label' => false,
							'div' => 'form-group',
							'class' => 'form-control',
							'required' => false)));
				
				echo $this->Form->input('id', array('type' => 'hidden'));
				
				echo "<strong>Current work view</strong><br />";
				
				echo $this->Html->tag('img', null, array('alt' => $work['Work']['title'], 'class' => 'img-responsive center-block', 'src' => 'http://variart.org/img/works/'.$work['User']['id'].'/'.$work['Work']['file_name'].''));
				
				echo "<br /><br />";
				echo $this->Form->input('file', array('type' => 'file', 'class' => false, 'label' => array('text' => 'Choose file if you want to change it')));
				
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
				echo "By adding/editing the work in the gallery you declare that this work is your authorship, your ownership and you have all nessesery rights to the elements used in this work.<br /><br />";
				echo $this->Form->end(array('label' => 'Save changes', 'class' => 'btn btn-primary'));
				
			} else {
				
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
			<li>JPG only</li>
		</ul>
	</div>
</div>