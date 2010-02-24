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
	private function buildAcl() {
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
	    $Plugins = $this->_get_plugin_controller_names();
	    $Controllers = array_merge($Controllers, $Plugins);
	    $appIndex = array_search('App', $Controllers);
	    if ($appIndex !== false ) {
	        unset($Controllers[$appIndex]);
	    }
	    $baseMethods = get_class_methods('Controller');
	    $baseMethods[] = 'buildAcl';

	    // look at each controller in app/controllers
	    foreach ($Controllers as $ctrlName) {
	        App::import('Controller', $ctrlName);
	        $ctrlclass = $ctrlName . 'Controller';
	        $methods = get_class_methods($ctrlclass);

	        // find / make controller node
	        $controllerNode = $aco->node('controllers/'.$ctrlName);
	        if (!$controllerNode) {
	            $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
	            $controllerNode = $aco->save();
	            $controllerNode['Aco']['id'] = $aco->id;
	            $log[] = 'Created Aco node for '.$ctrlName;
	        } else {
	            $controllerNode = $controllerNode[0];
	        }

	        //clean the methods. to remove those in Controller and private actions.
	        if(!empty($methods)) {
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
	    }
	    if(empty($log)) {
	        $this->Session->setFlash(__('All the necessary ACOs are already exists', true));
	    } else {
	        $this->Session->setFlash(implode('<br />', $log));
	    }
	}

	/**
     * Get the names of the plugin controllers ...
     *
     * This function will get an array of the plugin controller names, and
     * also makes sure the controllers are available for us to get the
     * method names by doing an App::import for each plugin controller.
     *
     * @link          http://book.cakephp.org/view/647/An-Automated-tool-for-creating-ACOs
     * @return array of plugin names.
     *
     */
	private function _get_plugin_controller_names(){
	    App::import('Core', 'File', 'Folder');
	    $paths = Configure::getInstance();
	    $folder =& new Folder();
	    // Change directory to the plugins
	    $folder->cd(APP.'plugins');
	    // Get a list of the files that have a file name that ends
	    // with controller.php
	    $files = $folder->findRecursive('.*_controller\.php');
	    // Get the list of plugins
	    $Plugins = Configure::listObjects('plugin');

	    // Loop through the controllers we found int the plugins directory
	    foreach($files as $f => $fileName)
	    {
	        // Get the base file name
	        $file = basename($fileName);

	        // Get the controller name
	        $file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));

	        // Loop through the plugins
	        foreach($Plugins as $pluginName){
	            if (preg_match('/^'.$pluginName.'/', $file)){
	                // First get rid of the App controller for the plugin
	                // We do this because the app controller is never called
	                // directly ...
	                if (preg_match('/^'.$pluginName.'App/', $file)){
	                    unset($files[$f]);
	                } else {
	                    if (!App::import('Controller', $pluginName.'.'.$file))
	                    {
	                        debug('Error importing '.$file.' for plugin '.$pluginName);
	                    }

	                    /// Now prepend the Plugin name ...
	                    // This is required to allow us to fetch the method names.
	                    $files[$f] = $file;
	                }
	                break;
	            }
	        }
	    }

	    return $files;
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
	            $this->buildAcl();
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
		if ($this->Member->del($id)) {
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
        $this->buildAcl();
        $this->redirect($this->referer());
    }
}