<?php
$this->set("title_for_layout", "Message");
?>

<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
			echo $this->element('messagesTopLinks', array("gcvViewed" => "1"));
			?>
		</ul>
		<h3>
			Message
		</h3>
		<br />
		
		<?php
		echo "<h4>";
			echo "Topic";
		echo "</h4>";
		echo $message['Message']['title'];
		
		echo "<br /><br />";
		echo "<h4>";
			echo "Sender";
		echo "</h4>";
		echo $message['Mfrom']['username'];
		
		echo "<br /><br />";
		echo "<h4>";
			echo "Contents";
		echo "</h4>";
		echo nl2br($message['Message']['m_text']);
		
		echo "<br /><br />";
		echo "<h4>";
			echo "Reply";
		echo "</h4>";
		
		echo $this->Form->create('Message', array('action' => 'add',
			'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
				'label' => false,
				'div' => 'form-group',
				'class' => 'form-control',
				'required' => false)));
		
		echo $this->Form->input('mtos', array('value' => $message['Mfrom']['id'], 'type' => 'hidden'));
		
		echo "<br />";
		echo $this->Form->input('title', array('value' => $message['Message']['title'], 'type' => 'string', 'label' => array('text' => 'Topic', 'class' => 'control-label')));
		
		echo "<br />";
		echo $this->Form->input('m_text', array('type' => 'text', 'rows' => '20', 'label' => array('text' => 'Contents', 'class' => 'control-label')));
		
		echo "<br /><br />";
		
		echo $this->Form->end(array('label' => 'Send', 'class' => 'btn btn-primary'));
		?>
	</div>
</div>