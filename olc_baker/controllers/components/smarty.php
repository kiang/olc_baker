<?php
App::import('vendor', 'smarty', array('file' => 'Smarty.class.php'));
class SmartyComponent extends Smarty {
	function __construct () {
		$this->template_dir = VENDORS . 'oa-tools' . DS . 'templates' . DS;
		$this->compile_dir = TMP . 'smarty' . DS . 'compile' . DS;
		$this->cache_dir = TMP . 'smarty' . DS . 'cache' . DS;
		$this->left_delimiter = '<{';
		$this->right_delimiter = '}>';
	}
}