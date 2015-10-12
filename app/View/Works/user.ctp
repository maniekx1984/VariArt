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
			echo $this->element('userTopLinks', array("userFromURL" => $user['User']['id'], "gcvViewed" => "2"));
			?>
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<br />
		<?php
		echo $this->element('userViewWorks');
		?>
		
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<?php
		echo $this->element('paginator');
		?>
		
	</div>
</div>