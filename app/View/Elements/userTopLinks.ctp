<?php
echo "<li role=\"presentation\"";
	if ($gcvViewed == 1) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("Home", array('controller' => 'users', 'action' => 'view', $userFromURL));
echo "</li>";

echo "<li role=\"presentation\"";
	if ($gcvViewed == 2) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("All works", array('controller' => 'works', 'action' => 'user', $userFromURL));
echo "</li>";

echo "<li role=\"presentation\"";
	if ($gcvViewed == 3) {
		echo " class=\"active\"";
	}
	echo ">";
	echo $this->Html->link("All comments", array('controller' => 'comments', 'action' => 'user', $userFromURL));
echo "</li>";
?>