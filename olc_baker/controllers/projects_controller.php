<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $components = array('Smarty');

	function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
		$this->set('forms', $this->paginate($this->Project->Form, array('Form.project_id' => $id)));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Project->create();
			if(!empty($this->data['Project']['option'])) {
		        $this->data['Project']['options'] = serialize($this->data['Project']['option']);
		    }
		    unset($this->data['Project']['option']);
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		    if(!empty($this->data['Project']['option'])) {
		        $this->data['Project']['options'] = serialize($this->data['Project']['option']);
		    }
		    unset($this->data['Project']['option']);
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Project->del($id)) {
			$this->Session->setFlash(__('The data has been deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	/*
	 * References:
	 * http://cakebaker.42dh.com/2007/10/17/pagination-of-data-from-a-habtm-relationship/
	 */
	function build($projectId = null) {
	    if (!$projectId || !$project = $this->Project->fetchProject($projectId)) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		} else {
		    /*
		     * Make sure the target path is writable
		     */
		    if(!is_writable(dirname($project['Project']['app_path']))) {
		        $this->Session->setFlash(__('The target path is not available for writing'));
		        $this->redirect(array('action' => 'index'));
		    }
		    
		    if(false === $this->Project->initialAppPath($project['Project']['app_path'])) {
		    	$this->Session->setFlash($this->Project->errorMessage);
		    	$this->redirect(array('action' => 'index'));
		    }

		    /*
		     * Write the settings
		     */
		    $this->Smarty->assign('rewriteBase', $project['Project']['rewrite_base']);
		    $this->Smarty->assign('rootPath', dirname($project['Project']['app_path']));
		    $this->Smarty->assign('appDir', basename($project['Project']['app_path']));
		    $this->Smarty->assign('cakeIncludePath', CAKE_CORE_INCLUDE_PATH);
		    $this->Smarty->assign('db_host', $project['Project']['db_host']);
		    $this->Smarty->assign('db_login', $project['Project']['db_login']);
		    $this->Smarty->assign('db_password', $project['Project']['db_password']);
		    $this->Smarty->assign('db_name', $project['Project']['db_name']);
		    $files = array(
		        DS . '.htaccess',
		        DS . 'webroot' . DS . '.htaccess',
		        DS . 'config' . DS . 'database.php',
		    );
		    $files[] = DS . 'webroot' . DS . 'index.php';
		    
		    $operactions = array();
		    foreach($files AS $file) {
		        file_put_contents($project['Project']['app_path'] . $file, $this->Smarty->fetch('default' . $file));
		        $operactions[] = $project['Project']['app_path'] . $file . ' created';
		    }
		    $this->Project->tasks[] = array(
		    	'title' => __('Generate the files of settings', true),
		    	'operactions' => $operactions,
		    );

		    /*
		     * Generate the MVC files and fetch the table structures
		     */
		    $controllers = $tables = $models = $operactions = $htbtmModels = array();
		    if(!empty($project['Form'])) {
		        $fieldType = array();
		        $primaryField = array(
		        	'type' => 'integer',
		        	'null' => false,
		        	'default' => NULL,
		        	'length' => 11,
		        	'key' => 'primary',
		        	'primary' => 'id',
		        );
		        $indexField = array(
		            'type' => 'integer',
		            'null' => false,
		            'default' => NULL,
		            'length' => 11,
		        	'key' => 'index',
		        );

		        /*
		         * Confirm the tables and models
		         */
		        foreach($project['Form'] AS $key => $form) {
		            $models[$form['name']]['file_name'] = Inflector::singularize($form['name']);
		            $models[$form['name']]['model_name'] = Inflector::camelize($models[$form['name']]['file_name']);
		            $models[$form['name']]['table_name'] = Inflector::tableize($models[$form['name']]['model_name']);
		            $models[$form['name']]['controller_name'] = Inflector::camelize($models[$form['name']]['table_name']);
		            $models[$form['name']]['label'] = $form['label'];
		            $models[$models[$form['name']]['model_name']] = &$models[$form['name']];
		            foreach($form['Action'] AS $akey => $action) {
		                $project['Form'][$key]['Action'][$akey]['parameters'] = unserialize($action['parameters']);
		            }
		        }

		        /*
		         * Deal with the relationships
		         */
		        foreach($project['Form'] AS $form) {
		            extract($models[$form['name']]);
		            $fields = $uploads = $engines = $fieldTypes = array();

		            $relationships = array();
		            foreach($form['Relationship'] AS $relationship) {
		                if(empty($relationship['TargetForm'])) {
		                    continue;
		                }
		                $rName = $relationship['TargetForm']['name'];
		                $className = $models[$rName]['model_name'];
		                switch($relationship['type']) {
		                    case 'bt':
		                        $type = 'belongsTo';
		                        $keyName = $models[$rName]['file_name'] . '_id';
		                        $relationships[$type][$className]['foreignKey'] = $keyName;
		                        if(!isset($tables[$table_name][$keyName])) {
		                            $tables[$table_name][$keyName] = $indexField;
		                        }
		                        break;
		                    case 'ho':
		                        $type = 'hasOne';
		                        $keyName = $file_name . '_id';
		                        $foreignTable = $models[$rName]['table_name'];
		                        $relationships[$type][$className]['foreignKey'] = $keyName;
		                        if(!isset($tables[$foreignTable][$keyName])) {
		                            $tables[$foreignTable][$keyName] = $indexField;
		                        }
		                        break;
		                    case 'hm':
		                        $type = 'hasMany';
		                        $keyName = $file_name . '_id';
		                        $foreignTable = $models[$rName]['table_name'];
		                        $relationships[$type][$className]['foreignKey'] = $keyName;
		                        $relationships[$type][$className]['dependent'] = 'false';
		                        if(!isset($tables[$foreignTable][$keyName])) {
		                            $tables[$foreignTable][$keyName] = $indexField;
		                        }
		                        break;
		                    case 'habtm':
		                        $type = 'hasAndBelongsToMany';
		                        $joinTables = array($table_name, $models[$rName]['table_name']);
		                        sort($joinTables);
		                        $relationships[$type][$className]['joinTable'] = implode('_', $joinTables);
		                        $relationships[$type][$className]['foreignKey'] = $file_name . '_id';
		                        $relationships[$type][$className]['associationForeignKey'] = $models[$rName]['file_name'] . '_id';
		                        extract($relationships[$type][$className]);
		                        if(!isset($tables[$joinTable])) {
		                            $tables[$joinTable] = array(
		                                'id' => $primaryField,
		                                $foreignKey => $indexField,
		                                $associationForeignKey => $indexField,
		                            );
		                        }
		                        $htbtmModels[$model_name][$className] = Inflector::classify($joinTable);
		                        break;
		                }
		                $relationships[$type][$className]['className'] = $className;
		                if(!isset($labels[$model_name])) {
		                    $labels[$model_name] = $form['label'];
		                }
		            }
		            $models[$form['name']]['relationships'] = $relationships;

		            if(isset($tables[$table_name])) {
		                $tables[$table_name] = array_merge(array('id' => $primaryField), $tables[$table_name]);
		            } else {
		                $tables[$table_name]['id'] = $primaryField;
		            }

		            $validate = array();
		            foreach($form['FormField'] AS $formField) {
		                if(!isset($fieldType[$formField['type']])) {
		                    $fieldType[$formField['type']] = include(VENDORS . 'olc_baker' . DS . 'field_types' . DS . $formField['type'] . '.php');
		                }
		                $formField['options'] = unserialize($formField['options']);
		                if(!empty($formField['options']['form'])) {
		                    $fields[$model_name][$formField['name']] = $formField['options']['form'];
		                }
		                $fields[$model_name][$formField['name']]['label'] = $formField['label'];
		                $fieldTypes[$model_name][$formField['name']]['function_type'] = $formField['function_type'];
		                $fieldTypes[$model_name][$formField['name']]['function_string'] = $formField['function_string'];
		                if(!empty($fieldType[$formField['type']]['formType'])) {
		                    $fields[$model_name][$formField['name']]['type'] = $fieldType[$formField['type']]['formType'];
		                    switch($formField['type']) {
		                        case 'file':
		                            $uploads[$formField['name']] = 'file';
		                            break;
		                        case 'file_image':
		                            $uploads[$formField['name']] = 'image';
		                            break;
		                    }
		                }
		                $tables[$table_name][$formField['name']] = array(
		                    'type' => $fieldType[$formField['type']]['schemaType'],
		                    'null' => !$formField['is_required'],
		                    'default' => NULL,
		                );
		                if(!empty($fieldType[$formField['type']]['validate'])) {
		                    $validate[$formField['name']] = $fieldType[$formField['type']]['validate'];
		                }
		                if($formField['is_required']) {
		                    $validate[$formField['name']]['notEmpty'] = array(
		                        'rule' => '\'notEmpty\'',
		                        'message' => '\'This field is required\'',
		                    );
		                }
		            }
		            $models[$form['name']]['fields'] = $fields;
		            $models[$form['name']]['fieldTypes'] = $fieldTypes;
		            $models[$form['name']]['uploads'] = $uploads;
		            $models[$form['name']]['validate'] = $validate;
		        }

		        /*
		         * Write the files of models, controllers, views
		         */
		        foreach($project['Form'] AS $form) {
		            extract($models[$form['name']]);

		            $controllers[$table_name] = $form['label'];

		            $this->Smarty->assign('relationships', $relationships);
		            $this->Smarty->assign('models', $models);
		            $this->Smarty->assign('modelName', $model_name);
		            $this->Smarty->assign('uploads', $uploads);
		            $this->Smarty->assign('modelFields', $tables[$table_name]);
		            $this->Smarty->assign('htbtmModels', $htbtmModels);
		            $this->Smarty->assign('modelFileName', $file_name);
		            $this->Smarty->assign('controllerName', $controller_name);

		            file_put_contents(
		                $project['Project']['app_path'] . DS . 'models' . DS . $file_name . '.php',
		                $this->Smarty->fetch('default' . DS . 'models' . DS . 'default.php')
		            );
		            $operactions[] = $project['Project']['app_path'] . DS . 'models' . DS . $file_name . '.php created';

		            $viewPath = $project['Project']['app_path'] . DS . 'views' . DS . $table_name . DS;
		            if(!file_exists($viewPath)) {
		                mkdir($viewPath, 0777, true);
		            }
		            $operactions[] = $viewPath . ' created';
		            $this->Smarty->assign('formLabel', $form['label']);
		            $this->Smarty->assign('fields', $fields);
		            $this->Smarty->assign('fieldTypes', $fieldTypes);
		            $formOptions = array();
		            if(!empty($uploads)) {
		                $formOptions['type'] = 'file';
		            }
		            $this->Smarty->assign('formOptions', $formOptions);
		            $actions = array(
		            	'admin_add.ctp',
		            	'admin_edit.ctp',
		            	'admin_index.ctp',
		            	'admin_view.ctp',
		            	'admin_form.ctp',
		                'view.ctp',
		            );
		            if(!empty($relationships['hasAndBelongsToMany'])) {
		                $actions[] = 'admin_habtm_set.ctp';
		            }
		            foreach($actions AS $action) {
		                file_put_contents(
		                    $viewPath . $action,
		                    $this->Smarty->fetch('default' . DS . 'views' . DS . 'default' . DS . $action)
		                );
		                $operactions[] = $viewPath . $action . ' created';
		            }
		            $actions = array();
		            $customMethods = '';
		            foreach($form['Action'] AS $action) {
		                $actions[$action['action']]['label'] = $action['name'];
		                switch($action['engine']) {
		                    case 'chart':
		                        $actions[$action['action']]['class'] = 'link';
		                        break;
		                    default:
		                        $actions[$action['action']]['class'] = $controller_name . 'PageControl';
		                        break;
		                }
		                $customFields = $blocks = array();
		                foreach($action['parameters']['blocks'] AS $key => $block) {
		                    if(is_array($block)) {
		                        foreach($block AS $field) {
		                            list($fieldModel, $fieldName) = explode('.', $field);
		                            if(!isset($models[$fieldModel]['fields'][$fieldModel][$fieldName]['label'])) {
		                                $labelName = '--';
		                            } else {
		                                $labelName = $models[$fieldModel]['label'] . '：' . $models[$fieldModel]['fields'][$fieldModel][$fieldName]['label'];
		                            }
		                            $blocks[$key][$fieldModel][$fieldName] = $labelName;
		                            $customFields[$fieldModel][$fieldName]['label'] = $labelName;
		                        }
		                    } else {
		                        list($fieldModel, $fieldName) = explode('.', $block);
		                        if(!isset($models[$fieldModel]['fields'][$fieldModel][$fieldName]['label'])) {
		                            $labelName = '--';
		                        } else {
		                            $labelName = $models[$fieldModel]['label'] . '：' . $models[$fieldModel]['fields'][$fieldModel][$fieldName]['label'];
		                        }
		                        $blocks[$key][$fieldModel][$fieldName] = $labelName;
		                        $customFields[$fieldModel][$fieldName]['label'] = $labelName;
		                    }
		                }
		                $this->Smarty->assign('actionLabel', $action['name']);
		                $this->Smarty->assign('parameters', $action['parameters']);
		                $this->Smarty->assign('fields', $customFields);
		                $this->Smarty->assign('blocks', $blocks);
		                file_put_contents(
		                    $viewPath . $action['action'] . '.ctp',
		                    $this->Smarty->fetch(
		                        VENDORS . 'olc_baker' . DS . 'actions' . DS . $action['engine'] . '.ctp'
		                    )
		                );
		                $this->Smarty->assign('actionName', $action['action']);
		                $customMethods .= $this->Smarty->fetch(
		                    VENDORS . 'olc_baker' . DS . 'actions' . DS . 'methods' . DS .
		                    $action['parameters']['methods']['method'] . '.php'
		                );
		                $operactions[] = $viewPath . $action['action'] . '.ctp created';
		            }
		            $this->Smarty->assign('fields', $fields);
		            $this->Smarty->assign('actions', $actions);
		            file_put_contents(
		                $viewPath . 'index.ctp',
		                $this->Smarty->fetch('default' . DS . 'views' . DS . 'default' . DS . 'index.ctp')
		            );
		            $operactions[] = $viewPath . 'index.ctp created';

		            $this->Smarty->assign('customMethods', $customMethods);
		            file_put_contents(
		                $project['Project']['app_path'] . DS . 'controllers' . DS . $table_name . '_controller.php',
		                $this->Smarty->fetch('default' . DS . 'controllers' . DS . 'default.php')
		            );
		            $operactions[] = $project['Project']['app_path'] . DS . 'controllers' . DS . $table_name . '_controller.php created';
		        }
		    }
		    $this->Project->tasks[] = array(
		    	'title' => __('Generate the MVC files', true),
		    	'operactions' => $operactions,
		    );
		    $this->Smarty->assign('projectLabel', $project['Project']['label']);
		    $this->Smarty->assign('controllers', $controllers);
		    $file = DS . 'views' . DS . 'layouts' . DS . 'default.ctp';
		    $operactions = array();
		    $operactions[] = $project['Project']['app_path'] . $file . ' created';
		    file_put_contents($project['Project']['app_path'] . $file, $this->Smarty->fetch('default' . $file));
		    
		    foreach($files AS $file) {
		        file_put_contents($project['Project']['app_path'] . $file, $this->Smarty->fetch('default' . $file));
		        $operactions[] = $project['Project']['app_path'] . $file . ' created';
		    }
		    $this->Project->tasks[] = array(
		    	'title' => __('Generate the application layout', true),
		    	'operactions' => $operactions,
		    );

		    App::Import('vendor', 'migrations');
		    $db = & ConnectionManager::getInstance();
		    $db->create('olc_baker-dev', array(
		        'driver' => 'mysql',
		        'host' => $project['Project']['db_host'],
		        'login' => $project['Project']['db_login'],
		        'password' => $project['Project']['db_password'],
		        'database' => $project['Project']['db_name'],
		        'encoding' => 'utf8',
		        'persistent' => false,
		    ));
		    $dbn = $db->getDataSource('olc_baker-dev');
		    $migrations = new Migrations('olc_baker-dev');
		    $sqlPath = $project['Project']['app_path'] . DS . 'config' . DS . 'schema';
		    if(!file_exists($sqlPath)) {
		        mkdir($sqlPath, 0777, true);
		    }

		    $aResult = array();
		    $sqlContent = "SET NAMES utf8;\n\n";
		    $aResult['UP'] = $aResult['DOWN'] = array();
		    $aResult['UP']['create_table'] = array(
		        'acos' => array(
		            'id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		                'key' => 'primary',
		                'primary' => 'id',
		            ),
		            'parent_id' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'model' => array(
		                'type' => 'string',
		                'default' => '',
		                'length' => 255,
		            ),
		            'foreign_key' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'alias' => array(
		                'type' => 'string',
		                'default' => '',
		                'length' => 255,
		            ),
		            'lft' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		            'rght' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		        ),
		        'aros' => array(
		            'id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		                'key' => 'primary',
		                'primary' => 'id',
		            ),
		            'parent_id' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'model' => array(
		                'type' => 'string',
		                'default' => '',
		                'length' => 255,
		            ),
		            'foreign_key' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'alias' => array(
		                'type' => 'string',
		                'default' => '',
		                'length' => 255,
		            ),
		            'lft' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		            'rght' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		        ),
		        'aros_acos' => array(
		            'id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		                'key' => 'primary',
		                'primary' => 'id',
		            ),
		            'aro_id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		            'aco_id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		            ),
		            '_create' => array(
		                'type' => 'integer',
		                'null' => false,
		                'default' => 0,
		                'length' => 2,
		            ),
		            '_read' => array(
		                'type' => 'integer',
		                'null' => false,
		                'default' => 0,
		                'length' => 2,
		            ),
		            '_update' => array(
		                'type' => 'integer',
		                'null' => false,
		                'default' => 0,
		                'length' => 2,
		            ),
		            '_delete' => array(
		                'type' => 'integer',
		                'null' => false,
		                'default' => 0,
		                'length' => 2,
		            ),
		        ),
		        'members' => array(
		            'id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		                'key' => 'primary',
		                'primary' => 'id',
		            ),
		            'group_id' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'username' => array(
		                'type' => 'string',
		                'null' => false,
		                'length' => 255,
		            ),
		            'password' => array(
		                'type' => 'string',
		                'null' => false,
		                'length' => 255,
		            ),
		            'user_status' => array(
		                'type' => 'string',
		                'null' => false,
		                'default' => 'N',
		                'length' => 1,
		            ),
		            'created' => array(
		                'type' => 'datetime',
		                'null' => false,
		            ),
		            'modified' => array(
		                'type' => 'datetime',
		                'null' => false,
		            ),
		        ),
		        'groups' => array(
		            'id' => array(
		                'type' => 'integer',
		                'null' => false,
		                'length' => 11,
		                'key' => 'primary',
		                'primary' => 'id',
		            ),
		            'parent_id' => array(
		                'type' => 'integer',
		                'null' => true,
		                'length' => 11,
		            ),
		            'name' => array(
		                'type' => 'string',
		                'null' => false,
		                'length' => 255,
		            ),
		        ),
		    );
		    $aResult['DOWN']['drop_table'] = array(
		        'acos',
		        'aros',
		        'aros_acos',
		        'members',
		        'groups',
		    );
		    foreach( $tables as $table => $tableSchema ){
		        $aResult['UP']['create_table'][$table] = $tableSchema;
		        $aResult['DOWN']['drop_table'][] = $table;
		        $sqlContent .= $migrations->drop_table($table) . "\n";
		        $sqlContent .= $migrations->create_table($table, $tableSchema) . "\n";
		    }
		    file_put_contents($sqlPath . DS . 'schema.yaml', Spyc::YAMLDump($aResult));
		    file_put_contents($sqlPath . DS . 'schema.sql', $sqlContent);
		    $this->Project->tasks[] = array(
		    	'title' => __('Generate the database schema', true),
		    	'operactions' => array(
		            $sqlPath . DS . 'schema.yaml created',
		            $sqlPath . DS . 'schema.sql created',
		        ),
		    );
		    $this->set('tasks', $this->Project->tasks);
		}
	}

	function rebuild_db($projectId = null) {
	    if (!$projectId || !$project = $this->Project->find('first', array(
		    'conditions' => array('Project.id' => $projectId),
		    'contain' => array(),
		))) {
			$this->Session->setFlash(__('Please do following links in the page', true));
		} else {
		    App::Import('vendor', 'migrations');
		    $db = & ConnectionManager::getInstance();
		    $db->create('olc_baker-dev', array(
		        'driver' => 'mysql',
		        'host' => $project['Project']['db_host'],
		        'login' => $project['Project']['db_login'],
		        'password' => $project['Project']['db_password'],
		        'database' => $project['Project']['db_name'],
		        'encoding' => 'utf8',
		        'persistent' => false,
		    ));
		    $dbn = $db->getDataSource('olc_baker-dev');
		    $sqlPath = $project['Project']['app_path'] . DS . 'config' . DS . 'sql';
		    $dbn->execute('CREATE DATABASE IF NOT EXISTS `' . $project['Project']['db_name'] . '`
		    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;');
		    $dbn->execute('USE `' . $project['Project']['db_name'] . '`;');
		    $migrations = new Migrations('olc_baker-dev');
		    $migrations->load($sqlPath . DS . 'schema.yaml');
		    $migrations->down();
		    $migrations->up();
		    $this->Session->setFlash(__('Database was rebuilt', true));
		}
		$this->redirect(array('action'=>'index'));
	}

	/*
	 * Generate forms from the tables of database
	 */
	function db($projectId = 0, $tableName = null) {
	    $projectId = intval($projectId);

	    if($project = $this->Project->read(null, $projectId)) {
	        $db = & ConnectionManager::getInstance();
	        $db->create('olc_baker-dev', array(
		        'driver' => 'mysql',
		        'host' => $project['Project']['db_host'],
		        'login' => $project['Project']['db_login'],
		        'password' => $project['Project']['db_password'],
		        'database' => $project['Project']['db_name'],
		        'encoding' => 'utf8',
		        'persistent' => false,
	        ));
	        $dbn = $db->getDataSource('olc_baker-dev');
	        $tables = $dbn->listSources();
	        $currentForms = Set::extract('{n}.name', $project['Form']);
	        foreach($currentForms AS $formName) {
	            if($key = array_search($formName, $tables)) {
	                unset($tables[$key]);
	            }
	        }
	    }
	    if(empty($tableName)) {
	        $this->set('tables', $tables);
	    } else {
	        $this->loadModel('FormField');
	        if(!empty($this->data)) {
	            $this->FormField->Form->create();
	            if($this->FormField->Form->save(array('Form' => array(
	                'project_id' => $projectId,
	                'name' => $tableName,
	                'label' => $this->data['Form']['label'],
	            )))) {
	                $formId = $this->FormField->Form->getInsertID();
	                foreach($this->data['Field'] AS $fieldName => $fieldOption) {
	                    $this->FormField->create();
	                    $this->FormField->save(array('FormField' => array(
	                    	'form_id' => $formId,
	                    	'sort' => $fieldOption['sort'],
	                        'is_required' => $fieldOption['is_required'],
	                        'name' => $fieldName,
	                        'label' => $fieldOption['label'],
	                        'type' => $fieldOption['type'],
	                        'function_type' => 1,
	                    )));
	                }
	                $this->Session->setFlash(__('The form has been generated', true));
	                $this->redirect('/forms/view/' . $formId);
	            }
	        }
	        /*
	         * fields and settings
	         */
	        $tempModel = new Model(array(
	        	'name' => 'OaToolTemp',
	        	'table' => $tableName,
	        	'ds' => 'olc_baker-dev'
	        ));
	        $this->set('tableName', $tableName);
	        $this->set('schema', $tempModel->_schema);
	        $this->set('types', $this->FormField->getFieldTypeList());
	    }
	    $this->set('projectId', $projectId);
	}

}