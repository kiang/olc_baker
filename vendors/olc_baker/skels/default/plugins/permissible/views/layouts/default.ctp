<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Modified by Robert Sworder for the Permissible Plugin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       permissible
 * @subpackage    permissible.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link(__('CakePHP: the rapid development php framework', true), 'http://cakephp.org'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<div class="index"><?php echo $content_for_layout; ?></div>

			<div class="actions">

				<h3>Menu</h3>
				<ul>
					<li><?php echo $this->Html->link('Home', array('plugin' => 'permissible', 'controller' => 'permissible', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Manage by user', array('plugin' => 'permissible', 'controller' => 'aros', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Manage by action', array('plugin' => 'permissible', 'controller' => 'acos', 'action' => 'index')); ?></li>
<?php if (Configure::read('debug') > 0) { ?>
					<li><?php echo $this->Html->link('Reset ACL', array('plugin' => 'permissible', 'controller' => 'permissible', 'action' => 'reset')); ?></li>
<?php } ?>
<?php foreach ($actions_for_layout as $title => $url) { ?>
				<li><?php echo $this->Html->link($title, $url); ?></li>
<?php } ?>
				</ul>

			</div>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
