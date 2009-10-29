<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<{$projectLabel}>::
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');
		echo $html->css('default');
		echo $javascript->link('jquery');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $html->link('<{$projectLabel}>', '/'); ?></h1>
		</div>
		<div id="content">
		<div class="actions">
			<ul>
				<?php if($session->read('Auth.Member.id')): ?>
				<{foreach from=$controllers key=key item=item}>
				<li><?php echo $html->link('<{$item}>', '/admin/<{$key}>'); ?></li>
				<{/foreach}>
				<li><?php echo $html->link('使用者', '/admin/members'); ?></li>
				<li><?php echo $html->link('群組', '/admin/groups'); ?></li>
				<li><?php echo $html->link('登出', '/members/logout'); ?></li>
				<?php else: ?>
				<li><?php echo $html->link('登入', '/members/login'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
			<?php $session->flash(); ?>
			<div id="viewContent"><?php echo $content_for_layout; ?></div>
		</div>
		<div id="footer">
			<?php echo $html->link(
					$html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
					'http://www.cakephp.org/',
					array('target'=>'_blank'), null, false
				);
			?>
			系統提供：<?php echo $html->link('就這間電腦工作室', 'http://olc.tw/', array('target'=>'_blank')); ?>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>