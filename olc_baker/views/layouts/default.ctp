<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		olc_baker
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		echo $html->css('cake.generic');
		echo $html->script('jquery');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $html->link('olc_baker', '/'); ?></h1>
		</div>
		<div id="content">
			<?php $session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">
		<?php
		echo $html->link(
		    $html->image('cake.power.gif', array(
		    	'alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")
		    ), 'http://www.cakephp.org/', array('target'=>'_blank'), null, false
		);
		echo ' & ' . $html->link('Just This Computer Studio', 'http://olc.tw/', array('target'=>'_blank'));
		?>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>