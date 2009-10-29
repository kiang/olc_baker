<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/views/layouts/default.ctp */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo '<?php'; ?>
 echo $html->charset(); <?php echo '?>'; ?>

	<title>
		<?php echo $this->_tpl_vars['projectLabel']; ?>
::
		<?php echo '<?php'; ?>
 echo $title_for_layout; <?php echo '?>'; ?>

	</title><?php echo '<?php'; ?>

	echo $html->meta('icon');
	echo $html->css('screen', NULL, array('media' => 'screen, projection'));
	echo $html->css('print', NULL, array('media' => 'print'));
	echo '<!--[if IE]>';
	echo $html->css('ie', NULL, array('media' => 'screen, projection'));
	echo '<![endif]-->';
	echo $html->css('default');
	echo $html->script('jquery');
	echo $scripts_for_layout;
	<?php echo '?>'; ?>

</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo '<?php'; ?>
 echo $html->link('<?php echo $this->_tpl_vars['projectLabel']; ?>
', '/'); <?php echo '?>'; ?>
</h1>
		</div>
		<div id="content">
		<div class="actions">
			<ul>
				<?php echo '<?php'; ?>
 if($session->read('Auth.Member.id')): <?php echo '?>'; ?>

				<?php $_from = $this->_tpl_vars['controllers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<li><?php echo '<?php'; ?>
 echo $html->link('<?php echo $this->_tpl_vars['item']; ?>
', '/admin/<?php echo $this->_tpl_vars['key']; ?>
'); <?php echo '?>'; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
				<li><?php echo '<?php'; ?>
 echo $html->link('使用者', '/admin/members'); <?php echo '?>'; ?>
</li>
				<li><?php echo '<?php'; ?>
 echo $html->link('群組', '/admin/groups'); <?php echo '?>'; ?>
</li>
				<li><?php echo '<?php'; ?>
 echo $html->link('登出', '/members/logout'); <?php echo '?>'; ?>
</li>
				<?php echo '<?php'; ?>
 else: <?php echo '?>'; ?>

				<li><?php echo '<?php'; ?>
 echo $html->link('登入', '/members/login'); <?php echo '?>'; ?>
</li>
				<?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

			</ul>
		</div>
			<?php echo '<?php'; ?>
 $session->flash(); <?php echo '?>'; ?>

			<div id="viewContent"><?php echo '<?php'; ?>
 echo $content_for_layout; <?php echo '?>'; ?>
</div>
		</div>
		<div id="footer">
			<?php echo '<?php'; ?>
 echo $html->link(
					$html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
					'http://www.cakephp.org/',
					array('target'=>'_blank'), null, false
				);
			<?php echo '?>'; ?>

			系統提供：<?php echo '<?php'; ?>
 echo $html->link('就這間電腦工作室', 'http://olc.tw/', array('target'=>'_blank')); <?php echo '?>'; ?>

		</div>
	</div>
	<?php echo '<?php'; ?>
 echo $cakeDebug; <?php echo '?>'; ?>

</body>
</html>