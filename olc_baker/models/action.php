<?php
class Action extends AppModel {

	var $name = 'Action';
	var $validate = array(
		'action' => array('numeric'),
		'name' => array('notempty'),
	);

	var $belongsTo = array(
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'form_id',
	    )
	);

	function getEngineList() {
	    $sourcePath = VENDORS . 'oa-tools' . DS . 'actions' . DS;
	    $fh = new Folder($sourcePath);
	    $files = $fh->find('.*\.php$');
	    $list = array();
	    foreach($files AS $fileName) {
	        $pathInfo = pathinfo($fileName);
	        $fileContent = include($sourcePath . $fileName);
	        $list[$pathInfo['filename']] = $fileContent['name'];
	    }
	    return $list;
	}

	function getEngineContent($engine) {
	    $sourcePath = VENDORS . 'oa-tools' . DS . 'actions' . DS;
	    $fileContent = array();
	    if(file_exists($sourcePath . $engine . '.php')) {
	        $fileContent = include($sourcePath . $engine . '.php');
	    } else {
	        return '';
	    }
	    return $fileContent;
	}

}