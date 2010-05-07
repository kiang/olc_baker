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

	function setup() {
	    if($this->Member->hasAny(array('user_status' => 'Y'))) {
	        $this->Session->setFlash(__('There are members in database. If you want to reset, please remove them first.', true));
	        $this->redirect('/members/login');
	    } else if(!empty($this->data)) {
                $this->loadModel('Group');
	        $this->data['Group']['name'] = 'Admin';
	        $this->data['Group']['parent_id'] = 0;
	        $this->Group->create();
	        if($this->Group->save($this->data)) {
	            $this->data['Member']['group_id'] = $this->Group->id;
	            $this->data['Member']['user_status'] = 'Y';
	            $this->Member->create();
	            if($this->Member->save($this->data)) {
                        $this->loadModel('Permissible.PermissibleAro');
                        $this->PermissibleAro->reset();
                        $this->loadModel('Permissible.PermissibleAco');
                        if ($this->PermissibleAco->reset()) {
                            $this->Acl->deny('everyone', 'app');
                            $this->Acl->allow('Group1', 'app');
                        }
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
	                'password' => $this->Auth->password($uid),
	                'group_id' => 1,
	                'user_status' => 'Y',
	                'nick' => $uid,
	            	'email' => $uid . '@example.com',
	            )))) {
	                $this->Acl->Aro->saveField('alias', 'Member' . $this->Member->getInsertID());
	            }
	        }
	    }
	    $this->Session->setFlash(__('Testing members generated.', true));
	    $this->redirect($this->referer());
	}

    function admin_acos() {
        $this->loadModel('Permissible.PermissibleAco');
        $this->PermissibleAco->reset();
        $this->redirect($this->referer());
    }
}