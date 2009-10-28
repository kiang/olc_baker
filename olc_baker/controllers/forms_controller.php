<?php
class FormsController extends AppController {

	var $name = 'Forms';

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('pForm', $this->Form->read(null, $id));
		$this->set('formFields', $this->Form->FormField->find('all', array(
		    'conditions' => array('FormField.form_id' => $id),
		    'order' => array('FormField.sort ASC'),
		)));
		$this->set('relationships', $this->Form->Relationship->find('all', array(
		    'conditions' => array('Relationship.form_id_base' => $id),
		    'order' => array('Relationship.modified DESC'),
		    'contain' => array('TargetForm'),
		)));
		$this->set('actions', $this->Form->Action->find('all', array(
		    'conditions' => array('Action.form_id' => $id),
		)));
	}

	function add($projectId = null) {
	    if (!$projectId) {
	        $this->Session->setFlash('請依據網頁指示操作');
	        $this->redirect($this->referer());
	    }
		if (!empty($this->data)) {
			$this->Form->create();
			$this->data['Form']['project_id'] = $projectId;
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash('資料已經儲存');
				$this->redirect(array('action'=>'view', $this->Form->getInsertID()));
			} else {
				$this->Session->setFlash('資料儲存失敗，請重試');
			}
		}
		$this->set('projectId', $projectId);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect($this->referer());
		}
		if (!empty($this->data)) {
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash('資料已經儲存');
				$this->redirect(array('controller' => 'projects', 'action'=>'view', $this->Form->field('project_id')));
			} else {
				$this->Session->setFlash('資料儲存失敗，請重試');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Form->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id || !$projectId = $this->Form->field('project_id', array('Form.id' => $id))) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect($this->referer());
		} else if ($this->Form->del($id)) {
			$this->Session->setFlash('資料已經刪除');
			$this->redirect(array('controller' => 'projects', 'action'=>'view', $projectId));
		}
	}

}