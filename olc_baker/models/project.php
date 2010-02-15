<?php
class project extends AppModel {

	var $name = 'project';
	var $validate = array(
		'name' => array('notempty'),
		'label' => array('notempty'),
		'rewrite_base' => array('notempty'),
		'app_path' => array('notempty')
	);

	var $hasMany = array(
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'project_id',
			'dependent' => false,
	    )
	);

}