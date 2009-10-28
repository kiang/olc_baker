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

	function getProjectTypeList() {
	    $sourcePath = VENDORS . 'oa-tools' . DS . 'project_types' . DS;
	    $fh = new Folder($sourcePath);
	    $files = $fh->ls();
	    $list = array();
	    foreach($files[1] AS $fileName) {
	        $pathInfo = pathinfo($fileName);
	        $fileContent = include($sourcePath . $fileName);
	        $list[$pathInfo['filename']] = $fileContent['name'];
	    }
	    return $list;
	}

	function getProjectTypeContent($typeName, $id = null) {
	    $sourcePath = VENDORS . 'oa-tools' . DS . 'project_types' . DS;
	    $fileContent = array();
	    if(file_exists($sourcePath . $typeName . '.php')) {
	        $fileContent = include($sourcePath . $typeName . '.php');
	    } else {
	        return '';
	    }
	    if(!empty($id) && !empty($fileContent['options'])) {
	        $options = unserialize($this->field('options', array('Project.id' => $id)));
	        if(!empty($options)) {
	            foreach($fileContent['options'] AS $optionGroup => $optionItems) {
	                foreach($optionItems AS $key => $formValue) {
	                    if(!empty($options[$optionGroup][$key])) {
	                        $fileContent['options'][$optionGroup][$key]['value'] = $options[$optionGroup][$key];
	                    }
	                }
	            }
	        }
	    }
	    return $fileContent;
	}

}