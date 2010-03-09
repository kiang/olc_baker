<?php
/**
 * @property Member Member
 *
 */
class MembersController extends AppController {

	var $name = 'Members';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allowedActions = array('login', 'logout', 'setup');
	}

	function login() {
	    if(!$this->Member->hasAny()) {
	        $this->redirect(array('action' => 'setup'));
	    }
	}

	function logout() {
		$this->Auth->logout();
		$this->redirect(array('action' => 'login'));
	}

	/**
	 * Rebuild the Acl based on the current controllers in the application
	 *
	 * @link          http://book.cakephp.org/view/647/An-Automated-tool-for-creating-ACOs
	 * @return void
	 */
	function build_acl() {
		if (!Configure::read('debug')) {
			return $this->_stop();
		}
		$log = array();

		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}   

		App::import('Core', 'File');
		$Controllers = Configure::listObjects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'buildAcl';

		$Plugins = $this->_getPluginControllerNames();
		$Controllers = array_merge($Controllers, $Plugins);

		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			$methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

			// Do all Plugins First
			if ($this->_isPlugin($ctrlName)){
				$pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
				if (!$pluginNode) {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
					$pluginNode = $aco->save();
					$pluginNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
				}
			}
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				if ($this->_isPlugin($ctrlName)){
					$pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
					$aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
				} else {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $ctrlName;
				}
			} else {
				$controllerNode = $controllerNode[0];
			}

			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		if(count($log)>0) {
			debug($log);
		}
	}

	function _getClassMethods($ctrlName = null) {
		App::import('Controller', $ctrlName);
		if (strlen(strstr($ctrlName, '.')) > 0) {
			// plugin's controller
			$num = strpos($ctrlName, '.');
			$ctrlName = substr($ctrlName, $num+1);
		}
		$ctrlclass = $ctrlName . 'Controller';
		$methods = get_class_methods($ctrlclass);

		// Add scaffold defaults if scaffolds are being used
		$properties = get_class_vars($ctrlclass);
		if (array_key_exists('scaffold',$properties)) {
			if($properties['scaffold'] == 'admin') {
				$methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
			} else {
				$methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
			}
		}
		return $methods;
	}

	function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	function _getPluginControllerName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[1];
		} else {
			return false;
		}
	}

	/**
	 * Get the names of the plugin controllers ...
	 *
	 * This function will get an array of the plugin controller names, and
	 * also makes sure the controllers are available for us to get the
	 * method names by doing an App::import for each plugin controller.
	 *
	 * @return array of plugin names.
	 *
	 */
	function _getPluginControllerNames() {
		App::import('Core', 'File', 'Folder');
		$paths = Configure::getInstance();
		$folder =& new Folder();
		$folder->cd(APP . 'plugins');

		// Get the list of plugins
		$Plugins = $folder->read();
		$Plugins = $Plugins[0];
		$arr = array();

		// Loop through the plugins
		foreach($Plugins as $pluginName) {
			// Change directory to the plugin
			$didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
			// Get a list of the files that have a file name that ends
			// with controller.php
			$files = $folder->findRecursive('.*_controller\.php');

			// Loop through the controllers we found in the plugins directory
			foreach($files as $fileName) {
				// Get the base file name
				$file = basename($fileName);

				// Get the controller name
				$file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
				if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
					if (!App::import('Controller', $pluginName.'.'.$file)) {
						debug('Error importing '.$file.' for plugin '.$pluginName);
					} else {
						/// Now prepend the Plugin name ...
						// This is required to allow us to fetch the method names.
						$arr[] = Inflector::humanize($pluginName) . "/" . $file;
					}
				}
			}
		}
		return $arr;
	}

	function setup() {
	    if($this->Member->hasAny(array('user_status' => 'Y'))) {
	        $this->Session->setFlash(__('There already had members in database. If you want to reset, please remove them first.', true));
	        $this->redirect('/members/login');
	    } else if(!empty($this->data)) {
	        $this->loadModel('Group');
	        $this->data['Group']['name'] = 'Admin';
	        $this->data['Group']['parent_id'] = 0;
	        $this->Group->create();
	        if($this->Group->save($this->data)) {
	            $this->Acl->Aro->saveField('alias', 'Group/' . $this->Group->getInsertID());
	            $this->build_acl();
	            $this->Acl->allow($this->Group, 'controllers');
	            $this->data['Member']['group_id'] = $this->Group->id;
	            $this->data['Member']['user_status'] = 'Y';
	            $this->Member->create();
	            if($this->Member->save($this->data)) {
	                $this->Acl->Aro->saveField('alias', 'Member/' . $this->Member->getInsertID());
	                $this->Session->setFlash(__('The administrator created, please login with the id/password you entered.', true));
	                $this->redirect('/members/login');
	            } else {
	            	$this->Session->setFlash(__('Administrator created failed.', true));
	            }
	        } else {
	            $this->Session->setFlash(__('Administrator created failed.', true));
	        }
	    }
	}


	function admin_index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Member->create();
			if ($this->Member->save($this->data)) {
			    $this->Acl->Aro->saveField('alias', 'Member/' . $this->Member->getInsertID());
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		$this->set('groups', $this->Member->Group->find('list'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		    $oldgroupid = $this->Member->field('group_id', array('Member.id' => $this->data['Member']['id']));
			if ($this->Member->save($this->data)) {
			    if ($oldgroupid !== $this->data['Member']['group_id']) {
			        $aro =& $this->Acl->Aro;
			        $member = $aro->findByForeignKeyAndModel($this->data['Member']['id'], 'Member');
			        $group = $aro->findByForeignKeyAndModel($this->data['Member']['group_id'], 'Group');
			        $aro->id = $member['Aro']['id'];
			        $aro->save(array('parent_id' => $group['Aro']['id']));
			    }
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Member->read(null, $id);
		}
		$this->set('groups', $this->Member->Group->find('list'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Member->delete($id)) {
			$this->Session->setFlash(__('The data has been deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function admin_test($count = 50) {
	    $count = intval($count);
	    if($count > 0) {
	        for($i = 0; $i < $count; $i ++) {
	            $uid = uniqid();
	            $this->Member->create();
	            if($this->Member->save(array('Member' => array(
	                'username' => $uid,
	                'password' => $uid,
	                'group_id' => 1,
	                'user_status' => 'Y',
	                'nick' => $uid,
	            	'email' => $uid . '@example.com',
	            )))) {
	                $this->Acl->Aro->saveField('alias', 'Member/' . $this->Member->getInsertID());
	            }
	        }
	    }
	    $this->Session->setFlash(__('Testing members generated.', true));
	    $this->redirect($this->referer());
	}

    function admin_acos() {
        $this->build_acl();
        $this->redirect($this->referer());
    }
}