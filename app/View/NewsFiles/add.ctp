<?php
$this->set("title_for_layout", "Adding image to the news");
?>

<div class="row">
	<div class="col-sm-12">
		
		<h3>
			Adding image to the news
		</h3>
		<br />
		<?php
		if(isset($user_id) AND !($newsFilesCount >= 2) AND $news['News']['is_activated'] == 0) {
			echo $this->Session->flash();
			
			echo $this->Form->create('NewsFiles',
				array('action' => 'add/'.$this->params['pass'][0].'',
					'type' => 'file',
					'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
						'label' => false,
						'div' => 'form-group',
						'class' => 'form-control',
						'required' => false)));
			
			echo $this->Form->input('file', array('type' => 'file', 'class' => false, 'label' => array('text' => 'To the news you can add max two images (JPG, 2 MB, max 600 px of width)')));
			
			
			echo "<br />";
			echo $this->Form->end(array('label' => 'Add image', 'class' => 'btn btn-primary'));
		} else {
			echo $this->Session->flash();
			
			echo "You can't add another image to this news.<br />";
			echo $this->Html->link('Back', array('controller' => 'news', 'action' => 'indexMy'));
		}
		?>
		
	</div>
</div>