<?php 
/* SVN FILE: $Id$ */
/* OaTools schema generated on: 2009-03-04 15:03:17 : 1236152897*/
class OaToolsSchema extends CakeSchema {
	var $name = 'OaTools';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $form_fields = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'form_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
			'sort' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'label' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'type' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'options' => array('type' => 'text', 'null' => true, 'default' => NULL),
			'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'form_id' => array('column' => 'form_id', 'unique' => 0))
		);
	var $forms = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'label' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'project_id' => array('column' => 'project_id', 'unique' => 0))
		);
	var $projects = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'label' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'rewrite_base' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'app_path' => array('type' => 'string', 'null' => false, 'default' => NULL),
			'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
}
?>