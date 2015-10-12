<?php
$this->set("title_for_layout", "Gallery - ".$user['User']['name']." ".$user['User']['surname']." (".$user['User']['username'].")");
?>

<div class="row">
	<div class="col-sm-12">
		<?php
		echo $this->element('sideUserDetails_BS', array("userFromURL" => $this->params['pass'][0]));
		?>
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
			echo $this->element('userTopLinks', array("userFromURL" => $user['User']['id'], "gcvViewed" => "1"));
			?>
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<h3>Prace</h3>
		
		<?php
		echo $this->element('userViewWorks');
		?>
		
		<div class="text-right">
			<?php
			echo $this->Html->link(
			    'all works &rarr;',
			    array('controller' => 'works', 'action' => 'user', $user['User']['id']),
			    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
			);
			?>
		</div>
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-sm-4">
		<h3>Add comment</h3>
		
		<?php
		echo $this->element('userAddComment');
		?>
		<br />
	</div>
	
	<div class="col-sm-8">
		<h3>Comments</h3>
		
		<?php
		echo $this->element('userViewComments');
		?>
		<br />
		<div class="text-right">
			<?php
			echo $this->Html->link(
			    'all comments &rarr;',
			    array('controller' => 'comments', 'action' => 'user', $user['User']['id']),
			    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
			);
			?>
		</div>
	</div>
</div>