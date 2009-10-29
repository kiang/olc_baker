<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/config/database.php */ ?>
<?php echo '<?php'; ?>

class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => '<?php echo $this->_tpl_vars['db_host']; ?>
',
		'login' => '<?php echo $this->_tpl_vars['db_login']; ?>
',
		'password' => '<?php echo $this->_tpl_vars['db_password']; ?>
',
		'database' => '<?php echo $this->_tpl_vars['db_name']; ?>
',
		'encoding' => 'utf8'
	);
}