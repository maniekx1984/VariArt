<?php
echo $this->Html->docType('html5');
$pageSubTitle = "VariArt";
?>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php
			echo $title_for_layout;
		?>
	</title>
	
	<?php
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap_custom');
		
		echo $this->Html->meta(
		    'keywords',
		    ''
		);
		echo $this->Html->meta(
		    'description',
		    ''
		);
		
		
		echo $this->Html->script("jquery-1.11.3.min");
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('bootstrap_custom');
   		
	?>
</head>

<body>
<?php
echo $this->element('modalSearch');
echo $this->element('headerLoginForm');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#homeNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
      		<?php
				echo $this->Html->image('logo2_n.png', array(
				    "alt" => "VariArt",
				    'url' => "/",
				    'class' => 'navbar-brand'
				));
			?>
		</div>
		<?php echo $this->element('headerMenu'); ?>
	</div>
</nav>

<div class="container" style="background-color: #232220;">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->element('cookiesAcceptation'); ?>
		</div>
	</div>
	<?php
	if($blocked == 1) {
		echo "<div class=\"row\">";
			echo "<div class=\"col-sm-12\">";
				echo "Your account has been blocked.";
			echo "</div>";
		echo "</div>";
	} else {
		echo $this->fetch('content');
	}
	?>
	<div class="row">
		<div class="col-sm-12">
			<hr />
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->element('homeDownContent'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->element('footer'); ?>
		</div>
	</div>
</div>
</body>
</html>