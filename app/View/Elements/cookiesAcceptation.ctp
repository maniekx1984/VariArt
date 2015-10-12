<br />
<?PHP
if(is_null($cookiepolicy)){
	echo "<div class=\"alert alert-info\">";
		echo("This website uses cookies to ensure you get the best experience on our website. ");
		echo $this->Html->link(
		    'Privacy policy',
		    '/pages/privacy_policy'
		);
		echo ". [";
		echo $this->Html->link(
		    'Close',
		    array('controller' => 'cookiepolicy', 'action' => 'acceptation')
		);
		echo "]<br />";
	echo "</div>";
}
?>