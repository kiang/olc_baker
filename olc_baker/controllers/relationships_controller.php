<?php
class RelationshipsController extends AppController {

	var $name = 'Relationships';

	function add($formId = null) {
	    if (!$formId || !$baseForm = $this->Relationship->BaseForm->find('first', array(
	        'conditions' => array('BaseForm.id' => $formId),
	        'contain' => array(),
	    ))) {
			$this->Session->setFlash(__('Please do following links in the page', true));
			$this->redirect($this->referer());
		}
		if (!empty($this->data)) {
			$this->Relationship->create();
			$this->data['Relationship']['project_id'] = $baseForm['BaseForm']['project_id'];
			$this->data['Relationship']['form_id_base'] = $baseForm['BaseForm']['id'];
			if ($this->Relationship->save($this->data)) {
				$this->Session->setFlash(__('Data has been saved', true));
				/*
				 * Build the related relationship
				 */
				$this->data['Relationship']['parent_id'] = $this->Relationship->getInsertID();
				switch($this->data['Relationship']['type']) {
				    case 'bt':
				        $this->data['Relationship']['type'] = 'hm';
				        break;
				    case 'ho':
				    case 'hm':
				        $this->data['Relationship']['type'] = 'bt';
				        break;
				}
				$this->data['Relationship']['form_id_base'] = $this->data['Relationship']['form_id_target'];
				$this->data['Relationship']['form_id_target'] = $baseForm['BaseForm']['id'];
				$this->Relationship->create();
				if($this->Relationship->save($this->data)) {
				    $newId = $this->Relationship->getInsertID();
				    $this->Relationship->id = $this->data['Relationship']['parent_id'];
				    $this->Relationship->saveField('parent_id', $newId);
				}
				$this->redirect(array('controller' => 'forms', 'action'=>'view', $formId));
			} else {
				$this->Session->setFlash(__('Something was wrong during saving, please try again', true));
			}
		}
		$this->set('targetForms', $this->Relationship->TargetForm->find('list', array(
		    'conditions' => array(
		    	'TargetForm.id !=' => $formId,
		        'TargetForm.project_id' => $baseForm['BaseForm']['project_id'],
		    ),
		)));
		$this->set('baseForm', $baseForm);
	}

	function delete($id = null) {
		if (!$id || !$parentId = $this->Relationship->field('parent_id', array('Relationship.id' => $id))) {
			$this->Session->setFlash(__('Please do following links in the page', true));
		} else if ($this->Relationship->del($id) && $this->Relationship->del($parentId)) {
			$this->Session->setFlash(__('Data has been deleted', true));
		}
		$this->redirect($this->referer());
	}

}