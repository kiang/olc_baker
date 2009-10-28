<?php
class Form extends AppModel {

	var $name = 'Form';
	var $validate = array(
		'project_id' => array('numeric'),
		'name' => array('notempty'),
		'label' => array('notempty')
	);

	var $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
	    )
	);

	var $hasMany = array(
		'FormField' => array(
			'className' => 'FormField',
			'foreignKey' => 'form_id',
	    ),
	    'Relationship' => array(
	        'className' => 'Relationship',
	        'foreignKey' => 'form_id_base',
	    ),
	    'Action' => array(
	        'className' => 'Action',
			'foreignKey' => 'form_id',
	    ),
	);

}