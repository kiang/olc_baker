<?php
/**
 * @property Group Group
 */
class GroupsController extends AppController {

	var $name = 'Groups';

	function admin_index($parentId = 0) {
        $this->paginate['Group'] = array(
            'contain' => array(),
        );
        $this->set('parentId', $parentId);
        $upperLevelId = 0;
        if($parentId > 0) {
            $upperLevelId = $this->Group->field('parent_id', array('Group.id' => $parentId));
        }
        $this->set('upperLevelId', $upperLevelId);
        if(!$groups = $this->paginate($this->Group, array('parent_id' => $parentId))) {
            if(isset($this->params['named']['page']) && $this->params['named']['page'] > 1) {
                $this->Session->setFlash(__('The page doesn\'t exists', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('It doesn\'t have sub groups. You could try to add one through the following form.', true));
                $this->redirect(array('action' => 'add', $parentId));
            }
        } else {
            $this->set('groups', $groups);
        }
	}

	function admin_add($parentId = 0) {
		if (!empty($this->data)) {
			$this->Group->create();
			$this->data['Group']['parent_id'] = $parentId;
			if ($this->Group->save($this->data)) {
			    $this->Acl->Aro->saveField('alias', 'Group/' . $this->Group->getInsertID());
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index', $parentId));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		$this->set('parentId', $parentId);
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Please select a group first!', true));
			$this->redirect($this->referer());
		}
		if (!empty($this->data)) {
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The data has been saved', true));
				$this->redirect(array('action'=>'index', $this->Group->field('parent_id')));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Please select a group first!', true));
			$this->redirect($this->referer());
		}
		$parentId = $this->Group->field('parent_id', array('Group.parent_id' => $id));
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('The group has been removed', true));
			$this->redirect(array('action'=>'index', $parentId));
		}
	}

	function admin_acos($groupId = 0) {
	    $this->paginate['Aco']['limit'] = 10;
	    if(empty($groupId) || !$aroGroup = $this->Group->find('first', array(
	        'contain' => array(),
	        'conditions' => array(
	            'Group.id' => $groupId,
	        ),
	    ))) {
	        $this->Session->setFlash(__('Please select a group first!', true));
	        $this->redirect(array('action' => 'index'));
	    }
	    unset($aroGroup['Aco']);
	    if(!empty($this->params['form'])) {
	        $count = 0;
	        foreach($this->params['form'] AS $key => $val) {
	            if(strstr($key, '___')) {
	                $key = str_replace('___', '/', $key);
	                if($val == '+') {
	                    $this->Acl->allow($aroGroup, $key);
	                    ++$count;
	                } else if($val = '-') {
	                    $this->Acl->deny($aroGroup, $key);
	                    ++$count;
	                }
	            }
	        }
	        if($count > 0) {
	            $this->Session->setFlash(sprintf(__('%d items updated successfully!', true), $count));
	        }
	    }
	    $this->set('groupId', $groupId);
	    /*
	     * Find the root node of ACOS
	     */
	    $aco =& $this->Acl->Aco;
	    if($acoRoot = $aco->node('controllers')) {
	        $acos = $this->paginate($this->Acl->Aco, array('Aco.parent_id' => $acoRoot[0]['Aco']['id']));
	        foreach($acos AS $key => $controllerAco) {
	            $actionAcos = $this->Acl->Aco->find('all', array(
	                'conditions' => array(
	                    'Aco.parent_id' => $controllerAco['Aco']['id'],
	                ),
	            ));
	            if(!empty($actionAcos)) {
	                foreach($actionAcos AS $actionAco) {
	                    $actionAco['Aco']['permitted'] = $this->Acl->check(
	                        $aroGroup,
	                        $controllerAco['Aco']['alias'] . '/' . $actionAco['Aco']['alias']
	                    );
	                    $acos[$key]['Aco']['Aco'][] = $actionAco['Aco'];
	                }
	            }
	        }
	        $this->set('acos', $acos);
	    } else {
	        /*
	         * Can't find the root node, forward to members/setup method
	         */
	        $this->redirect(array('controller' => 'members', 'action' => 'setup'));
	    }
	}

}