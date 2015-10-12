<?php
$this->set("title_for_layout", "Sent message");
?>

<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<?php
			echo $this->element('messagesTopLinks', array("gcvViewed" => "2"));
			?>
		</ul>
		<h3>
			Sent message
		</h3>
		<br />
		
		<?php
		echo "<h4>";
			echo "Topic";
		echo "</h4>";
		echo $message['Message']['title'];
		
		echo "<br /><br />";
		echo "<h4>";
			echo "Recipient";
		echo "</h4>";
		echo $message['Mto']['username'];
		
		echo "<br /><br />";
		echo "<h4>";
			echo "Contents";
		echo "</h4>";
		echo nl2br($message['Message']['m_text']);
		
		?>
	</div>
</div>