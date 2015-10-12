<?php
if(isset($user_id)) {
	echo $this->Form->create('NewsComment',
		array('action' => 'add',
			'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
				'label' => false,
				'div' => 'form-group',
				'class' => 'form-control',
				'required' => false)));
	
	echo $this->Form->input('c_text',
		array('type' => 'text', 'rows' => '8'));
	
	echo $this->Form->input('news_id', array('type' => 'hidden', 'value' => $commentNewsId));
	echo $this->Form->input('news_author_id', array('type' => 'hidden', 'value' => $commentNewsAuthorId));
	
	echo $this->Form->end(array('label' => 'Add comment', 'class' => 'btn btn-primary'));
} else {
	echo "You need to log in.<br />";
}
?>