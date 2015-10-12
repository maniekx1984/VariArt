<?php
$this->set("title_for_layout", "Send message");
?>

<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
			echo $this->element('messagesTopLinks', array("gcvViewed" => "3"));
			?>
		</ul>
		<h3>
			Send message
		</h3>
		<br />
		
		<?php
		echo $this->Session->flash();
		
		echo $this->Form->create('Message', array('action' => 'add',
			'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
				'label' => false,
				'div' => 'form-group',
				'class' => 'form-control',
				'required' => false)));
		
		echo $this->Form->input('mtos', array('label' => array('text' => 'Adresat', 'class' => 'control-label')));
		
		echo "<br />";
		echo $this->Form->input('title', array('type' => 'string', 'label' => array('text' => 'Topic', 'class' => 'control-label')));
		
		echo "<br />";
		echo $this->Form->input('m_text', array('type' => 'text', 'rows' => '20', 'label' => array('text' => 'Contents', 'class' => 'control-label')));
		
		echo "<br /><br />";
		
		echo $this->Form->end(array('label' => 'Send', 'class' => 'btn btn-primary'));
		?>
	</div>
</div>