<?php
$this->Paginator->options(array(
	'update' => '#paginator_ajax_content',
	'evalScripts' => true
));
echo $this->Paginator->counter('Number of results: {:count}');
echo "<br />";
echo "<ul class=\"pagination\">";
	//echo $this->Paginator->counter('Liczba wyników: {:count}');
	echo $this->Paginator->prev('<< prev', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
	echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'modulus' => '4'));
	echo $this->Paginator->next('next >>', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
echo "</ul>";

echo $this->Js->writeBuffer();
?>