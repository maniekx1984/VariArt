<h3>
	<?php
	echo "Entree ";
	
            echo $this->Html->link(
                '',
                '#collapseHeaderEntree',
                array('data-toggle' => 'collapse', 'aria-expanded' => 'true', 'aria-controls' => 'collapseHeaderEntree', 'escape' => false, 'class' => 'btn btn-default btn-xs home-toggle', 'role' => 'button')
            );
	
	?>
</h3>
<div class="collapse in" id="collapseHeaderEntree">
	
	<?php
	$headerEntree = $this->requestAction('/entrees/headerEntree');
	
	
	
	
	$headerEntreeImg = 'osiemnascie_dg.gif';
	if ($headerEntree['Work']['is_for_of_age'] == 1 AND $is_of_age == 0){
		$headerEntreeImg = 'osiemnascie_dg.gif';
	} else {
		$headerEntreeImg = 'dg/'.$headerEntree['Work']['User']['id'].'_BIG_'.$headerEntree['Work']['file_name'].'';
	}
	
	$headerEntreeImg = $this->Html->image($headerEntreeImg, array('class' => 'img-responsive'));
	
	echo $this->Html->link($headerEntreeImg, array('controller' => 'works', 'action' => 'view', $headerEntree['Work']['id']), array('escapeTitle' => false));
	
		echo "<h5>".$headerEntree['Work']['title']."<br /><small>";
		$headerEntreeUser = $this->App->formatLevel($headerEntree['Work']['User']['level'], $headerEntree['Work']['User']['master_level']) . $headerEntree['Work']['User']['username'].'';
		
		echo $this->Html->link(
		$headerEntreeUser,
		array('controller' => 'users', 'action' => 'view', $headerEntree['Work']['User']['id']),
		array('escapeTitle' => false));
		
		echo "</small></h5>";
	
	?>
	
	<div class="text-right">
		<?php
		echo $this->Html->link(
		    'more &rarr;',
		    array('controller' => 'entrees', 'action' => 'index'),
		    array('class' => 'btn btn-default', 'role' => 'button', 'escape' => false)
		);
		?>
	</div>
</div>