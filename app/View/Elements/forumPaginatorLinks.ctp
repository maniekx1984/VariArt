<?php

echo "<ul class=\"pagination\">";
	echo $this->Paginator->prev('<< prev', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
	echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'modulus' => '4'));
	echo $this->Paginator->next('next >>', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
echo "</ul>";
?>