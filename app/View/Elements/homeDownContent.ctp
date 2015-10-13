<strong>On-line</strong><br />
<?php
$onlineUsers = $this->requestAction('/users/online');
foreach($onlineUsers as $onlineUser):
	echo $this->Html->link(''.$this->App->formatLevel($onlineUser['User']['level'], $onlineUser['User']['master_level']).''.$onlineUser['User']['username'].'', array('controller' => 'users', 'action' => 'view', $onlineUser['User']['id']), array('escape' => false));
	echo " ";
endforeach;
?>
<br /><br />