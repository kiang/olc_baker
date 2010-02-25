<?php
App::import('vendor', 'smarty', array('file' => 'Smarty.class.php'));
class Project extends AppModel {

	var $name = 'Project';
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
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->smarty = new Smarty;
		$this->smarty->template_dir = VENDORS . 'olc_baker' . DS . 'templates' . DS;
		$this->smarty->compile_dir = TMP . 'smarty' . DS . 'compile' . DS;
		$this->smarty->cache_dir = TMP . 'smarty' . DS . 'cache' . DS;
		$this->smarty->left_delimiter = '<{';
		$this->smarty->right_delimiter = '}>';
	}
	
	var $tasks = array();
	var $errorMessage = '';
	
	function fetchProject($projectId) {
		return $this->find('first', array(
		    'conditions' => array('Project.id' => $projectId),
		    'contain' => array(
		        'Form' => array(
		        	'FormField' => array(
		                'order' => array('sort ASC'),
		            ),
		            'Relationship' => array(
		                'fields' => array('type'),
		                'TargetForm' => array(
		                    'fields' => array('name'),
		                ),
		            ),
		            'Action' => array(
		                'fields' => array('name', 'action', 'engine', 'parameters'),
		            ),
		        ),
		    ),
		));
	}
	
	/**
	 * Make sure if the $appPath exists and copy the skel to there
	 * @param string $appPath
	 */
	function initialAppPath($appPath) {
		$fh = new Folder();
		if(file_exists($appPath)) {
			if(false === $fh->delete($appPath)) {
				$this->errorMessage = __('Target path exists. But the program could not delete the folder automatically', true);
				return false;
			} else {
				$this->tasks[] = array(
		            'title' => __('Target path exists. Delete the old folders.', true),
		            'operactions' => $fh->messages(),
				);
			}
			$fh->__messages = array();
		}
		
		/*
		 * Copy the skelecton of the application
		 */
		$fh->copy(array(
			'to' => $appPath,
			'from' => VENDORS . 'olc_baker' . DS . 'skels' . DS . 'default',
			'mode' => 0777,
		));
		$errors = $fh->errors();
		if(!empty($errors)) {
			$this->errorMessage = __('The program could not copy files to the folder automatically', true);
			return false;
		} else {
			$this->tasks[] = array(
		    	'title' => __('Copy the skelecton of application to the target path', true),
		    	'operactions' => $fh->__messages,
			);
		}
		return true;
	}

}