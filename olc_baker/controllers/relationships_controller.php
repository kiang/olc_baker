<?php
class RelationshipsController extends AppController {

	var $name = 'Relationships';

	function add($formId = null) {
	    if (!$formId || !$baseForm = $this->Relationship->BaseForm->find('first', array(
	        'conditions' => array('BaseForm.id' => $formId),
	        'contain' => array(),
	    ))) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect($this->referer());
		}
		if (!empty($this->data)) {
			$this->Relationship->create();
			$this->data['Relationship']['project_id'] = $baseForm['BaseForm']['project_id'];
			$this->data['Relationship']['form_id_base'] = $baseForm['BaseForm']['id'];
			if ($this->Relationship->save($this->data)) {
				$this->Session->setFlash('資料已經儲存！');
				/*
				 * 建立相對關聯
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
				$this->Session->setFlash('資料儲存失敗，請重試');
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
			$this->Session->setFlash('請依據網頁指示操作');
		} else if ($this->Relationship->del($id) && $this->Relationship->del($parentId)) {
			$this->Session->setFlash('資料已經刪除！');
		}
		$this->redirect($this->referer());
	}

}