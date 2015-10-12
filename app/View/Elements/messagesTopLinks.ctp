<?php
echo "<li role=\"presentation\"";
	if ($gcvViewed == 1) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("Inbox", array('controller' => 'messages', 'action' => 'inbox'));
echo "</li>";

echo "<li role=\"presentation\"";
	if ($gcvViewed == 2) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("Sent", array('controller' => 'messages', 'action' => 'sent'));
echo "</li>";

echo "<li role=\"presentation\"";
	if ($gcvViewed == 3) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("New message", array('controller' => 'messages', 'action' => 'add'));
echo "</li>";
?>